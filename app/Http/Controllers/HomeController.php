<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function __construct(){
        
    }

    // dùng để hiển thị luôn một giá trị nào đó
    public function index() {
        return view('layouts.admin');
    }

}
