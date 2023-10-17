<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // lấy tất cả các cột trong bảng user
        $users = user::all();
        // chuyền param sang view
        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        try {
            user::create($request->all());
            return redirect()->route('user.index')->with('success', 'Thêm mới thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //lấy thông tin của thằng đăng nhập
        $mess_sends = Message::where([['send_id', Auth::user()->id], ['receive_id', $user->id]])->get();
        $session = Auth::user();
        return view('admin.pages.users.detail', compact('user', 'mess_sends'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, user $user)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        try {
            $user->update($request->all());
            return redirect()->route('user.index')->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhập thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        try {
            $messages = Message::where('receive_id', $user->id)->get();
            foreach($messages as $message) {
                $message->delete();
            }
            $user->delete();
            return redirect()->route('user.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
