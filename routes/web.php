<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Transaksi\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', 'dashboard');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.show-login-form');
Route::post('/login', [LoginController::class, 'postLogin'])->name('auth.post-login');
Route::post('/logout', [LoginController::class, 'postLogout'])->name('auth.post-logout');

Route::middleware('auth')->prefix('/dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::prefix('/admin')->name('admin.')->middleware('auth.admin')->group(function () {
        Route::prefix('/user')->name('user.')->group(function () {
            // View response routes
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::get('/{id}/show', [UserController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');

            // Action routes
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::put('/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('/transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])->name('index');
        Route::get('/create', [TransaksiController::class, 'create'])->name('create');
        Route::get('/{id}/show', [TransaksiController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [TransaksiController::class, 'edit'])->name('edit');

        // Action routes
        Route::post('/', [TransaksiController::class, 'store'])->name('store');
        Route::put('/{id}', [TransaksiController::class, 'update'])->name('update');
        Route::delete('/{id}', [TransaksiController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/{id}/index', [ProfileController::class, 'index'])->name('index');
    });
});
