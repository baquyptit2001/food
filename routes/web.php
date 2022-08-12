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
    Route::middleware(['auth', 'is_active', 'is_admin'])->group(function () {
        Route::get('/', function () {
            return \Inertia\Inertia::render("Admin/DashBoard/Index");
        })->name('dashboard');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
        Route::resource('news', \App\Http\Controllers\Admin\NewsController::class);
        Route::resource('promotions', \App\Http\Controllers\Admin\PromotionController::class, ['except' => ['update']]);
        Route::post('news/{news}', [\App\Http\Controllers\Admin\NewsController::class, 'update'])->name('news.update');
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
            Route::get('change-status/{user}', [\App\Http\Controllers\Admin\UserController::class, 'changeStatus'])->name('change-status');
            Route::get('change-role/{user}', [\App\Http\Controllers\Admin\UserController::class, 'changeRole'])->name('change-role');
            Route::get('{user}', [\App\Http\Controllers\Admin\UserController::class, 'profile'])->name('profile');
            Route::get('profile/update', [\App\Http\Controllers\Admin\UserController::class, 'updatePage'])->name('update-page');
            Route::put('profile/update', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('update');
        });
    });
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'login_page'])->name('login.page');
        Route::get('register', [\App\Http\Controllers\Admin\AuthController::class, 'register_page'])->name('register.page');
        Route::post('register', [\App\Http\Controllers\Admin\AuthController::class, 'register'])->name('register');
        Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('login');
        Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('forgot-password', [\App\Http\Controllers\Admin\AuthController::class, 'forgot_password_page'])->name('forgot-password.page');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\AuthController::class, 'forgot_password'])->name('forgot-password');
        Route::get('reset-password/{token}/{email}', [\App\Http\Controllers\Admin\AuthController::class, 'reset_password_page'])->name('reset-password.page');
        Route::post('reset-password', [\App\Http\Controllers\Admin\AuthController::class, 'reset_password'])->name('reset-password');
    });
});


Route::group(['as' => 'client.'], function () {
    Route::get('/', [\App\Http\Controllers\Client\HomeController::class, 'index'])->name('home');
});

//Route::redirect('/', '/admin');

