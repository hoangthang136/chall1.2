<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Challenges;
use Illuminate\Contracts\Cache\Store;
use RuntimeException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TeaChallengesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tchallenges = Challenges::all();
        return view('teacher.challenges.index', compact('tchallenges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.challenges.add');
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
            return redirect()->route('tchallenges.index')->with('success', 'Thêm trò chơi thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm trò chơi thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenges $tchallenge)
    {
        return view('teacher.challenges.detail', compact('tchallenge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Challenges $tchallenge)
    {
        $dapan = substr($tchallenge->chall_file, 0, strlen($tchallenge->chall_file)-4);
        $filepath = public_path('uploads\challenges').'\\'.$tchallenge->chall_file;
        if ($dapan == $request->dapan) {
            if(File::exists($filepath)) {
                $content = File::get($filepath);
                $contentt = str_replace("\r\n", '\n',$content);
                return redirect()->route('tchallenges.show', compact('tchallenge'))->with('content', $contentt);
            }
        }
        return redirect()->back()->with('error', 'Trả lời sai!');
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
    public function destroy(Challenges $tchallenge)
    {
        try {
            $tchallenge->delete();
            return redirect()->route('tchallenges.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
