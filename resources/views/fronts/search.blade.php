@extends("layouts.front")
@section("content")
    <div class="row">
        <div class="header bg-primary">
            <h3 class="text-white">
                <a href="{{url('front/setting')}}"><img src="{{asset("img/menu.png")}}" alt="menu" width="54"></a>
                    ស្វែងរកឯកសារ
                <a href="{{url('/front/search')}}" style="float: right;"><img src="{{asset("img/search.png")}}" alt="menu" width="40"></a>
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <br>
            <form action="{{url('/front/dosearch')}}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="ស្វែងរក..." name="q" value="{{$q}}">
                    <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">ស្វែងរក</button>
              </span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <hr>
            <ul class="folder-list">
                @foreach($docs as $doc)
                    <li>
                        <a href="{{asset('uploads/'.$doc->file_name)}}" target="_blank" title="{{$doc->description}}">
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
@endsection