<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SizeController;

use App\Http\Middleware\AdminMiddleware;

// login admin
Route::get('/admin/register', [AdminLoginController::class, 'view_register'])->name('admin.view_register');
Route::post('/admin/register', [AdminLoginController::class, 'register'])->name('admin.register');
Route::get('/admin/login', [AdminLoginController::class, 'view_login'])->name('admin.view_login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    // admin brands 
    Route::get('/admin/brands/index', [BrandController::class, 'index'])->name('admin.brands.index');
    Route::get('/admin/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
    Route::post('/admin/brands/store', [BrandController::class, 'store'])->name('admin.brands.store');
    Route::get('/admin/brands/{id}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
    Route::put('/admin/brands/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
    Route::delete('/admin/brands/{id}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');

    // admin categories
    Route::get('/admin/categories/index', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/admin/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // admin sizes
    Route::get('/admin/sizes/index', [SizeController::class, 'index'])->name('admin.sizes.index');
    Route::get('/admin/sizes/create', [SizeController::class, 'create'])->name('admin.sizes.create');
    Route::post('/admin/sizes/store', [SizeController::class, 'store'])->name('admin.sizes.store');
    Route::get('/admin/sizes/{id}/edit', [SizeController::class, 'edit'])->name('admin.sizes.edit');
    Route::put('/admin/sizes/{id}', [SizeController::class, 'update'])->name('admin.sizes.update');
    Route::delete('/admin/sizes/{id}', [SizeController::class, 'destroy'])->name('admin.sizes.destroy');
});
