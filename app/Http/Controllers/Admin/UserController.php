<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        $users = User::all()->sortBy(['is_active' => 'desc', 'role_id' => 'asc']);
        return Inertia::render('Admin/User/Index', [
            'users' => UserResource::collection($users),
        ]);
    }

    public function changeStatus(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
        return redirect()->route('admin.users.index');
    }

    public function changeRole(User $user)
    {
        $user->role_id = $user->role_id == 2 ? 3 : 2;
        $user->save();
        return redirect()->route('admin.users.index');
    }

    public function profile(User $user): Response
    {
        return Inertia::render('Admin/User/Profile', [
            'user' => new UserResource($user),
        ]);
    }
}
