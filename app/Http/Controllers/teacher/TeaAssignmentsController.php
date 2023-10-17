<?php

namespace App\Http\Controllers\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignments;
use App\Models\SubmitAssignments;
use Illuminate\Support\Facades\Redis;

class TeaAssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tassignments = Assignments::all();
        return view('teacher.assignments.index', compact('tassignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.assignments.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $title = $request->title;
            $get_document = $request->file('upload_file_baitap');
            if ($get_document) {
                $document_name = $get_document->getClientOriginalName();
                $get_document->move(public_path('uploads/giaovien'), $document_name);
                Assignments::create(['title' => $title, 'upload_file_baitap'=> $document_name]);
            }
            return redirect()->route('tassignments.index')->with('success', 'Thêm bài tập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm bài tập thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignments $tassignment)
    {
        $subAss = SubmitAssignments::where('baitap_id', $tassignment->id)->get();
        return view('teacher.assignments.detail', compact('tassignment','subAss'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignments $tassignment)
    {
        return view('teacher.assignments.edit', compact('tassignment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignments $tassignment)
    {
        try {
            $oldPath = $tassignment->upload_file_baitap;
            $title = $request->title;
            $get_document = $request->file('upload_file_baitap');
            if ($get_document) {
                $document_name = $get_document->getClientOriginalName();
                $get_document->move(public_path('uploads/giaovien'), $document_name);
                $tassignment->update(['title' => $title, 'upload_file_baitap'=> $document_name]);
            }
            return redirect()->route('tassignments.show', $tassignment)->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhập thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignments $tassignment)
    {
        try {
            $submitAssignments = SubmitAssignments::where('baitap_id', $tassignment->id)->get();
            foreach($submitAssignments as $message) {
                $message->delete();
            }
            $tassignment->delete();
            return redirect()->route('tassignments.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
