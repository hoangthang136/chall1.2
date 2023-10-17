@extends('admin.master')
@section('title', 'Message')
@section('active-mess', 'active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="header">
            Received message
        </div>
        <div class="card">
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th style="width: 25%">Time</th>
                        <th>Content</th>
                        <th style="width: 25%">From</th>
                    </thead>
                    <tbody>
                        @if (empty($messages[0]))
                           <tr>
                                <td>No message receive</td>
                                <td></td>
                                <td></td>
                            </tr> 
                        @else
                            @foreach ($messages as $message)
                                <tr>
                                    <td>{{$message->updated_at}}</td>
                                    <td>{{$message->content}}</td>
                                    <td>{{$message->send_name}}</td>
                                </tr> 
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection