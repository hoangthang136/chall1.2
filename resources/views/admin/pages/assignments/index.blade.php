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
            <a href="{{route('assignments.create')}}">
                <div class="add">
                    New <i class="pe-7s-plus"></i>
                </div>
            </a>
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
                                        
                                        @if (Auth::user()->role == 'Administrator' || Auth::user()->role == 'Teacher')
                                            {{-- giáo viên, admin --}}
                                            <a href="{{route('assignments.show', $item)}}"><div class="detail" style="background-color: #4CAF50;">detail</div></a>
                                        @else
                                            {{-- sinh vien --}}
                                        <a href="{{route('submit.show', $item)}}"><div class="detail" style="background-color: #4CAF50;">detail</div></a>
                                        @endif
                                        <form action="{{route('assignments.destroy', $item)}}" method="post" style="display:inline-block">
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