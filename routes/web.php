<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ModelSeriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductVersionController;
use App\Http\Controllers\StockExportController;
use App\Http\Controllers\StockImportController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagDetailController;
use App\Http\Controllers\UsageTypeController;
use Illuminate\Support\Facades\Route;

// route home
Route::group(
    [
        'as' => 'home.',
    ],
    function () {
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

        Route::post('/productFillter', [HomeController::class, 'productFillter'])->name('productFillter');
    },
);

Route::group(
    [
        'as' => 'home.',
        'middleware' => 'customer',
    ],
    function () {
        // cart
        Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
        Route::post('/addItemToCart', [CartController::class, 'addItemToCart'])->name('addItemToCart');
        Route::post('/cartItemUpdate', [CartController::class, 'update'])->name('cartItemUpdate');
        Route::post('/detleItemCart', [CartController::class, 'delete'])->name('detleItemCart');
        // order
        Route::get('cart/payment-info', [HomeController::class, 'order'])->name('order');
        Route::post('cart/order/store', [OrderController::class, 'store'])->name('orderStore');
        // profile
        Route::get('customer/profile', [CustomerController::class, 'profile'])->name('profile');
        Route::post('customer/add-address', [CustomerController::class, 'addAddress'])->name('addAddress');
        // detele address
        Route::post('customer/delete-address', [CustomerController::class, 'deleteAddress'])->name('deleteAddress');
    },
);

Route::group(
    [
        'prefix' => 'address',
        'as' => 'address.',
    ],
    function () {
        Route::post('/getDistricts', [AddressController::class, 'getDistricts'])->name('getDistricts');
        Route::post('/getWards', [AddressController::class, 'getWards'])->name('getWards');
    },
);

