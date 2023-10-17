<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;

class TeaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = user::where('role','!=','Administrator')->get();
        // chuyền param sang view
        return view('teacher.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.users.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        try {
            user::create($request->all());
            return redirect()->route('tuser.index')->with('success', 'Thêm mới thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm mới thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(user $tuser)
    {
        $tmess_sends = Message::where([['send_id', Auth::user()->id], ['receive_id', $tuser->id]])->get();
        return view('teacher.users.detail', compact('tuser', 'tmess_sends'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $tuser)
    {
        return view('teacher.users.edit', compact('tuser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, user $tuser)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        try {
            $tuser->update($request->all());
            return redirect()->route('tuser.index')->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhập thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $tuser)
    {
        try {
            $tmessages = Message::where('receive_id', $tuser->id)->get();
            foreach($tmessages as $message) {
                $message->delete();
            }
            $tuser->delete();
            return redirect()->route('tuser.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
