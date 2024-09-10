<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
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

// Route::middleware(['auth', 'can:admin'])->group(function () {
// Route::get('/admin', [AdminController::class, 'index']);
// Route::post('/admin/make-admin/{user}', [AdminController::class, 'makeAdmin'])->name('make.admin');
// });

Route::get('/admin/manage-users', [AdminController::class, 'showUsers'])->name('admin.manageUsers');
Route::post('/admin/make-admin/{id}', [AdminController::class, 'makeAdmin'])->name('admin.makeAdmin');

Route::middleware(['auth'])->group(function () {
Route::get('users', [UserController::class, 'index'])->name('users.index');
Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('users/update/{id}', [UserController::class, 'update'])->name('users.update');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('roles', RoleController::class);
    });

Route::middleware(['auth'])->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::post('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('products//{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

});

require __DIR__.'/auth.php';
