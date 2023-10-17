<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;

class TeacherController extends Controller
{
    public function index() {
        $users = user::where('role','!=','Administrator')->get();
        $user = Auth::user();
        return view('teacher.index', compact('users','user'));
    }
}
