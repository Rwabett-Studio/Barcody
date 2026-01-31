<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function admin(){
        return view('admin.index');
    }

    public function categories(){
        return view('admin.categories.index');
    }

    public function events(){
        return view('admin.events.index');
    }
}
