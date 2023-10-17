@extends('admin.master')
@section('title','Thêm Challenges')
@section('active-chall', 'active')
@section('content')
    <div style="margin-left: 40px">
        <form action="{{route('challenges.store')}}" method="POST" enctype="multipart/form-data">
            <h3 style="margin-top: 0px; margin-bottom: 20px;color: #673AB7;"><b>ADD CHALLENGES</b></h3>
            <div class="form-group row">
                <label for="inputFullname3" class="col-sm-2 col-form-label">Challenges name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="chall_name" id="inputFullname3" placeholder="Title" value="{{old('title')}}">
                </div>
            </div>
            @error('chall_name')
                <div class="col-sm-2"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputFullname3" class="col-sm-2 col-form-label">Hint</label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="hint" rows="3"></textarea>
                </div>
            </div>
            @error('hint')
                <div class="col-sm-2"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="exampleFormControlFile1" class="col-sm-2 col-form-label">Upload File</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control-file form-control" name="upload_file_chall" id="exampleFormControlFile1">
                </div>
            </div>
            @csrf
            <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection