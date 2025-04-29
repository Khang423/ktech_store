<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::group([
    ], function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
    });

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
});
