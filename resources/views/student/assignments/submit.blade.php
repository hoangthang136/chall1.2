@extends('admin.master')
@section('title', 'Nộp bài tập')
@section('active-assi', 'active')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="header">
            Assignment [ {{$submit->title}} ]
        </div>
        <div class="card">
            <div class="col-md-12" style="margin-top: 20px">
                <div class="col-md-8">
                    File: <a href="{{asset('uploads/giaovien')}}/{{$submit->upload_file_baitap}}">{{$submit->upload_file_baitap}}</a>
                </div>
                <div class="col-md-4" style="color: red">
                    Due to: {{$submit->updated_at}}
                </div>
            </div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <div class="col-md-12" style="margin-top: 30px"> Turn in </div>
                    <div class="col-md-12">
                        <form action="{{route('submitstore')}}" method="POST" enctype="multipart/form-data">
                            <div class="form-group row">
                                <div class="col-sm-12" style="margin-top: 10px">
                                    <input type="hidden" name="baitap_id" value="{{$submit->id}}">
                                    <input type="file" class="form-control-file form-control" name="upload_file_nopbai" id="exampleFormControlFile1">
                                </div>
                            </div>
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-10">
                                  <button type="submit" class="btn btn-primary">Turn in</button>
                                </div>
                            </div>
                        </form>
                    </div>
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