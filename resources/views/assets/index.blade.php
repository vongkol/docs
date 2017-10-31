@extends("layouts.document")
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>បញ្ជីសម្ភារៈ</strong>&nbsp;&nbsp;
                <a href="{{url('/asset/create')}}">បន្ថែម</a>
            </div>
            <div class="card-block">
               <table class="tbl">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($assets as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>
                                <a href="{{url('/asset/edit/'.$item->id)}}"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                <a href="{{url('/asset/delete/'.$item->id)}}" onclick="return confirm('តើអ្នកពិតជាចង់លុបមែនទេ?')"><i class="fa fa-remove text-danger"></i></a>
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
