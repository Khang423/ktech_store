<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('outside.index');
});
Route::get('/admin', [AuthController::class, 'index'])->name('admin.index');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'admin'
], function () {
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
        'prefix' => 'product',
        'as' => 'product.'
    ], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::post('/getList', [ProductController::class, 'getList'])->name('getList');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/store', [ProductController::class, 'store'])->name('store');
        Route::get('/edit/{product:slug}', [ProductController::class, 'edit'])->name('edit');
        Route::put('/edit/{product:slug}', [ProductController::class, 'update'])->name('update');
        Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');
    });
    // Permission route
    Route::group([
        'prefix' => 'permissions',
        'as' => 'permissions.'
    ], function () {
        Route::get('/', [PermissionController::class, 'index'])->name('index');
        Route::post('/getList', [PermissionController::class, 'getList'])->name('getList');
        Route::get('/create', [PermissionController::class, 'create'])->name('create');
        Route::post('/store', [PermissionController::class, 'store'])->name('store');
        Route::get('/edit/{product:slug}', [PermissionController::class, 'edit'])->name('edit');
        Route::put('/edit/{product:slug}', [PermissionController::class, 'update'])->name('update');
        Route::delete('/delete', [PermissionController::class, 'delete'])->name('delete');
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
});
