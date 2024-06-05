<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OauthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FAQController;

// ROLE PUBLIC
Route::get('/', HomeController::class)->name('home');
Route::get('/login/google', [OauthController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login/google/callback', [OauthController::class, 'handleProviderCallback'])->name('login.google.callback');
Route::get('/produk', [ProductController::class, 'publicIndex'])->name('public.product.index');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/tentang-kami', [TentangKamiController::class, 'index']);


Route::get('/load-more-products', [ProductController::class, 'loadMoreProducts']);


// ROLE ADMIN dan SELLER
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ROLE SELLER
Route::middleware(['auth', 'verified', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/seller/dashboard/edit', [SellerController::class, 'edit'])->name('seller.edit');
    Route::patch('/seller/dashboard/edit', [SellerController::class, 'update'])->name('seller.update');
    Route::delete('/seller/dashboard/edit', [SellerController::class, 'destroy'])->name('seller.destroy');

    Route::get('/dashboard/produk', [ProductController::class, 'index'])->name('dashboard.product.index');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// ROLE ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/dashboard/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/dashboard/edit', [AdminController::class, 'destroy'])->name('admin.destroy');

    Route::get('/dashboard/produk', [ProductController::class, 'index'])->name('dashboard.product.index');
    Route::resource('faqs', FAQController::class);

    Route::get('/produk/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
});

require __DIR__ . '/auth.php';
