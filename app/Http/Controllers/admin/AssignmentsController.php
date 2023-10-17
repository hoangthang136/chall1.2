<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignments;
use App\Models\SubmitAssignments;
use Illuminate\Support\Facades\Redis;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignments::all();
        return view('admin.pages.assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.assignments.add');
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
            return redirect()->route('assignments.index')->with('success', 'Thêm bài tập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Thêm bài tập thất bại');
        }
        
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignments $assignment)
    {
        $subAss = SubmitAssignments::where('baitap_id', $assignment->id)->get();
        return view('admin.pages.assignments.detail', compact('assignment','subAss'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignments $assignment)
    {
        // dd($assignment);
        return view('admin.pages.assignments.edit', compact('assignment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignments $assignment)
    {

        try {
            $oldPath = $assignment->upload_file_baitap;
            $title = $request->title;
            $get_document = $request->file('upload_file_baitap');
            if ($get_document) {
                $document_name = $get_document->getClientOriginalName();
                $get_document->move(public_path('uploads/giaovien'), $document_name);
                $assignment->update(['title' => $title, 'upload_file_baitap'=> $document_name]);
            }
            return redirect()->route('assignments.show', $assignment)->with('success', 'Cập nhập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Cập nhập thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignments $assignment)
    {
        try {
            $submitAssignments = SubmitAssignments::where('baitap_id', $assignment->id)->get();
            foreach($submitAssignments as $message) {
                $message->delete();
            }
            $assignment->delete();
            return redirect()->route('assignments.index')->with('success', 'Xoá thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Xoá thất bại');
        }
    }
}
