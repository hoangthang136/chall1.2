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
                <div class="content table-responsive table-full-width">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>ID</th>
                            <th>Full name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width:17%">#</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->hoten}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>
                                        <a href="{{route('show' , $item)}}"><div class="detail" style="background-color: #4CAF50;">detail</div></a>
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
