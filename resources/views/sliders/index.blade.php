@extends("layouts.document")
@section('content')
<div class="row">

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>បញ្ជីរូបភាព</strong>&nbsp;&nbsp;
                <a href="{{url('/slider/create')}}">បន្ថែម</a>
            </div>
             @if(Session::has('sms'))
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div>
                        {{session('sms')}}
                    </div>
                </div>
            @endif
            <div class="card-block">
               <table class="tbl">
                    <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th>រូបភាព</th>
                            <th>ចំណងជើងរូបភាព</th>
                            <th>ឈ្មោះឯកសារ</th>
                            <th>លេខរៀងបង្ហាញ</th>
                            <th>សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sliders as $photo)
                        <tr>
                            <td>{{$photo->id}}</td>
                            <td><img src="{{'uploads/slider/'.$photo->file_name}}" width="50px"​ alt="Image"></td>
                            <td>{{$photo->title}}</td>
                            <td>{{$photo->file_name}}</td>
                            <td>{{$photo->order}}</td>
                            <td>
                                <a href="{{url('/slider/edit/'.$photo->id)}}"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                <a href="{{url('/slider/delete/'.$photo->id)}}" onclick="return confirm('តើអ្នកពិតជាចង់លុបមែនទេ?')"><i class="fa fa-remove text-danger"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
               </table>
            </div>
        </div>
    </div>
</div>
@endsection
