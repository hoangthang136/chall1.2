@extends('admin.master')
@section('title','Tài Khoản')
@section('content')
    <div style="margin-left: 40px">
        <form action="{{route('postAccount')}}" method="POST">
            <h3 style="margin-top: 0px; margin-bottom: 20px;color: #673AB7;"><b>CHANGE ACCOUNT</b></h3>
            <div class="form-group row">
                <label for="inputFullname3" class="col-sm-2 col-form-label">Full name</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control" name="hoten" id="inputFullname3" value="{{Auth::user()->hoten}}" style="color: black; ">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputUsername3" class="col-sm-2 col-form-label" >Username</label>
                <div class="col-sm-8">
                  <input type="text" readonly class="form-control" name="username" id="inputUsername3" placeholder="Username" value="{{Auth::user()->username}}" style="color: black; ">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Change Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password" value="{{old('password')}}">
                </div>
            </div>
            @error('password')
                <div class="col-sm-2"></div>
                <span class="col-sm-10" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password Confirm</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" name="passwordConfirm" id="inputPassword3" placeholder="Password Confirm" value="{{old('passwordConfirm')}}">
                </div>
            </div>
            @error('passwordConfirm')
                <div class="col-sm-2"></div>
                <span class="col-sm-10" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" value="{{old('email')?old('email'):Auth::user()->email}}">
                </div>
            </div>
            @error('email')
                <div class="col-sm-2"></div>
                <span class="col-sm-10" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            <div class="form-group row">
                <label for="inputUsername3" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-8">
                  <input type="tel" class="form-control" name="phone" id="inputPhone3" placeholder="Phone" value="{{old('phone')?old('email'):Auth::user()->phone}}">
                </div>
            </div>
            @error('phone')
                <div class="col-sm-2"></div>
                <span class="col-sm-10" style="color: red; margin-bottom: 10px">{{$message}}</span>
            @enderror
            @csrf
            <div class="form-group row">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Chagne</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('welcome')
    @if ($message = Session::get('success'))
    <script type="text/javascript">
        $(document).ready(function(){
            demo.initChartist();
            $.notify({
                message: '{{$message}}'
            },{
                type: 'info',
                timer: 4000
            });
        });
    </script>
@endif
@if ($message = Session::get('error'))
    <script type="text/javascript">
        $(document).ready(function(){
            demo.initChartist();
            $.notify({
                message: '{{$message}}'
            },{
                type: 'info',
                timer: 4000
            });
        });
    </script>
@endif
@endsection