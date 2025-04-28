<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'members.'
], function() {
    Route::get('/',[MemberController::class, 'index'])->name('index');
});
