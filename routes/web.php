<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

// ROLE PUBLIC
Route::get('/', Controllers\HomeController::class);

Route::get('/login/google', [Controllers\OauthController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login/google/callback', [Controllers\OauthController::class, 'handleProviderCallback'])->name('login.google.callback');


// ROLE ADMIN dan SELLER
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
    Route::get('/produk/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/blogs', [Controllers\BlogController::class, 'index']);

    Route::get('/tentang-kami', [Controllers\TentangKamiController::class, 'index']);
});

Route::middleware(['auth', 'verified', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [Controllers\SellerController::class, 'index'])->name('seller.dashboard');

    // EDIT SELLER
    Route::get('/seller/dashboard/edit', [Controllers\SellerController::class, 'edit'])->name('seller.edit');
    Route::patch('/seller/dashboard/edit', [Controllers\SellerController::class, 'update'])->name('seller.update');
    Route::delete('/seller/dashboard/edit', [Controllers\SellerController::class, 'destroy'])->name('seller.destroy');

    Route::get('/produk/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// ROLE ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // EDIT Admin
    Route::get('/admin/dashboard/edit', [Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/dashboard/edit', [Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/dashboard/edit', [Controllers\AdminController::class, 'destroy'])->name('admin.destroy');

    Route::resource('faqs', Controllers\FAQController::class);

    Route::get('/produk/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

require __DIR__ . '/auth.php';
