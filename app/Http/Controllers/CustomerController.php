<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function profile(){
        return view('outside.profile',[
            'title' => 'Ktech - Profile'
        ]);
    }
}
