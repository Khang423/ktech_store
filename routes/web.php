<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// route home
Route::group([
    'as' => 'home.',
], function () {
    // page home
    Route::get('/', [HomeController::class, 'index'])->name('index');
    // product detail
    Route::get('/product/{productVersion:slug}', [HomeController::class, 'product_detail'])->name('product_detail');
    // login
    Route::get('/login', [HomeController::class, 'login'])->name('login');
    Route::post('/loginProcess', [HomeController::class, 'loginProcess'])->name('loginProcess');
    // register
    Route::get('/register', [HomeController::class, 'register'])->name('register');
    Route::post('/registerProcess', [HomeController::class, 'registerProcess'])->name('registerProcess');
    // logout
    Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
    // search product
    Route::post('/search', [HomeController::class, 'searchProcess'])->name('searchProcess');
    Route::get('/search-result', [HomeController::class, 'searchResult'])->name('searchResult');
    // check auth status
    Route::post('/auth-status', [AuthController::class, 'authCheck'])->name('authStatus');
});

Route::group([
    'as' => 'home.',
    'middleware' => 'customer'
], function () {
    // cart
    Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
    Route::post('/addItemToCart', [CartController::class, 'addItemToCart'])->name('addItemToCart');
    Route::post('/cartItemUpdate', [CartController::class, 'update'])->name('cartItemUpdate');
    Route::post('/detleItemCart', [CartController::class, 'delete'])->name('detleItemCart');
    // order
    Route::get('cart/payment-info', [HomeController::class, 'order'])->name('order');
    Route::post('cart/order/store', [OrderController::class, 'store'])->name('orderStore');
});

Route::group([
    'prefix' => 'address',
    'as' => 'address.',
], function () {
    Route::post('/getDistricts', [AddressController::class, 'getDistricts'])->name('getDistricts');
    Route::post('/getWards', [AddressController::class, 'getWards'])->name('getWards');
});


// route page login admin
Route::get('/admin', [AuthController::class, 'index'])->name('admin.index');
// login process
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
// logout
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');


// admin
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'admin'
], function () {
    // route dashboard
    Route::group([], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    });
    // Member route
    Route::group([
        'prefix' => 'members',
        'as' => 'members.'
    ], function () {
        Route::get('/', [MemberController::class, 'index'])->name('index');
        Route::post('/getList', [MemberController::class, 'getList'])->name('getList');
        Route::get('/create', [MemberController::class, 'create'])->name('create');
        Route::post('/store', [MemberController::class, 'store'])->name('store');
        Route::get('/edit/{member:slug}', [MemberController::class, 'edit'])->name('edit');
        Route::put('/edit/{member:slug}', [MemberController::class, 'update'])->name('update');
        Route::delete('/delete', [MemberController::class, 'delete'])->name('delete');
    });

    // Product route
    Route::group([
        'prefix' => 'products',
        'as' => 'products.'
    ], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/getList', [ProductController::class, 'getList'])->name('getList');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{productVersion:slug}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/edit/{productVersion:slug}', [ProductController::class, 'update'])->name('update');
        Route::post('/destroy-image', [ProductController::class, 'destroy_image'])->name('destroy-image');
        Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');
    });
    // Role route
    Route::group([
        'prefix' => 'roles',
        'as' => 'roles.'
    ], function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::post('/getList', [RoleController::class, 'getList'])->name('getList');
        Route::get('/create', [RoleController::class, 'create'])->name('create');
        Route::post('/store', [RoleController::class, 'store'])->name('store');
        Route::get('/edit/{product:slug}', [RoleController::class, 'edit'])->name('edit');
        Route::put('/edit/{product:slug}', [RoleController::class, 'update'])->name('update');
        Route::delete('/delete', [RoleController::class, 'delete'])->name('delete');
    });
    // Brand route
    Route::group([
        'prefix' => 'brands',
        'as' => 'brands.'
    ], function () {
        Route::get('/', [BrandController::class, 'index'])->name('index');
        Route::post('/getList', [BrandController::class, 'getList'])->name('getList');
        Route::get('/create', [BrandController::class, 'create'])->name('create');
        Route::post('/store', [BrandController::class, 'store'])->name('store');
        Route::get('/edit/{brand:slug}', [BrandController::class, 'edit'])->name('edit');
        Route::put('/edit/{brand:slug}', [BrandController::class, 'update'])->name('update');
        Route::delete('/delete', [BrandController::class, 'delete'])->name('delete');
    });
    // Supplier route
    Route::group([
        'prefix' => 'suppliers',
        'as' => 'suppliers.'
    ], function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index');
        Route::post('/getList', [SupplierController::class, 'getList'])->name('getList');
        Route::get('/create', [SupplierController::class, 'create'])->name('create');
        Route::post('/store', [SupplierController::class, 'store'])->name('store');
        Route::get('/edit/{supplier:slug}', [SupplierController::class, 'edit'])->name('edit');
        Route::put('/edit/{supplier:slug}', [SupplierController::class, 'update'])->name('update');
        Route::delete('/delete', [SupplierController::class, 'delete'])->name('delete');
    });

    // categoryProduct product route
    Route::group([
        'prefix' => 'categoryProducts',
        'as' => 'categoryProducts.'
    ], function () {
        Route::get('/', [CategoryProductController::class, 'index'])->name('index');
        Route::post('/getList', [CategoryProductController::class, 'getList'])->name('getList');
        Route::get('/create', [CategoryProductController::class, 'create'])->name('create');
        Route::post('/store', [CategoryProductController::class, 'store'])->name('store');
        Route::get('/edit/{categoryProduct:slug}', [CategoryProductController::class, 'edit'])->name('edit');
        Route::put('/edit/{categoryProduct:slug}', [CategoryProductController::class, 'update'])->name('update');
        Route::delete('/delete', [CategoryProductController::class, 'delete'])->name('delete');
    });

    // categoryProduct
    Route::group([
        'prefix' => 'banner',
        'as' => 'banners.'
    ], function () {
        Route::get('/', [BannerController::class, 'index'])->name('index');
        Route::post('/getList', [BannerController::class, 'getList'])->name('getList');
        Route::get('/create', [BannerController::class, 'create'])->name('create');
        Route::post('/store', [BannerController::class, 'store'])->name('store');
        Route::get('/edit/{banner:slug}', [BannerController::class, 'edit'])->name('edit');
        Route::put('/edit/{banner:slug}', [BannerController::class, 'update'])->name('update');
        Route::delete('/delete', [BannerController::class, 'delete'])->name('delete');
    });
});
