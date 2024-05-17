<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/login/google', [\App\Http\Controllers\OauthController::class, 'redirectToProvider'])->name('login.google');
Route::get('/login/google/callback', [\App\Http\Controllers\OauthController::class, 'handleProviderCallback'])->name('login.google.callback');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return '<h1>ADMIN</h1>';
})->middleware(['auth', 'verified', 'role:admin']);

Route::get('/seller', function () {
    return '<h1>Penjual</h1>';
})->middleware(['auth', 'verified', 'role:seller|admin']);

require __DIR__ . '/auth.php';
