@extends("layouts.front")
@section("content")
    <div class="row">
        <div class="header bg-success">
            <h3 class="text-white">
                <a href="{{url('front/setting')}}"><img src="{{asset("img/menu.png")}}" alt="menu" width="54"></a>
                បញ្ជីសំណើរ
                <a href="#" style="float: right;"><img src="{{asset("img/search.png")}}" alt="menu" width="40"></a>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-danger">កំពុងសាងសង់</h3>
        </div>
    </div>
@endsection