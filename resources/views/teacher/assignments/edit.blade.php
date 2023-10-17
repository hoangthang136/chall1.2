@extends('admin.master')
@section('title','Sửa bài tập')
@section('active-assi', 'active')
@section('content')
    <div style="margin-left: 40px">
        <form action="{{route('tassignments.update', $tassignment)}}" method="POST" enctype="multipart/form-data">
            <h3 style="margin-top: 0px; margin-bottom: 20px;color: #673AB7;"><b>UPDATE ASSIGNMENT</b></h3>
            <div class="form-group row">
                <label for="inputFullname3" class="col-sm-1 col-form-label">Title</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="title" id="inputFullname3" placeholder="Title" value="{{old('title')?old('title'):$tassignment->title}}">
                </div>
            </div>
            @error('title')
                <div class="col-sm-1"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="exampleFormControlFile1" class="col-sm-1 col-form-label">Upload File</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control-file form-control" name="upload_file_baitap" id="exampleFormControlFile1">
                </div>
            </div>
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection