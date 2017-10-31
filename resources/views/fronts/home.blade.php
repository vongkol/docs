@extends("layouts.front")
@section("content")
    <div class="row">
        <div class="header bg-primary">
            <h3 class="text-white">
                <a href="{{url('front/setting')}}"><img src="{{asset("img/menu.png")}}" alt="menu" width="54"></a>
                User Settings
                <a href="{{url('/front/search')}}" style="float: right;"><img src="{{asset("img/search.png")}}" alt="menu" width="40"></a>
            </h3>
        </div>
    </div>
    <div class="row">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    @foreach($sliders as $slider)
                    <div class="item active">
                        <img src="{{asset("uploads/slider/".$slider->file_name)}}" alt="">
                        <div class="carousel-caption">
                            {{$slider->description}}
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">មុន</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">បន្ទាប់</span>
                </a>
            </div>
    </div>
@endsection