@extends('admin.master')
@section('title','Thêm người dùng')
@section('active-user', 'active')
@section('content')
    <div style="margin-left: 40px">
        <form action="{{route('tuser.store')}}" method="POST">
            <h3 style="margin-top: 0px; margin-bottom: 20px;color: #673AB7;"><b>ADD USERS</b></h3>
            <div class="form-group row">
                <label for="inputFullname3" class="col-sm-1 col-form-label">Full name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="hoten" id="inputFullname3" placeholder="Full name" value="{{old('hoten')}}">
                </div>
            </div>
            @error('hoten')
                <div class="col-sm-1"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputUsername3" class="col-sm-1 col-form-label">Username</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="username" id="inputUsername3" placeholder="Username" value="{{old('username')}}">
                </div>
            </div>
            @error('username')
                <div class="col-sm-1"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-1 col-form-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control"name="password" id="inputPassword3" placeholder="Password" value="{{old('password')}}">
                </div>
            </div>
            @error('password')
                <div class="col-sm-1"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-1 col-form-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" value="{{old('email')}}">
                </div>
            </div>
            @error('email')
                <div class="col-sm-1"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputUsername3" class="col-sm-1 col-form-label">Phone</label>
                <div class="col-sm-8">
                  <input type="tel" class="form-control" name="phone" id="inputPhone3" placeholder="Phone" value="{{old('phone')}}">
                </div>
            </div>
            @error('phone')
                <div class="col-sm-1"></div>
                <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <input type="hidden" name="role" value="Student">
            @csrf
            <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection