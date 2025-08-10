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
use App\Http\Controllers\MemberRoleController;
use App\Http\Controllers\ModelSeriesController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductVersionController;
use App\Http\Controllers\StockExportController;
use App\Http\Controllers\StockImportController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TagDetailController;
use App\Http\Controllers\UsageTypeController;
use App\Mail\CheckPassMail;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
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

        Route::get('/product', [HomeController::class, 'showProduct'])->name('showProduct');
        // check auth status
        Route::post('/auth-status', [AuthController::class, 'authCheck'])->name('authStatus');

        Route::post('/productFillter', [HomeController::class, 'productFillter'])->name('productFillter');

        Route::get('/thanks', [HomeController::class, 'thanks'])->name('thanks');

        Route::get('/order-invoice', [HomeController::class, 'orderInvoice'])->name('orderInvoice');
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

        Route::post('customer/delete-address', [CustomerController::class, 'deleteAddress'])->name('deleteAddress');
        Route::post('customer/get-data-order', [CustomerController::class, 'getDataOrder'])->name('getDataOrder');
        Route::post('customer/get-data-order-item', [CustomerController::class, 'getDataOrderItem'])->name('getDataOrderItem');

        Route::post('customer/profile/info-update', [CustomerController::class, 'infoUpdate'])->name('infoUpdate');
        Route::post('customer/profile/address-update', [CustomerController::class, 'addressUpdate'])->name('addressUpdate');
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
            Route::get('/get-data-chart', [AdminController::class, 'getData'])->name('getData');
            Route::post('/get-data-chart-by-date', [AdminController::class, 'chartSearch'])->name('chartSearch');
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

                Route::delete('/forceDelete', [MemberController::class, 'forceDelete'])->name('forceDelete');
                Route::delete('/destroy', [MemberController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [MemberController::class, 'restoreAll'])->name('restoreAll');
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

                Route::get('/{products:slug}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('/{products:slug}/edit', [ProductController::class, 'update'])->name('update');

                Route::post('/updateStatus', [ProductController::class, 'updateStatus'])->name('updateStatus');

                Route::post('/destroy-image', [ProductController::class, 'destroy_image'])->name('destroy-image');
                Route::delete('/forceDelete', [ProductController::class, 'forceDelete'])->name('forceDelete');
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

                        Route::get('/{product_version:slug}/edit', [ProductVersionController::class, 'edit'])->name('edit');
                        Route::put('/{product_version:slug}/edit', [ProductVersionController::class, 'update'])->name('update');

                        Route::delete('/delete', [ProductVersionController::class, 'delete'])->name('delete');

                        Route::delete('/forceDelete', [ProductVersionController::class, 'forceDelete'])->name('forceDelete');
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

                Route::get('/edit/{role:slug}', [RoleController::class, 'edit'])->name('edit');
                Route::put('/edit/{role:slug}', [RoleController::class, 'update'])->name('update');

                Route::delete('/forceDelete', [RoleController::class, 'forceDelete'])->name('forceDelete');
                Route::delete('/destroy', [RoleController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [RoleController::class, 'restoreAll'])->name('restoreAll');

                Route::group(
                    [
                        'prefix' => '/{role:slug}',
                        'as' => 'memberRoles.',
                    ],
                    function () {
                        Route::get('/', [MemberRoleController::class, 'index'])->name('index');
                        Route::post('/getList', [MemberRoleController::class, 'getList'])->name('getList');

                        Route::get('/create', [MemberRoleController::class, 'create'])->name('create');
                        Route::post('/store', [MemberRoleController::class, 'store'])->name('store');

                        Route::get('/edit/{memberRole:role_id}', [MemberRoleController::class, 'edit'])->name('edit');
                        Route::put('/edit/{memberRole:role_id}', [MemberRoleController::class, 'update'])->name('update');

                        Route::delete('/forceDelete', [MemberRoleController::class, 'forceDelete'])->name('forceDelete');
                        Route::delete('/destroy', [MemberRoleController::class, 'destroy'])->name('destroy');
                        Route::post('/restoreAll', [MemberRoleController::class, 'restoreAll'])->name('restoreAll');
                    },
                );
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

                Route::delete('/forceDelete', [BrandController::class, 'forceDelete'])->name('forceDelete');
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

                        Route::delete('/forceDelete', [ModelSeriesController::class, 'forceDelete'])->name('forceDelete');
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

                Route::delete('/forceDelete', [SupplierController::class, 'forceDelete'])->name('forceDelete');
                Route::delete('/destroy', [SupplierController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [SupplierController::class, 'restoreAll'])->name('restoreAll');
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

                Route::delete('/forceDelete', [CategoryProductController::class, 'forceDelete'])->name('forceDelete');
                Route::delete('/destroy', [CategoryProductController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [CategoryProductController::class, 'restoreAll'])->name('restoreAll');

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

                        Route::delete('/forceDelete', [UsageTypeController::class, 'forceDelete'])->name('forceDelete');
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

                Route::delete('/forceDelete', [BannerController::class, 'forceDelete'])->name('forceDelete');
                Route::delete('/destroy', [BannerController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [BannerController::class, 'restoreAll'])->name('restoreAll');

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

                Route::group(
                    [
                        'prefix' => '{products:slug}',
                        'as' => 'details.',
                    ],
                    function () {
                        Route::get('/', [InventoryController::class, 'index_detail'])->name('index');
                        Route::post('/getListDetail', [InventoryController::class, 'getListDetail'])->name('getList');
                    },
                );
            },
        );

        // stock imports route
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
                Route::get('/{stockImport:ref_code}/details', [StockImportController::class, 'detail'])->name('detail');
                Route::get('/invoice/{id}', [StockImportController::class, 'exportPDF'])->name('exportPDF');
                Route::post('/getDataProduct', [StockImportController::class, 'getDataProduct'])->name('getDataProduct');
                Route::post('/getDataProductVersion', [StockImportController::class, 'getDataProductVersion'])->name('getDataProductVersion');
                Route::post('/get-data-stock-import-detail', [StockImportController::class, 'getDataStockImportDetail'])->name('getDataStockImportDetail');
                Route::post('/update-status', [StockImportController::class, 'updateStatus'])->name('updateStatus');
            },
        );

        // stock export route
        Route::group(
            [
                'prefix' => 'stockExports',
                'as' => 'stockExports.',
            ],
            function () {
                Route::get('/', [StockExportController::class, 'index'])->name('index');
                Route::post('/getList', [StockExportController::class, 'getList'])->name('getList');
                Route::get('/create', [StockExportController::class, 'create'])->name('create');
                Route::post('/store', [StockExportController::class, 'store'])->name('store');
                Route::post('/update-status', [StockExportController::class, 'updateStatus'])->name('updateStatus');
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

                Route::delete('/forceDelete', [TagController::class, 'forceDelete'])->name('forceDelete');
                Route::delete('/destroy', [TagController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [TagController::class, 'restoreAll'])->name('restoreAll');

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

                        Route::delete('/forceDelete', [TagDetailController::class, 'forceDelete'])->name('forceDelete');
                        Route::delete('/destroy', [TagDetailController::class, 'destroy'])->name('destroy');
                        Route::post('/restoreAll', [TagDetailController::class, 'restoreAll'])->name('restoreAll');
                    },
                );
            },
        );

        // Order Route
        Route::group(
            [
                'prefix' => 'orders',
                'as' => 'orders.',
            ],
            function () {
                Route::get('/', [OrderController::class, 'index'])->name('index');
                Route::post('/getList', [OrderController::class, 'getList'])->name('getList');
                Route::post('/update-status', [OrderController::class, 'updateStatus'])->name('updateStatus');
                Route::delete('/forceDelete', [OrderController::class, 'forceDelete'])->name('forceDelete');
                Route::delete('/destroy', [OrderController::class, 'destroy'])->name('destroy');
                Route::post('/restoreAll', [OrderController::class, 'restoreAll'])->name('restoreAll');
                Route::get('/export-invoice/{order:order_code}', [OrderController::class, 'exportInvoice'])->name('exportInvoice');
            },
        );
        // Discount Route

        // Order Route
        Route::group(
            [
                'prefix' => 'customer',
                'as' => 'customers.',
            ],
            function () {
                Route::get('/', [CustomerController::class, 'index'])->name('index');
                Route::post('/getList', [CustomerController::class, 'getList'])->name('getList');
            },
        );
    },
);
