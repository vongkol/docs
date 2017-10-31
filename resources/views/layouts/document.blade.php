<?php
  $roots = DB::table("document_category")->where("active",1)->get();
  $sub1s = DB::table("sub1")->where("active", 1)->get();
  $sub2s = DB::table("sub2")->where("active", 1)->get();
  $sub3s = DB::table("sub3")->where("active", 1)->get();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="School Management System">
    <meta name="author" content="vdoo.biz">
    <meta name="keyword" content="School, Student, Student Management System, School Management System">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>ប្រព័ន្ធគ្រប់គ្រងឯកសារ</title>
    <!-- Icons -->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('css/simple-line-icons.css')}}" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('jstree/themes/default/style.min.css')}}">
    <script>
        var burl = "{{url('/')}}";
        var asset = "{{asset('img')}}";
        var doc_url = "{{asset('documents/')}}";
        var upload_url = "{{asset('uploads/')}}";
    </script>
    <style>
        .sidebar{
            background: #FFFFFF;
            padding-top: 15px;
        }
        #explorer{
            overflow-y: scroll;
            overflow-x: scroll;
            height: 99%;
        }
        .sidebar-fixed .sidebar{
            width: 300px;
            height: 90%;
        }
        .sidebar-fixed .main, .sidebar-fixed .app-footer{
            margin-left: 300px;
        }
        .sidebar li
        {
            color: #000!important;
        }
    </style>
</head>
<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
<header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button">☰</button>
    <a class="navbar-brand" href="#"></a>
    <ul class="nav navbar-nav d-md-down-none">
        <li class="nav-item">
            <a class="nav-link" href="#">☰</a>
        </li>
        <li class="nav nav-item x-right">
            <a href="{{url('/')}}" class="nav-link text-primary"><i class="fa fa-home"></i> ទំព័រមុខ</a>
        </li>
        <li class="nav nav-item x-right">
            <a href="{{url('/document')}}" class="nav-link text-danger"><i class="fa fa-folder"></i> ឯកសារ</a>
        </li>
        <li class="nav nav-item x-right">
            <a href="#" class="nav-link text-success"><i class="fa fa-book"></i> សំណើរ</a>
        </li>
        <li class="nav-item dropdown" style="margin-right: 18px;">
            <a class="nav-link dropdown-toggle text-black" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-star"></i> Admin
            </a>
            <div class="dropdown-menu dropdown-menu-left">
                <a class="dropdown-item" href="{{url('/user')}}"><i class="fa fa-user text-danger"></i> អ្នកប្រើប្រាស់</a>
                <a class="dropdown-item" href="{{url('/role')}}"><i class="fa fa-shield text-info"></i>  សិទ្ធិ និងតួនាទី</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-info" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-cog"></i> កំណត់ត្រា
            </a>
            <div class="dropdown-menu dropdown-menu-left">
                <a class="dropdown-item" href="{{url('/category')}}"><i class="fa fa-circle-o text-danger"></i> ប្រភេទឯកសារ</a>
                <a class="dropdown-item" href="{{url('/asset')}}"><i class="fa fa-circle-o text-info"></i>  សម្ភារៈ</a>
                <a class="dropdown-item" href="#"><i class="fa fa-circle-o text-info"></i>  រូបភាព</a>

            </div>
        </li>
    </ul>
    <ul class="nav navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <img src="{{asset('profile/'.Auth::user()->photo)}}" class="img-avatar" alt="">
                <span class="d-md-down-none text-info">{{Auth::user()->name}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">

                <div class="dropdown-header text-center">
                    <strong>គណនី</strong>
                </div>

                <a class="dropdown-item" href="{{url('/user/profile')}}"><i class="fa fa-user text-primary"></i> ប្រូហ្វាល់</a>
                <a class="dropdown-item" href="{{url('/user/reset-password')}}"><i class="fa fa-key text-success"></i> ប្តូរលេខសម្ងាត់</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out text-danger"></i> ចាកចេញ</a>
            </div>
        </li>
        <li class="nav-item d-md-down-none">
        </li>

    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
</header>
<div class="app-body">
    <div class="sidebar">
     <div id="explorer">
         <?php
         $categories = DB::table('document_category')
             ->orderBy('name')
             ->get();
         ?>
         <ul>
             @foreach($roots as $cat)
                 <li cat-id="{{$cat->id}}" title="{{$cat->name}}" cat-type="root">{{$cat->name}}
                    <ul>
                        @foreach($sub1s as $sub1)
                            @if($sub1->parent_id==$cat->id)
                                <li cat-id="{{$sub1->id}}" cat-type="sub1">{{$sub1->name}}
                                <ul>
                                    @foreach($sub2s as $sub2)
                                        @if($sub2->parent_id==$sub1->id)
                                            <li cat-id="{{$sub2->id}}" cat-type="sub2">
                                                {{$sub2->name}}
                                                <ul>
                                                    @foreach($sub3s as $sub3)
                                                        @if($sub3->parent_id==$sub2->id)
                                                            <li cat-id="{{$sub3->id}}" cat-type="sub3">{{$sub3->name}}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                 </li>
             @endforeach
         </ul>
     </div>
    </div>
    <!-- Main content -->
    <main class="main">
        <div class="container-fluid">
            <div class="animated fadeIn">
                @yield('content')
            </div>

        </div>
    </main>
</div>
@yield('modal')
<footer class="app-footer">
    Copy &copy; {{date('Y')}} by <a href="#">COCD</a>
    <span class="float-right">Powered by <a href="http://vdoo.biz" target="_blank">Vdoo</a>
        </span>
</footer>
@yield('modal')
<!-- Scripts -->
<script src="{{asset('js/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap and necessary plugins -->
<script src="{{asset('bower_components/tether/dist/js/tether.min.js')}}"></script>
<script src="{{asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- Plugins and scripts required by all views -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/app1.js') }}"></script>
<script src="{{asset('jstree/jstree.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#explorer').jstree({
            "core" : {
                "animation" : 0,
                "check_callback" : true,
                "themes" : { "stripes" : true,   "variant" : "large" }
            }
        });

    });
</script>
@yield('js')
</body>
</html>
