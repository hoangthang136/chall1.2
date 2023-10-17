@extends('admin.master')
@section('title', 'Danh sách nộp bài tập')
@section('active-assi', 'active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="header">
            Assignment [ {{$tassignment->title}} ]
        </div>
        <div class="card">
            <div class="col-md-12" style="margin-top: 20px">
                <div class="col-md-8">
                    File: <a href="{{asset('uploads/giaovien')}}/{{$tassignment->upload_file_baitap}}">{{$tassignment->upload_file_baitap}}</a>
                </div>
                <div class="col-md-4" style="color: red">
                    Due to: {{$tassignment->updated_at}}
                </div>
            </div>
            <a href="{{ route('tassignments.edit', $tassignment) }}">
                <div class="add">
                    Change file
                </div>
            </a>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <th style="width: 25%">Time submit</th>
                        <th>File</th>
                        <th style="width: 30%">Student</th>
                    </thead>
                    <tbody>
                        @if (empty($subAss[0]))
                           <tr>
                                <td>No assignments have been submitted yet</td>
                                <td></td>
                                <td></td>
                            </tr> 
                        @else
                            @foreach ($subAss as $item)
                                <tr>
                                    <td>{{$item->updated_at}}</td>
                                    <td><a href="{{asset('uploads/sinhvien')}}/{{$item->upload_file_nopbai}}">{{$item->upload_file_nopbai}}</a></td>
                                    <td>{{$item->tensv}}</td>
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