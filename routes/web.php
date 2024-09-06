<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware('can:admin-only')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// User routes
Route::middleware('can:user-only')->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

Route::middleware(['auth'])->group(function () {
Route::get('users/index', [UserController::class, 'index'])->name('users.index');
Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('users/update/{id}', [UserController::class, 'update'])->name('users.update');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    });

Route::middleware(['auth'])->group(function () {
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';
