<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenges;
use Illuminate\Contracts\Cache\Store;
use RuntimeException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ChallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challenges = Challenges::all();
        return view('admin.pages.challenges.index', compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.challenges.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $get_document = $request->file('upload_file_chall');
            if ($get_document) {
                $document_name = $get_document->getClientOriginalName();
                $get_document->move(public_path('uploads/challenges'), $document_name);
                Challenges::create(['chall_name' => $request->chall_name, 'hint' => $request->hint,'chall_file' => $document_name]);
            }
            return redirect()->route('challenges.index')->with('success', 'Thêm trò chơi thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm trò chơi thất bại');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenges $challenge)
    {
        return view('admin.pages.challenges.detail', compact('challenge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // đáp án
    public function edit(Request $request, Challenges $challenge)
    {
        $dapan = substr($challenge->chall_file, 0, strlen($challenge->chall_file)-4);
        $filepath = public_path('uploads\challenges').'\\'.$challenge->chall_file;
        if ($dapan == $request->dapan) {
            if(File::exists($filepath)) {
                $content = File::get($filepath);
                $contentt = str_replace("\r\n", '\n',$content);
                return redirect()->route('challenges.show', compact('challenge'))->with('content', $contentt);
            }
        }
        return redirect()->back()->with('error', 'Trả lời sai!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challenges $challenge)
    {
        try {
            $challenge->delete();
            return redirect()->route('challenges.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
