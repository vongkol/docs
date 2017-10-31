@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> ប្តូរលេខសម្ងាត់

                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                លេខសម្ងាត់ត្រូវបានប្តូរដោយជោគជ័យ!
                            </div>
                        </div>
                    @endif
                        @if(Session::has('sms1'))
                            <div class="alert alert-danger" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div>
                                    មិនអាចប្តូរលេខសម្ងាត់បានទែ!
                                </div>
                            </div>
                        @endif
                    <form action="{{url('/user/change-password')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="new_password" class="control-label col-lg-2 col-sm-4">លេខសម្ងាត់ថ្មី</label>
                            <div class="col-lg-6 col-sm-7">
                                <input type="password" required  name="new_password" value="{{old('new_password')}}"
                                       id="new_password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="confirm_password" class="control-label col-lg-2 col-sm-4">បញ្ជាក់លេខសម្ងាត់ថ្មី</label>
                            <div class="col-lg-6 col-sm-7">
                                <input type="password" required  name="confirm_password" value="{{old('confirm_password')}}"
                                       id="confirm_password" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-4">&nbsp;</label>
                            <div class="col-lg-6 col-sm-7">
                                <button class="btn btn-primary" type="submit">រក្សាទុក</button>
                                <button class="btn btn-danger" type="reset">បោះបង់</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection