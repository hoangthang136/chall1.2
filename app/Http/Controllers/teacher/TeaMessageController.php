<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Messages\SendMessageRequest;
use App\Models\user;
use App\Models\User as ModelsUser;
use Illuminate\Foundation\Auth\User as AuthUser;

class TeaMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::where('receive_id', Auth::user()->id)->get();
        // chuyền param sang view
        return view('teacher.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
                return redirect()->route('tuser.show', $user[0])->with('success', 'Cập nhập thành công');
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
                return redirect()->route('tuser.show', $user[0])->with('success', 'Gửi thành công');
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
    public function edit(Message $tmessage)
    {
        $tuser = user::where('id', $tmessage->receive_id)->get();
        return redirect()->route('tuser.show', $tuser[0])->with(['edit' => $tmessage->content, 'id' => $tmessage->id]);
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
    public function destroy(Message $tmessage, user $tuser)
    {
        try {
            $tmessage->delete();
            $tuser = user::where('id', $tmessage->receive_id)->get();
            return redirect()->route('tuser.show', $tuser[0])->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
