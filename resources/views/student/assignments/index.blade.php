@extends('admin.master')
@section('title', 'Assignments')
@section('active-assi', 'active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="header">
            List Assignments
        </div>
        <div class="card">
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th style="width: 25%">Due to</th>
                        <th>Description</th>
                        <th style="width: 20%">#</th>
                    </thead>
                    <tbody>
                        @if (empty($assignments[0]))
                           <tr>
                                <td>No assignments</td>
                                <td></td>
                                <td></td>
                            </tr> 
                        @else
                            @foreach ($assignments as $item)
                                <tr>
                                    <td>{{$item->updated_at}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>
                                        <a href="{{route('submitshow', $item)}}"><div class="detail" style="background-color: #4CAF50;">detail</div></a>
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