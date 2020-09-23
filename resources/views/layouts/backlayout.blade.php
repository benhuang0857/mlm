<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- orgchart css -->
    <link rel="stylesheet" href="{{ asset('css/jquery.orgchart.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>        
        div#left {
            font-size:small;
            position:fixed;
            left:0;
            top:0;
        }
        
        div#content {
            position         : relative;
            left             : 300px;
        }
        
        div.text {
            padding          : 10px;
        }
        
        div.orgChart a {
            color            : black;
            text-decoration  : none;
        }
        
        div.orgChart a:hover {
            color            : black;
            text-decoration  : underline;
        }
    </style>
    <script>
        $(function() {
            $("#organisation").orgChart({container: $("#main")});
        });
    </script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="/admin/shop/cart">
                <i class="fa fa-shopping-bag"></i>
                <span class="badge badge-warning navbar-badge">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
                    class="fas fa-th-large"></i></a>
            </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
            <img src="{{asset('images/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                <img src="/storage/images/avatar/{{Auth::user()->image}}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        控制台
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin" class="nav-link active">
                        <i class="fa fa-user-circle nav-icon"></i>
                        <p>個人資料</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/product/index" class="nav-link active">
                        <i class="fa fa-user-circle nav-icon"></i>
                        <p>商品</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/members" class="nav-link active">
                        <i class="fa fa-users nav-icon"></i>
                        <p>您的下線會員</p>
                        </a>
                    </li>
                    @if(Auth::user()->role == '管理員' || Auth::user()->role == '最高權限管理員')
                    <li class="nav-item">
                        <a href="/admin/allmembers" class="nav-link active">
                        <i class="fa fa-users nav-icon"></i>
                        <p>所有會員</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role == '管理員' || Auth::user()->role == '最高權限管理員')
                    <li class="nav-item">
                        <a href="/register" class="nav-link active">
                        <i class="fa fa-address-book nav-icon"></i>
                        <p>建立會員</p>
                        </a>
                    </li>
                    @endif
                    @if(Auth::user()->role != '最高權限管理員')
                    <li class="nav-item">
                        <a href="/admin/contract" class="nav-link active">
                        <i class="fa fa-bookmark nav-icon"></i>
                        <p>合約書</p>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="far fa-circle nav-icon"></i>
                            <p>登出</p>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    </ul>
                </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
            Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2019-2025 <a href="#">BEN</a>.</strong> All rights reserved.
        </footer>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- orgchart js -->
    <script src="{{ asset('js/jquery.orgchart.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('select2/js/select2.full.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
</body>
</html>