// route page login admin
Route::get('/admin', [AuthController::class, 'index'])->name('admin.index');
// login process
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
// logout
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// admin
Route::group(
    [
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => 'admin',
    ],
    function () {
        // route dashboard
        Route::group([], function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        });
        // Member route
        Route::group(
            [
                'prefix' => 'members',
                'as' => 'members.',
            ],
            function () {
                Route::get('/', [MemberController::class, 'index'])->name('index');
                Route::post('/getList', [MemberController::class, 'getList'])->name('getList');
                Route::get('/create', [MemberController::class, 'create'])->name('create');
                Route::post('/store', [MemberController::class, 'store'])->name('store');
                Route::get('/edit/{member:slug}', [MemberController::class, 'edit'])->name('edit');
                Route::put('/edit/{member:slug}', [MemberController::class, 'update'])->name('update');
                Route::delete('/delete', [MemberController::class, 'delete'])->name('delete');
            },
        );

        // Product route
        Route::group(
            [
                'prefix' => 'products',
                'as' => 'products.',
            ],
            function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::post('/getList', [ProductController::class, 'getList'])->name('getList');

                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');

                Route::get('/{products:slug}/edit', [ProductVersionController::class, 'edit'])->name('edit');
                Route::put('/{products:slug}/edit', [ProductVersionController::class, 'update'])->name('update');

                Route::post('/updateStatus', [ProductController::class, 'updateStatus'])->name('updateStatus');

                Route::delete('/delete', [ProductController::class, 'delete'])->name('delete');
                Route::delete('/destroy', [ProductController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [ProductController::class, 'restoreAll'])->name('restoreAll');

                Route::post('/getDataUsageType', [ProductController::class, 'getDataUsageTypeById'])->name('getDataUsageType');
                Route::post('/getDataModelSeries', [ProductController::class, 'getDataModelSeriesById'])->name('getDataModelSeries');
                Route::group(
                    [
                        'prefix' => '/{products:slug}',
                        'as' => 'productsVersion.',
                    ],
                    function () {
                        Route::get('/', [ProductVersionController::class, 'index'])->name('index');
                        Route::post('/getList', [ProductVersionController::class, 'getList'])->name('getList');

                        Route::get('/create', [ProductVersionController::class, 'create'])->name('create');
                        Route::post('/store', [ProductVersionController::class, 'store'])->name('store');

                        Route::get('/{productVersions:slug}/edit', [ProductVersionController::class, 'edit'])->name('edit');
                        Route::put('/{productVersions:slug}/edit', [ProductVersionController::class, 'update'])->name('update');

                        Route::post('/destroy-image', [ProductController::class, 'destroy_image'])->name('destroy-image');
                        Route::delete('/delete', [ProductVersionController::class, 'delete'])->name('delete');
                        Route::delete('/destroy', [ProductVersionController::class, 'destroy'])->name('destroy');
                        Route::post('/restoreAll', [ProductVersionController::class, 'restoreAll'])->name('restoreAll');
                    },
                );
            },
        );
        // Role route
        Route::group(
            [
                'prefix' => 'roles',
                'as' => 'roles.',
            ],
            function () {
                Route::get('/', [RoleController::class, 'index'])->name('index');
                Route::post('/getList', [RoleController::class, 'getList'])->name('getList');
                Route::get('/create', [RoleController::class, 'create'])->name('create');
                Route::post('/store', [RoleController::class, 'store'])->name('store');
                Route::get('/edit/{product:slug}', [RoleController::class, 'edit'])->name('edit');
                Route::put('/edit/{product:slug}', [RoleController::class, 'update'])->name('update');
                Route::delete('/delete', [RoleController::class, 'delete'])->name('delete');
            },
        );

        // Brand route

        Route::group(
            [
                'prefix' => 'brands',
                'as' => 'brands.',
            ],
            function () {
                Route::get('/', [BrandController::class, 'index'])->name('index');
                Route::post('/getList', [BrandController::class, 'getList'])->name('getList');
                Route::get('/create', [BrandController::class, 'create'])->name('create');
                Route::post('/store', [BrandController::class, 'store'])->name('store');
                Route::get('/edit/{brand:slug}', [BrandController::class, 'edit'])->name('edit');
                Route::put('/edit/{brand:slug}', [BrandController::class, 'update'])->name('update');
                Route::delete('/delete', [BrandController::class, 'delete'])->name('delete');
                Route::delete('/destroy', [BrandController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [BrandController::class, 'restoreAll'])->name('restoreAll');

                Route::group(
                    [
                        'prefix' => '/{brand:slug}',
                        'as' => 'modelSeries.',
                    ],
                    function () {
                        Route::get('/', [ModelSeriesController::class, 'index'])->name('index');
                        Route::post('/getList', [ModelSeriesController::class, 'getList'])->name('getList');
                        Route::get('/create', [ModelSeriesController::class, 'create'])->name('create');
                        Route::post('/store', [ModelSeriesController::class, 'store'])->name('store');
                        Route::get('/edit/{modelSeries:slug}', [ModelSeriesController::class, 'edit'])->name('edit');
                        Route::put('/edit/{modelSeries:slug}', [ModelSeriesController::class, 'update'])->name('update');
                        Route::delete('/delete', [ModelSeriesController::class, 'delete'])->name('delete');
                        Route::delete('/destroy', [ModelSeriesController::class, 'destroy'])->name('destroy');
                        Route::post('/restoreAll', [ModelSeriesController::class, 'restoreAll'])->name('restoreAll');
                    },
                );
            },
        );

        // Supplier route
        Route::group(
            [
                'prefix' => 'suppliers',
                'as' => 'suppliers.',
            ],
            function () {
                Route::get('/', [SupplierController::class, 'index'])->name('index');
                Route::post('/getList', [SupplierController::class, 'getList'])->name('getList');
                Route::get('/create', [SupplierController::class, 'create'])->name('create');
                Route::post('/store', [SupplierController::class, 'store'])->name('store');
                Route::get('/edit/{supplier:slug}', [SupplierController::class, 'edit'])->name('edit');
                Route::put('/edit/{supplier:slug}', [SupplierController::class, 'update'])->name('update');
                Route::delete('/delete', [SupplierController::class, 'delete'])->name('delete');
            },
        );

        // categoryProduct
        Route::group(
            [
                'prefix' => 'categoryProducts',
                'as' => 'categoryProducts.',
            ],
            function () {
                Route::get('/', [CategoryProductController::class, 'index'])->name('index');
                Route::post('/getList', [CategoryProductController::class, 'getList'])->name('getList');
                Route::get('/create', [CategoryProductController::class, 'create'])->name('create');
                Route::post('/store', [CategoryProductController::class, 'store'])->name('store');
                Route::get('/edit/{categoryProduct:slug}', [CategoryProductController::class, 'edit'])->name('edit');
                Route::put('/edit/{categoryProduct:slug}', [CategoryProductController::class, 'update'])->name('update');
                Route::delete('/delete', [CategoryProductController::class, 'delete'])->name('delete');
                Route::delete('/destroy', [BrandController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [BrandController::class, 'restoreAll'])->name('restoreAll');

                Route::group(
                    [
                        'prefix' => '/{categoryProduct:slug}',
                        'as' => 'usageTypes.',
                    ],
                    function () {
                        Route::get('/', [UsageTypeController::class, 'index'])->name('index');
                        Route::post('/getList', [UsageTypeController::class, 'getList'])->name('getList');
                        Route::get('/create', [UsageTypeController::class, 'create'])->name('create');
                        Route::post('/store', [UsageTypeController::class, 'store'])->name('store');
                        Route::get('/edit/{usageType:slug}', [UsageTypeController::class, 'edit'])->name('edit');
                        Route::put('/edit/{usageType:slug}', [UsageTypeController::class, 'update'])->name('update');
                        Route::delete('/delete', [UsageTypeController::class, 'delete'])->name('delete');
                        Route::delete('/destroy', [UsageTypeController::class, 'destroy'])->name('destroy');
                        Route::post('/restoreAll', [UsageTypeController::class, 'restoreAll'])->name('restoreAll');
                    },
                );
            },
        );

        //  Banner route
        Route::group(
            [
                'prefix' => 'banner',
                'as' => 'banners.',
            ],
            function () {
                Route::get('/', [BannerController::class, 'index'])->name('index');
                Route::post('/getList', [BannerController::class, 'getList'])->name('getList');
                Route::get('/create', [BannerController::class, 'create'])->name('create');
                Route::post('/store', [BannerController::class, 'store'])->name('store');
                Route::get('/edit/{banner:slug}', [BannerController::class, 'edit'])->name('edit');
                Route::put('/edit/{banner:slug}', [BannerController::class, 'update'])->name('update');
                Route::delete('/delete', [BannerController::class, 'delete'])->name('delete');
                Route::post('/updateStatus', [BannerController::class, 'updateStatus'])->name('updateStatus');
            },
        );

        // Inventory route
        Route::group(
            [
                'prefix' => 'inventories',
                'as' => 'inventories.',
            ],
            function () {
                Route::get('/', [InventoryController::class, 'index'])->name('index');
                Route::post('/getList', [InventoryController::class, 'getList'])->name('getList');
            },
        );

        // Inventory histories import
        Route::group(
            [
                'prefix' => 'stockImports',
                'as' => 'stockImports.',
            ],
            function () {
                Route::get('/', [StockImportController::class, 'index'])->name('index');
                Route::post('/getList', [StockImportController::class, 'getList'])->name('getList');
                Route::get('/create', [StockImportController::class, 'create'])->name('create');
                Route::post('/store', [StockImportController::class, 'store'])->name('store');
                Route::get('/details', [StockImportController::class, 'detail'])->name('detail');
                Route::get('/invoice/{id}', [StockImportController::class, 'exportPDF'])->name('exportPDF');
            },
        );

        // Inventory histories export
        Route::group(
            [
                'prefix' => 'stockExports',
                'as' => 'stockExports.',
            ],
            function () {
                Route::get('/', [StockExportController::class, 'index'])->name('index');
                Route::post('/getList', [StockExportController::class, 'getList'])->name('getList');
                Route::get('/export-details', [StockExportController::class, 'exportDetail'])->name('exportDetail');
            },
        );

        // Tag Route
        Route::group(
            [
                'prefix' => 'tags',
                'as' => 'tags.',
            ],
            function () {
                Route::get('/', [TagController::class, 'index'])->name('index');
                Route::post('/getList', [TagController::class, 'getList'])->name('getList');
                Route::get('/create', [TagController::class, 'create'])->name('create');
                Route::post('/store', [TagController::class, 'store'])->name('store');
                Route::get('/{tag:slug}/edit', [TagController::class, 'edit'])->name('edit');
                Route::put('/{tag:slug}/edit', [TagController::class, 'update'])->name('update');
                Route::delete('/delete', [TagController::class, 'delete'])->name('delete');
                Route::get('detail/{tag:slug}', [TagDetailController::class, 'index'])->name('detail');

                Route::group(
                    [
                        'prefix' => '/{tag:slug}',
                        'as' => 'tagDetail.',
                    ],
                    function () {
                        Route::post('/getList', [TagDetailController::class, 'getList'])->name('getList');
                        Route::get('/create', [TagDetailController::class, 'create'])->name('create');
                        Route::post('/store', [TagDetailController::class, 'store'])->name('store');
                        Route::get('/{tagDetail:slug}/edit', [TagDetailController::class, 'edit'])->name('edit');
                        Route::put('/{tagDetail:slug}/edit', [TagDetailController::class, 'update'])->name('update');
                        Route::delete('/delete', [TagDetailController::class, 'delete'])->name('delete');
                    },
                );
            },
        );
    },
);
