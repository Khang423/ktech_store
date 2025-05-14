<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Banner;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        return view('outside.index',[
            'banners' => Banner::query()->where('status',StatusEnum::ON)->get(),
        ]);
    }
}
