@extends('admin.master')
@section('title', $challenge->chall_name)
@section('active-chall', 'active')
@section('content')
    <div class="col-sm-12" style="text-align: center">
        <h1 class="col-sm-12"><b>{{$challenge->chall_name}}<b></h1>
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary" onclick="alert('{{$challenge->hint}}')">Show hint <i class="fa-solid fa-lightbulb"></i></button>
        </div>
        <form action="{{route('challenges.edit', $challenge)}}" method="POST" class="col-sm-12">
            <div class="col-sm-6" style="margin: 30px 0px;transform: translateX(50%);">
                  <input type="text" class="form-control" name="dapan" id="inputFullname3" placeholder="Type you answer" value="{{old('dapan')}}">
            </div>
            @csrf
            @method("GET")
            <div class="col-sm-12">
                <button type="submit" class="btn btn-primary">Submit</i></button>
            </div>
        </form>
    </div>
    @if ($message = Session::get('content'))
        <script>
            alert("Xin chúc mừng bạn đã trả lời đúng!!!\nNội dung:\n{{$message}}");
        </script>
    @endif
@endsection

@section('welcome')
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