<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Faker\Provider\UserAgent;
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
Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::put('users/update/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::put('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    });
    

    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/edit/{product}', [ProductController::class, 'edit'])->name('products.edit')->middleware('can:update,product');
    Route::put('products/update/{product}', [ProductController::class, 'update'])->name('products.update')->middleware('can:update,product');
    Route::delete('products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy')->middleware('can:delete,product');



require __DIR__.'/auth.php';
