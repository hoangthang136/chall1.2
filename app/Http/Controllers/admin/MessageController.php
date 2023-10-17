<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Messages\SendMessageRequest;
use App\Models\user;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::where('receive_id', Auth::user()->id)->get();
        // chuyền param sang view
        return view('admin.pages.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //hiển thị bảng trong thằng detail
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SendMessageRequest $request)
    {
        $mess = Message::where('id', $request->id)->get();
        if (!empty($mess[0])) {
            try {
                $mess[0]->update([
                    'content' => $request->content,
                ]);
                $user = user::where('id', $request->receive_id)->get();
                return redirect()->route('user.show', $user[0])->with('success', 'Cập nhập thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Cập nhập thất bại');
            }   
        }else {
            try {
                Message::create([
                    'send_id' => Auth::user()->id,
                    'send_name' => Auth::user()->hoten,
                    'receive_id' => $request->receive_id,
                    'receive_name' => $request->receive_name,
                    'content' => $request->content,
                ]);
                $user = user::where('id', $request->receive_id)->get();
                return redirect()->route('user.show', $user[0])->with('success', 'Gửi thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Gửi thất bại');
            }
        }   
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        $user = user::where('id', $message->receive_id)->get();
        return redirect()->route('user.show', $user[0])->with(['edit' => $message->content, 'id' => $message->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message, user $user)
    {
        try {
            $message->delete();
            $user = user::where('id', $message->receive_id)->get();
            return redirect()->route('user.show', $user[0])->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
