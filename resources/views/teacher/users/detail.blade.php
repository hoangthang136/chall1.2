@extends('admin.master')
@section('title', 'Thông tin chi tiết')
@section('active-user', 'active')
@section('content')
    <div class="row de-cont">
        <div class="row">
            <div class="col anhdd">
                <img src="{{asset('assets')}}\admin\img\user.png" alt="anh dai dien" style="width: 100%">
            </div>
            <div class="col de-info">
                <h2><b>{{ $tuser->hoten }}</b></h2>
                <p><i>{{ $tuser->role }}</i></p>
                <p><i class="fa-solid fa-envelope-open-text" style="margin-right: 5px"></i>{{ $tuser->email }}</p>
                <p><i class="fa-solid fa-square-phone" style="margin-right: 5px"></i>{{ $tuser->phone }}</p>
                <div class="send-mess" >
                    <div class="header">
                        Send message
                    </div>
                    <div class="card">
                        <div class="content table-responsive table-full-width">
                            <form action="{{route('tmessage.store')}}" method="POST" style="margin: 0px 20px">
                                @csrf
                                @if ($message = Session::get('id')) 
                                <input type="hidden" name="id" value="{{ $message }}">
                                @endif
                                <input type="hidden" name="receive_id" value="{{ $tuser->id }}">
                                <input type="hidden" name="receive_name" value="{{ $tuser->hoten }}">
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="content" rows="3">@if ($message = Session::get('edit')) {{$message}} @endif</textarea>
                                @error('content')
                                    <div class="col-sm-1"></div>
                                    <span class="col-sm-11" style="color: red; margin-bottom: 10px">{{$tmessage}}</span>
                                @enderror
                                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Send<i class="fa-solid fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="de-mess">
                <div class="header">
                    Message sent to {{ $tuser->hoten }}
                </div>
                <div class="card">
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th style="width: 25%">Timer</th>
                                <th>ConTent</th>
                                <th style="width: 20%">#</th>
                            </thead>
                            <tbody>
                                @if (empty($tmess_sends[0]))
                                <tr>
                                    <td>No message send</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @else
                                    @foreach ($tmess_sends as $mess_send)
                                    <tr>
                                        <td>{{$mess_send->updated_at}}</td>
                                        <td style="text-align: justify;">{{$mess_send->content}}</td>
                                        <td>
                                            <a href="{{route('tmessage.edit', $mess_send)}}"><div class="edit" style="background-color: #03A9F4;">edit</div></a>
                                            <form action="{{route('tmessage.destroy', $mess_send)}}" method="post" style="display:inline-block">
                                                @method("DELETE")
                                                @csrf
                                                <input type="submit" class="delete" value="delete" style="border: none; background-color: #F44336;" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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