<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CartController;
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
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('news', NewsController::class);
        Route::resource('promotions', PromotionController::class);
        Route::post('news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('', [UserController::class, 'index'])->name('index');
            Route::get('change-status/{user}', [UserController::class, 'changeStatus'])->name('change-status');
            Route::get('change-role/{user}', [UserController::class, 'changeRole'])->name('change-role');
            Route::get('{user}', [UserController::class, 'profile'])->name('profile');
            Route::get('profile/update', [UserController::class, 'updatePage'])->name('update-page');
            Route::put('profile/update', [UserController::class, 'update'])->name('update');
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
    Route::group(['prefix' => 'news', 'as' => 'news.'], function () {
        Route::get('', [\App\Http\Controllers\Client\NewsController::class, 'index'])->name('index');
        Route::get('{news}', [\App\Http\Controllers\Client\NewsController::class, 'show'])->name('show');
    });
    Route::resource('carts', CartController::class);
    Route::resource('products', \App\Http\Controllers\Client\ProductController::class);
    Route::get('checkout', [\App\Http\Controllers\Client\CartController::class, 'checkout'])->name('carts.checkout');
    Route::post('user_info', [\App\Http\Controllers\Client\CartController::class, 'addAddress'])->name('carts.user_info.store');
    Route::put('user_info', [\App\Http\Controllers\Client\CartController::class, 'setDefaultAddress'])->name('carts.update.user_info');
    Route::put('user_info/{address}', [\App\Http\Controllers\Client\CartController::class, 'updateAddress'])->name('carts.update.user_info_address');
    Route::delete('user_info/{address}', [\App\Http\Controllers\Client\CartController::class, 'deleteAddress'])->name('carts.delete.user_info');
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('login', [AuthController::class, 'login_page'])->name('login.page');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('register', [AuthController::class, 'register_page'])->name('register.page');
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('forgot-password', [AuthController::class, 'forgot_password_page'])->name('forgot-password.page');
        Route::post('forgot-password', [AuthController::class, 'forgot_password'])->name('forgot-password');
        Route::get('reset-password/{token}/{email}', [AuthController::class, 'reset_password_page'])->name('reset-password.page');
        Route::post('reset-password', [AuthController::class, 'reset_password'])->name('reset-password');
    });
});

//Route::redirect('/', '/admin');

