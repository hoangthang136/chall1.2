<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function index() {
        $users = user::all();
        $user = Auth::user();
        return view('admin.index', compact('users','user'));
    }
}
