
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ប្រព័ន្ធគ្រប់គ្រងឯកសារ</title>
    <link rel="stylesheet" href="{{asset("bower_components/bootstrap/dist/css/bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("front/custom.css")}}">
</head>
<body>
<div class="container-fluid" style="margin-bottom: 54px;">
    @yield("content")
</div>
<div class="container-fluid">
    <footer id="footer">
        <a href="{{url("/front/home")}}" class="btn btn-info btn-flat">ទំព័រមុខ</a>
        <a href="{{url('/')}}" class="btn btn-primary btn-flat">ឯកសារ</a>
        <a class="btn btn-success btn-flat" href="{{url('/request')}}">សំណើរ</a>
        <a href="{{url('/front/logout')}}" class="btn btn-danger btn-flat">ចាកចេញ</a>
    </footer>
    <!-- Scripts -->
    <script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
    <script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    @yield('js')
</div>
</body>
</html>
