<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_page(): \Inertia\Response
    {
        return Inertia::render('Admin/Auth/Login');
    }

    public function register_page(): \Inertia\Response
    {
        return Inertia::render('Admin/Auth/Register');
    }

    public function register(AuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (User::where('email', $request->email)->exists()) {
            return Redirect::back()->withErrors(['email' => 'Email đã tồn tại']);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return Redirect::route('auth.login.page');
    }

    public function login(AuthRequest $request): \Illuminate\Http\RedirectResponse
    {
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            return Redirect::route('dashboard');
        }
        return Redirect::back()->withErrors(['Invalid credentials']);
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        auth()->logout();
        return Redirect::route('auth.login.page');
    }
}
