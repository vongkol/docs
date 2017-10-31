@extends("layouts.front")
@section("content")
    <div class="row">
        <div class="header bg-primary">
            <h3 class="text-white">
                <a href="{{url('front/setting')}}"><img src="{{asset("img/menu.png")}}" alt="menu" width="54"></a>
                បញ្ជីឯកសារ
                <a href="{{url('/front/search')}}" style="float: right;"><img src="{{asset("img/search.png")}}" alt="menu" width="40"></a>
            </h3>
        </div>
        <div class="sub-title">
            <img src="{{asset("img/marker.png")}}" alt="" width="15">
            {{$sub2->name}} > {{$sub3->name}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <ul class="folder-list">
                @foreach($docs as $doc)
                    <li>
                        <a href="{{asset('uploads/'.$doc->file_name)}}" target="_blank">
                            <img src="{{asset('img/file.png')}}" alt="" width="52">
                            <strong>{{$doc->title}}</strong>
                            <span class="text-danger badge">{{strtoupper(substr($doc->file_name, -4))}}</span>
                            <span class="file-name">{{$doc->file_name}}</span>
                        </a>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <br>
            <p class="text-center">
                <a href="{{url('/front/sub3/'.$sub2->id)}}" class="btn btn-success"><img src="{{asset('img/back.png')}}" alt=""> &nbsp;ត្រលប់ក្រោយ</a>
            </p>
        </div>
    </div>
@endsection