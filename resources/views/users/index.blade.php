@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> បញ្ជីអ្នកប្រើប្រាស់&nbsp;
                    <a href="{{url('/user/create')}}" class="btn btn-link btn-sm">បង្កើតថ្មី</a>
                </div>
                <div class="card-block">
                    <table class="table table-condensed table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>ល.រ</th>
                            <th>ឈ្មោះ</th>
                            <th>អ៊ីម៉ែល</th>
                            <th>ទួនាទី</th>
                            <th>សកម្មភាព</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php($i=1)
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_name}}</td>
                                <td>
                                    <a href="{{url('/user/update-password/'.$user->id)}}" title="ប្តូរលេខសម្ងាត់"><i class="fa fa-shield"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/user/edit/'.$user->id)}}" title="កែប្រែ"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/user/delete/'.$user->id)}}" onclick="return confirm('តើអ្នកពិតជាចង់លុបមែនទេ?')" title="លុប"><i class="fa fa-remove text-danger"></i></a>
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