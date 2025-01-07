<?php

use Illuminate\Support\Facades\Route;
// front
use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\front\ShopController;
use App\Http\Controllers\front\CartController;


// admin
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SizeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\ShoeController;

use App\Http\Middleware\AdminMiddleware;


// Front
Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/shopByBrand/{id}', [ShopController::class, 'shopByBrand'])->name('front.shopByBrand');
Route::get('/filter-shoes/{id}', [ShopController::class, 'filterShoes'])->name('front.filterShoes');
Route::get('/shoe-detail/{id}', [ShopController::class, 'shoeDetail'])->name('front.shoeDetail');

//cart
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');



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

    // admin users
    Route::get('/admin/users/index', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/admin/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

    // admin Shoes
    Route::get('/admin/shoes/index', [ShoeController::class, 'index'])->name('admin.shoes.index');
    Route::get('/admin/shoes/create', [ShoeController::class, 'create'])->name('admin.shoes.create');
    Route::post('/admin/shoes/store', [ShoeController::class, 'store'])->name('admin.shoes.store');
    Route::get('/admin/shoes/{id}/edit', [ShoeController::class, 'edit'])->name('admin.shoes.edit');
    Route::post('/admin/shoes/{id}', [ShoeController::class, 'update'])->name('admin.shoes.update');
    Route::delete('/admin/shoes/{id}', [ShoeController::class, 'destroy'])->name('admin.shoes.destroy');

    // Đặt tên cho route lấy danh mục theo thương hiệu
    Route::get('/admin/getCategoriesByBrand/{brand_id}', [ShoeController::class, 'getCategoriesByBrand'])->name('admin.categories.byBrand');
    Route::post('/admin/upload_shoe', [ShoeController::class, 'upload_shoe'])->name('admin.shoes.upload_shoe');
    Route::post('/admin/update_img_shoes', [ShoeController::class, 'update_img_shoes'])->name('admin.shoes.update_img_shoes');
    Route::get('/admin/shoe-images/{shoeId}', [ShoeController::class, 'getImagesByShoe'])->name('admin.shoes.getImagesByShoe');
    Route::delete('/admin/shoes/delete_image/{imageId}', [ShoeController::class, 'deleteImage'])->name('admin.shoes.deleteImage');
});
