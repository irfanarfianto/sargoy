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
use App\Http\Controllers\ReviewController;
use App\Models\Review;

// ROLE PUBLIC
Route::get('/', HomeController::class)->name('home');
Route::get('/login/google', [OauthController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login/google/callback', [OauthController::class, 'handleProviderCallback'])->name('login.google.callback');
Route::get('/produk', [ProductController::class, 'publicIndex'])->name('public.product.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/blogs', [BlogController::class, 'index']);
Route::get('/tentang-kami', [TentangKamiController::class, 'index']);
Route::get('/load-more-products', [ProductController::class, 'loadMoreProducts']);


// ROLE Auth
Route::post('/review/{id}', [ReviewController::class, 'reviewPost'])->name('review_post');

// ROLE ADMIN dan SELLER
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ROLE ADMIN dan SELLER
Route::middleware(['auth', 'verified', 'role:seller|admin'])->group(function () {
    Route::get('/dashboard/produk', [ProductController::class, 'index'])->name('dashboard.product.index');
    Route::get('/produk/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
    Route::get('/produk/{slug}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/produk/{slug}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/produk/{slug}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// ROLE SELLER
Route::middleware(['auth', 'verified', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('/seller/dashboard/edit', [SellerController::class, 'edit'])->name('seller.edit');
    Route::patch('/seller/dashboard/edit', [SellerController::class, 'update'])->name('seller.update');
    Route::delete('/seller/dashboard/edit', [SellerController::class, 'destroy'])->name('seller.destroy');
});

// ROLE ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/dashboard/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/dashboard/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/dashboard/edit', [AdminController::class, 'destroy'])->name('admin.destroy');

    // FAQ
    Route::resource('faqs', FAQController::class);

    // Category
    Route::get('/dashboard/kategori', [CategoryController::class, 'index'])->name('dashboard.categories.index');
    Route::get('/dashboard/kategori/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('/dashboard/kategori', [CategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::get('/dashboard/kategori/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::put('/dashboard/kategori/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('/dashboard/kategori/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
});

require __DIR__ . '/auth.php';
