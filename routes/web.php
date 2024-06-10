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
use App\Http\Controllers\UserController;

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
    Route::get('dashboard/produk', [ProductController::class, 'index'])->name('dashboard.product.index');
    Route::get('dashboard/produk/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('dashboard/produk', [ProductController::class, 'store'])->name('product.store');
    Route::get('dashboard/produk/{slug}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('dashboard/produk/{slug}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('dashboard/produk/{slug}', [ProductController::class, 'destroy'])->name('product.destroy');
});

// ROLE SELLER
Route::middleware(['auth', 'verified', 'role:seller'])->group(function () {
    Route::get('dashboard/seller', [SellerController::class, 'index'])->name('seller.dashboard');
    Route::get('dashboard/seller/edit', [SellerController::class, 'edit'])->name('seller.edit');
    Route::patch('dashboard/seller/edit', [SellerController::class, 'update'])->name('seller.update');
    Route::delete('dashboard/seller/edit', [SellerController::class, 'destroy'])->name('seller.destroy');
});

// ROLE ADMIN
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('dashboard/admin/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('dashboard/admin/edit', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('dashboard/admin/edit', [AdminController::class, 'destroy'])->name('admin.destroy');

    // USER MANAJEMEN
    // Route::resource('dashboard/users', \App\Http\Controllers\UserController::class);
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('dashboard.users.create');
    Route::post('/dashboard/users', [UserController::class, 'store'])->name('dashboard.users.store');
    Route::get('/dashboard/users/{user}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/dashboard/users/{user}', [UserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/dashboard/users/{user}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');


    // FAQ
    Route::resource('dashboard/faqs', FAQController::class);

    // Category
    Route::get('dashboard/kategori', [CategoryController::class, 'index'])->name('dashboard.categories.index');
    Route::get('dashboard/kategori/create', [CategoryController::class, 'create'])->name('dashboard.categories.create');
    Route::post('dashboard/kategori', [CategoryController::class, 'store'])->name('dashboard.categories.store');
    Route::get('dashboard/kategori/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.categories.edit');
    Route::put('dashboard/kategori/{category}', [CategoryController::class, 'update'])->name('dashboard.categories.update');
    Route::delete('dashboard/kategori/{category}', [CategoryController::class, 'destroy'])->name('dashboard.categories.destroy');
});

require __DIR__ . '/auth.php';
