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
    });
});
