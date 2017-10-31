@extends("layouts.document")
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <strong>បន្ថែមបញ្ជីសម្ភារៈ</strong>&nbsp;&nbsp;
                <a href="{{url('/slider')}}">ត្រលប់ក្រោយ</a>
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
                     <form action="{{url('/slider/update')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">

                                <div class="form-group row">
                                    <label for="title" class="control-label col-sm-4 lb">ចំណងជើងរូបភាព <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$slider->title}}" id="title" name="title" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <br>
                                    <label for="name" class="control-label col-sm-4 lb">ទាញរូបភាព <span class="text-danger"></span></label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" value="{{$slider->file_name}}" id="file_name" name="file_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <br>
                                    <label for="name" class="control-label col-sm-4 lb">លេខរៀងបង្ហាញ <span class="text-danger">*</span></label>

                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" value="{{$slider->order}}" id="order" name="order" required>
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id" value="{{$slider->id}}">
                                <div class="form-group row"> 
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-8">
                                        <button class="btn btn-primary btn-flat" type="submit">Update</button>
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
