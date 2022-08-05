<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::middleware(['auth', 'is_active'])->group(function () {
        Route::get('/', function () {
            return \Inertia\Inertia::render("Admin/DashBoard/Index");
        })->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
        Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('users/change-status/{user}', [\App\Http\Controllers\Admin\UserController::class, 'changeStatus'])->name('users.change-status');
        Route::get('users/change-role/{user}', [\App\Http\Controllers\Admin\UserController::class, 'changeRole'])->name('users.change-role');
        Route::get('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'profile'])->name('users.profile');
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'login_page'])->name('auth.login.page');
        Route::get('register', [\App\Http\Controllers\Admin\AuthController::class, 'register_page'])->name('auth.register.page');
        Route::post('register', [\App\Http\Controllers\Admin\AuthController::class, 'register'])->name('auth.register');
        Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('auth.login');
        Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('auth.logout');
        Route::get('forgot-password', [\App\Http\Controllers\Admin\AuthController::class, 'forgot_password_page'])->name('auth.forgot-password.page');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\AuthController::class, 'forgot_password'])->name('auth.forgot-password');
        Route::get('reset-password/{token}/{email}', [\App\Http\Controllers\Admin\AuthController::class, 'reset_password_page'])->name('auth.reset-password.page');
        Route::post('reset-password', [\App\Http\Controllers\Admin\AuthController::class, 'reset_password'])->name('auth.reset-password');
    });
});

Route::redirect('/', '/admin');

