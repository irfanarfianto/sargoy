<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers;
use App\Http\Controllers\ProductController;

Route::get('/', Controllers\HomeController::class);

Route::get('/login/google', [Controllers\OauthController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login/google/callback', [Controllers\OauthController::class, 'handleProviderCallback'])->name('login.google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin', [Controllers\AdminController::class, 'index'])->name('admin.dashboard');

    // EDIT Admin
    Route::get('/admin/edit', [Controllers\AdminController::class, 'edit'])->name('admin.edit');
    Route::patch('/admin/edit', [Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/edit', [Controllers\AdminController::class, 'destroy'])->name('admin.destroy');
});
Route::middleware(['auth', 'verified', 'role:seller'])->group(function () {
    Route::get('/seller', [Controllers\SellerController::class, 'index'])->name('seller.dashboard');


    // EDIT SELLER
    Route::get('/seller/edit', [Controllers\SellerController::class, 'edit'])->name('seller.edit');
    Route::patch('/seller/edit', [Controllers\SellerController::class, 'update'])->name('seller.update');
    Route::delete('/seller/edit', [Controllers\SellerController::class, 'destroy'])->name('seller.destroy');
});


Route::get('/produk', [ProductController::class, 'index'])->name('product.index');
Route::get('/produk/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/produk', [ProductController::class, 'store'])->name('product.store');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/produk/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

Route::get('/blogs', [Controllers\BlogController::class, 'index']);

Route::get('/tentang-kami', [Controllers\TentangKamiController::class, 'index']);


// Route::middleware(['auth', 'verified', 'role:admin'])->group(
//     function () {
//         Route::resource('faqs', Controllers\FAQController::class);
//     }
// );

Route::resource('faqs', Controllers\FAQController::class);

require __DIR__ . '/auth.php';
