@extends('admin.master')
@section('title', 'Challenges')
@section('active-chall', 'active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="header">
            Challenges
        </div>
        <div class="card">
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th>Challenge name</th>
                        <th style="width: 30%">#</th>
                    </thead>
                    <tbody>
                        @if (empty($challenges[0]))
                           <tr>
                                <td>No challenges</td>
                                <td></td>
                            </tr> 
                        @else
                            @foreach ($challenges as $challenge)
                                <tr>
                                    <td>{{$challenge->chall_name}}</td>
                                    <td>
                                        <a href="{{route('challdetail', $challenge)}}"><div class="detail" style="background-color: #4CAF50;">detail</div></a>
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