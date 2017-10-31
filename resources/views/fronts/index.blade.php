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
    </div>
    <br>
   <div class="row">
      <div class="col-sm-12">
        <ul class="folder-list">
            @foreach($roots as $root)
                <?php
                        $count = DB::table("documents")->where("category_id", $root->id)->where("type", "root")->count();
                        $sub1 = DB::table("sub1")->where("parent_id", $root->id)->where("active",1)->count();
                        ?>
            <li>
                <a href="{{url('/front/sub1/'.$root->id)}}">
                    <img src="{{asset('img/folder.png')}}" alt="" width="52">
                    <strong>{{$root->name}}</strong>
                    <span class="text-danger badge">{{$count + $sub1}} ឯកសារ</span>
                </a>
            </li>
            @endforeach

        </ul>
      </div>
   </div>
@endsection