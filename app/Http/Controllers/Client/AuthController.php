<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Jobs\ForgotPasswordJob;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_page(): \Inertia\Response
    {
        return Inertia::render('Client/Auth/Login');
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        return Redirect::route('client.auth.login.page');
    }

    public function login(AuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return Redirect::route('client.home');
        }
        return Redirect::back()->withErrors(['Tài khoản hoặc mật khẩu không đúng']);
    }

    public function register_page(): \Inertia\Response
    {
        return Inertia::render('Client/Auth/Register');
    }

    public function register(AuthRequest $request)
    {
        if (User::where('email', $request->email)->exists()) {
            return Redirect::back()->withErrors(['email' => 'Email đã tồn tại']);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return Route::redirect('client.auth.login.page');
    }

    public function forgot_password_page(): \Inertia\Response
    {
        return Inertia::render('Client/Auth/ForgotPassword');
    }

    public function forgot_password(AuthRequest $request)
    {
        if (!User::where('email', $request->email)->exists()) {
            return Redirect::back()->withErrors(['email' => 'Email không tồn tại']);
        }
        ForgotPasswordJob::dispatch($request->only('email'));
    }

    public function reset_password_page(Request $request): \Inertia\Response
    {
        return Inertia::render('Client/Auth/ResetPassword', [
            'token' => $request->token,
            'email' => $request->email,
        ]);
    }

    public function reset_password(AuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('client.auth.login.page')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
