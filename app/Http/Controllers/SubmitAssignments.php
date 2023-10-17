<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubmitAssignments as subAss;
use App\Models\Assignments;
use Illuminate\Support\Facades\Auth;

class SubmitAssignments extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        try {
            $get_document = $request->file('upload_file_nopbai');
            if ($get_document) {
                $document_name = $get_document->getClientOriginalName();
                $get_document->move(public_path('uploads/sinhvien'), $document_name);
                subAss::create(['tensv' => Auth::user()->hoten, 'upload_file_nopbai'=> $document_name, 'sv_id' => Auth::user()->id, 'baitap_id' => $request->baitap_id]);
            }
            return redirect()->route('assignments.index')->with('success', 'Nộp bài tập thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Nộp bài tập thất bại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignments $submit)
    {
        return view('student.assignments.submit', compact('submit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
