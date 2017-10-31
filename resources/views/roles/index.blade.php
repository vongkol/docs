@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> បញ្ជីតួនាទី&nbsp;&nbsp;
                    <a href="{{url('/role/create')}}" class="btn btn-link btn-sm">បង្កើតថ្មី</a>
                </div>
                <div class="card-block">

                    <table class="table table-condensed table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>ល.រ</th>
                                <th>ឈ្មោះ</th>
                                <th>សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$role->name}}</td>
                                <td>
                                    <a href="{{url('/role/permission/'.$role->id)}}" title="កំណត់សិទ្ធិ"><i class="fa fa-key"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/role/edit/'.$role->id)}}" title="កែប្រែ"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp;
                                    <a href="{{url('/role/delete/'.$role->id)}}" onclick="return confirm('តើអ្នកពិតជាចង់លុបមែនទេ?')" title="លុប"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection