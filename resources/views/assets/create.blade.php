@extends("layouts.document")
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>បន្ថែមបញ្ជីសម្ភារៈ</strong>&nbsp;&nbsp;
                <a href="{{url('/asset')}}">ត្រលប់ក្រោយ</a>
            </div>
            <div class="card-block">
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
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif
                     <form action="{{url('/asset/save')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">
                                    <label for="name" class="control-label col-sm-3 lb">ឈ្មោះសម្ភារៈ <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{old('name')}}" id="name" name="name" required>
                                         <br>
                                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                            <button class="btn btn-danger btn-flat" type="reset">Cancel</button>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="col-sm-6">

                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
@endsection
