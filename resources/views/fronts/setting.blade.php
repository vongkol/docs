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
        <div class="col-sm-12">
            <br>
            <h3 class="text-primary text-center">ពត៌មានអ្នកប្រើប្រាស់</h3>
            <hr>
            <form action="{{url('/front/dosetting')}}" method="post">
                {{csrf_field()}}
                @if(Session::has('sms'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div>
                            {{session("sms")}}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label for="username" class="control-label">ឈ្មោះអ្នកប្រើប្រាស់</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}">
                    <input type="hidden" id="id" name="id" value="{{$user->id}}">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">លេខសម្ងាត់</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <br>
                    <button class="btn btn-primary" type="submit">កែប្រែ</button>
                </div>
            </form>
        </div>
    </div>

@endsection