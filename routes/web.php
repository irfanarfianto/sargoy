<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TentangKamiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('login.google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    // EDIT Admin
    Route::get('/admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/edit', [AdminController::class, 'destroy'])->name('admin.destroy');
});
Route::middleware(['auth', 'verified', 'role:seller'])->group(function () {
    Route::get('/seller', [SellerController::class, 'index'])->name('seller.dashboard');


    // EDIT SELLER
    Route::get('/seller/edit', [SellerController::class, 'edit'])->name('seller.edit');
    Route::patch('/seller/edit', [SellerController::class, 'update'])->name('seller.update');
    Route::delete('/seller/edit', [SellerController::class, 'destroy'])->name('seller.destroy');
});

Route::get('/produk', [ProductController::class,'index']);
Route::get('/edukasi', [EdukasiController::class,'index']);
Route::get('/tentang-kami', [TentangKamiController::class,'index']);

require __DIR__ . '/auth.php';
