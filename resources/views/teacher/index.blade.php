@extends('admin.master')
@section('title', 'Trang chủ')
@section('active-user', 'active')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="header">
                Users
            </div>
            <div class="card">
                <a href="{{route('tuser.create')}}">
                    <div class="add">
                        New <i class="pe-7s-plus"></i>
                    </div>
                </a>
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Full name</th>
                            <th>User name</th>
                            <th>Password</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width:17%">#</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->hoten}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->password}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <a href="{{route('tuser.show',$item)}}"><div class="detail" style="background-color: #4CAF50;">detail</div></a>
                                        @if ($item->role == 'Student')
                                            <a href="{{route('tuser.edit',$item)}}"><div class="edit" style="background-color: #03A9F4;">edit</div></a>
                                            <form action="{{route('tuser.destroy', $item)}}" method="post" style="display:inline-block">
                                                @method("DELETE")
                                                @csrf
                                                <input type="submit" class="delete" value="delete" style="border: none; background-color: #F44336;" onclick="return confirm('Bạn có chắc chắn muốn xoá?')">
                                            </form>
                                        @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('welcome')
    <script type="text/javascript">
        $(document).ready(function(){
            demo.initChartist();
            $.notify({
                message: "Welcome to <b>{{$user->role}}</b>."
            },{
                type: 'info',
                timer: 4000
            });
        });
    </script>
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