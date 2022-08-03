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

Route::get('/admin', function () {
    return \Inertia\Inertia::render("Admin/DashBoard/Index");
})->name('dashboard')->middleware('auth');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', [\App\Http\Controllers\Admin\AuthController::class, 'login_page'])->name('auth.login.page');
        Route::get('register', [\App\Http\Controllers\Admin\AuthController::class, 'register_page'])->name('auth.register.page');
        Route::post('register', [\App\Http\Controllers\Admin\AuthController::class, 'register'])->name('auth.register');
        Route::post('login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('auth.login');
        Route::get('logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('auth.logout');
    });
});

Route::redirect('/', '/admin');

