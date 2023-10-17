<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use App\Models\Message;
use App\Models\Assignments;
use App\Http\Requests\Messages\SendMessageRequest;
use App\Models\SubmitAssignments as subAss;
use App\Models\Challenges;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function login() {
        if (Auth::check() and Auth::user()->role == 'Student') {
            return redirect()->route('index');
        }
        if (Auth::check() and Auth::user()->role == 'Teacher') {
            return redirect()->route('teacher.index');
        }
        return view('layouts.login');
    }

    public function postLogin(Request $request) {
        $role = user::where('username', $request->username)->get();
        if (!empty($role[0])){
            if (Auth::attempt(['username'=>$request->username, 'password'=>$request->password, 'role'=>$role[0]->role])) {
                return redirect()->route('index');
            }
        }
        return redirect()->back()->with('error', 'Đăng nhập thất bại');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }


    // index
    public function index() {
        $users = user::where('role','!=','Administrator')->get();
        $user = Auth::user();
        return view('student.index', compact('users','user'));
    }
    // user index
    public function userindex()
    {
        // lấy tất cả các cột trong bảng user
        $users = user::where('role','!=','Administrator')->get();
        // chuyền param sang view
        return view('student.users.index', compact('users'));
    }

    // user detail
    public function userDetail(user $user)
    {
        //lấy thông tin của thằng đăng nhập
        $mess_sends = Message::where([['send_id', Auth::user()->id], ['receive_id', $user->id]])->get();
        return view('student.users.userDetail', compact('user', 'mess_sends'));
    }

    // mess index
    public function messindex()
    {
        $messages = Message::where('receive_id', Auth::user()->id)->get();
        // chuyền param sang view
        return view('student.message.index', compact('messages'));
    }

    // user mess store
    public function messStore(SendMessageRequest $request)
    {
        $mess = Message::where('id', $request->id)->get();
        if (!empty($mess[0])) {
            try {
                $mess[0]->update([
                    'content' => $request->content,
                ]);
                $user = user::where('id', $request->receive_id)->get();
                return redirect()->route('show', $user[0])->with('success', 'Cập nhập thành công');
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
                return redirect()->route('show', $user[0])->with('success', 'Gửi thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Gửi thất bại');
            }
        }   
    }

    // mess edit
    public function messEdit(Message $message)
    {
        $user = user::where('id', $message->receive_id)->get();
        return redirect()->route('show', $user[0])->with(['edit' => $message->content, 'id' => $message->id]);
    }

    // mess xoa
    public function messDestroy(Message $message, user $user)
    {
        try {
            $message->delete();
            $user = user::where('id', $message->receive_id)->get();
            return redirect()->route('show', $user[0])->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }

    // assign index
    public function assignindex()
    {
        $assignments = Assignments::all();
        return view('student.assignments.index', compact('assignments'));
    }

    // submit show
    public function submitshow(Assignments $submit)
    {
        return view('student.assignments.submit', compact('submit'));
    }

    // submitstore
    public function submitstore(Request $request)
    {
        try {
            $get_document = $request->file('upload_file_nopbai');
            if ($get_document) {
                $document_name = $get_document->getClientOriginalName();
                $get_document->move(public_path('uploads/sinhvien'), $document_name);
                subAss::create(['tensv' => Auth::user()->hoten, 'upload_file_nopbai'=> $document_name, 'sv_id' => Auth::user()->id, 'baitap_id' => $request->baitap_id]);
            }
            return redirect()->route('assignindex')->with('success', 'Nộp bài tập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Nộp bài tập thất bại');
        }
    }

    // chall index
    public function challindex()
    {
        $challenges = Challenges::all();
        return view('student.challenges.index', compact('challenges'));
    }

    // challdetail
    public function challdetail(Challenges $challenge)
    {
        return view('student.challenges.detail', compact('challenge'));
    }

    // chall edit
    public function challedit(Request $request, Challenges $challenge)
    {
        $dapan = substr($challenge->chall_file, 0, strlen($challenge->chall_file)-4);
        $filepath = public_path('uploads\challenges').'\\'.$challenge->chall_file;
        if ($dapan == $request->dapan) {
            if(File::exists($filepath)) {
                $content = File::get($filepath);
                $contentt = str_replace("\r\n", '\n',$content);
                return redirect()->route('challdetail', compact('challenge'))->with('content', $contentt);
            }
        }
        return redirect()->back()->with('error', 'Trả lời sai!');
    }
}
