<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountRequest;
use App\Models\user;

class AdminController extends Controller
{
    public function login() {
        if (Auth::check() and Auth::user()->role == 'Administrator') {
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    public function postLogin(Request $request) {
        $role = user::where('username', $request->username)->get();
        if (!empty($role[0])){
            if (Auth::attempt(['username'=>$request->username, 'password'=>$request->password, 'role'=>$role[0]->role])) {
                return redirect()->route('admin.index');
            }
        }
        return redirect()->back()->with('error', 'Đăng nhập thất bại');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function account() {
        return view('layouts.account');
    }

    public function postAccount(AccountRequest $request) {
        $request->merge(['password' => bcrypt($request->password)]);
        $user = Auth::user();
        try {
            $user->update($request->all());
            return redirect()->route('account')->with('success', 'Thay đổi thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thay đổi thất bại');
        }
    }
}
