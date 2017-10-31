<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link rel="stylesheet" href="{{asset("bower_components/bootstrap/dist/css/bootstrap.css")}}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                &nbsp;
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <h2 class="text-primary text-center">ចូលក្នុងប្រព័ន្ធ</h2>
                <hr>
                <form action="{{url('/front/dologin')}}" class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="username" class="control-label">ឈ្មោះអ្នកប្រើប្រាស់</label>
                        <input type="text" class="form-control" name="username" id="username" value="{{old("username")}}">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">លេខសម្ងាត់</label>
                        <input type="password" class="form-control" name="password" id="password">
                    </div>
                    <div class="form-group">
                       <button type="submit" class="btn btn-primary">ចូលក្នុងប្រព័ន្ធ</button>
                    </div>
                    <div class="form-group">
                        <p id="sms" class="text-danger">
                            @if(Session::has('sms'))
                                {{session("sms")}}
                            @endif
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>