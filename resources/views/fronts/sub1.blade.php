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
            {{$root->name}}
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <ul class="folder-list">
                @foreach($sub1s as $sub)
                    <?php
                    $count = DB::table("documents")->where("category_id", $sub->id)->where("type", "sub1")->count();
                    $sub2 = DB::table("sub2")->where("parent_id", $sub->id)->where("active",1)->count();
                    ?>
                    <li>
                        <a href="{{url('/front/sub2/'.$sub->id)}}">
                            <img src="{{asset('img/folder.png')}}" alt="" width="52">
                            <strong>{{$sub->name}}</strong>
                            <span class="text-danger badge">{{$count + $sub2}} ឯកសារ</span>
                        </a>
                    </li>
                @endforeach
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
                <a href="{{url('/')}}" class="btn btn-success"><img src="{{asset('img/back.png')}}" alt=""> &nbsp;ត្រលប់ក្រោយ</a>
            </p>
        </div>
    </div>
@endsection