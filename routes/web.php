<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PaymentController;

// Rute untuk halaman beranda
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

// Rute untuk user dengan otentikasi
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return Inertia::render(component: 'Dashboard');})->name('dashboard');
});


// Rute untuk otentikasi Google
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Rute untuk admin
Route::prefix('admin')->group(function () {
    // Rute untuk login admin
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    });

    // Rute setelah admin berhasil login
    Route::middleware('auth:admin')->group(function () {
        Route::get('/admdashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('/users', [UsersController::class, 'index'])->name('users.index');
        Route::post('/delusers/{id}', [UsersController::class, 'delete'])->name('users.delete');
        Route::put('/updateuser/{id}', [UsersController::class, 'update'])->name('users.update');

    });
});
use App\Http\Controllers\TiketController;
use App\Http\Controllers\TiketDetailController;

Route::middleware(['auth'])->group(function () {
    Route::get('/tiket', [TiketController::class, 'index'])->name('tiket.index');
    Route::get('/tiket/{tiket_id}', [TiketController::class, 'show'])->name('tiket.show');
    Route::get('/tiket/create', [TiketController::class, 'create'])->name('tiket.create');
    Route::post('/tiket', [TiketController::class, 'store'])->name('tiket.store');
    Route::get('/tiket/{id}/edit', [TiketController::class, 'edit'])->name('tiket.edit');
    Route::put('/tiket/{id}', [TiketController::class, 'update'])->name('tiket.update');
    Route::delete('/tiket/{id}', [TiketController::class, 'destroy'])->name('tiket.destroy');

    Route::get('/detail-tiket', [TiketDetailController::class, 'index'])->name('detail-tiket.index');
    Route::get('/detail-tiket/show', [TiketDetailController::class, 'show'])->name('detail-tiket.show');
    Route::get('/detail-tiket/create', [TiketDetailController::class, 'create'])->name('detail-tiket.create');
    Route::post('/detail-tiket', [TiketDetailController::class, 'store'])->name('detail-tiket.store');
    Route::get('/detail-tiket/{id}/edit', [TiketDetailController::class, 'edit'])->name('detail-tiket.edit');
    Route::put('/detail-tiket/{id}', [TiketDetailController::class, 'update'])->name('detail-tiket.update');
    Route::delete('/detail-tiket/{id}', [TiketDetailController::class, 'destroy'])->name('detail-tiket.destroy');

    Route::post('/payment', [PaymentController::class, 'createPayment'])->name('payment.create');
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');

});

