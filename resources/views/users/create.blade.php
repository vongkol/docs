@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> បង្កើតអ្នកប្រើប្រាស់ថ្មី&nbsp;&nbsp; &nbsp;
                    <a href="{{url('/user')}}" class="btn btn-link btn-sm">ត្រលប់ក្រោយ</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                អ្នកប្រើប្រាស់ថ្មីត្រូវបានបង្កើតដោយជោគជ័យ!
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                មានបញ្ហា, មិនអាចបង្កើតអ្នកប្រើប្រាស់ថ្មីបានទេ!
                            </div>
                        </div>
                    @endif
                    <form action="{{url('/user/save')}}" class="form-horizontal" enctype="multipart/form-data" method="post" id="frm">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="name" class="control-label col-lg-1 col-sm-2">ឈ្មោះ</label>
                            <div class="col-lg-6 col-sm-6">
                                <input type="text" required name="name" id="name" class="form-control" autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-lg-1 col-sm-2">អ៊ីម៉ែល</label>
                            <div class="col-lg-6 col-sm-6">
                                <input type="email" required name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="control-label col-lg-1 col-sm-2">លេខសម្ងាត់</label>
                            <div class="col-lg-6 col-sm-6">
                                <input type="password" required name="password" id="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="control-label col-lg-1 col-sm-2">តួនាទី</label>
                            <div class="col-lg-6 col-sm-6">
                                <select name="role" id="role" class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-lg-1 col-sm-2">រូបថត</label>
                            <div class="col-lg-6 col-sm-6">
                                <input type="file" value="" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                                <br>
                                <img src="{{asset('profile/default.png')}}" alt="" width="72" id="preview">
                            </div>

                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-1 col-sm-2">&nbsp;</label>
                            <div class="col-lg-6 col-sm-6">
                                <button class="btn btn-primary" type="submit">រក្សាទុក</button>
                                <button class="btn btn-danger" type="reset" id="btnCancel">បោះបង់</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
    </script>
@endsection
