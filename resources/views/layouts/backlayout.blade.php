<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Back') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Mobile -->
    <link rel="stylesheet" href="{{asset('mobile/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('mobile/css/lightbox.css')}}">
	<link rel="stylesheet" href="{{asset('mobile/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('mobile/css/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('mobile/css/animsition.css')}}">
    <link rel="stylesheet" href="{{asset('mobile/css/style.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

</head>

<body class="animsition">

	<!-- navbar -->
	<div class="navbar navbar-home">
		<div class="container">
			<div class="content-left">
				<a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
			</div>
			<div class="content-center">
				<a href="/admin"><h1>魔后美學</h1></a>
			</div>
			<div class="content-right">
				<a class="nav-link" href="{{url('/admin/shop/cart')}}">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="badge badge-warning navbar-badge">{{Session::has('cart') ? Session::get('cart')->totalQty : ''}}</span>
                </a>
            </div>
		</div>
	</div>
	<!-- end navbar -->

	<!-- sidebar -->
	<div class="side-overlay"></div>
	<div id="menu" class="panel sidebar" role="navigation">
		<div class="sidebar-header">
			<img src="{{url('/storage/images/avatar/'.Auth::user()->image.'')}}" alt="">
			<span>{{Auth::user()->name}}</span>
		</div>
		<ul>
			<li>
				<a href="{{url('/admin')}}"><i class="fa fa-home"></i>後台</a>
			</li>
			<li>
				<a href="{{url('/admin/members')}}"><i class="fa fa-users"></i>用戶管理</a>
			</li>
			<li>
				<a href="{{url('/admin/allmembers')}}"><i class="fa fa-list"></i>所有用戶管理</a>
			</li>
			<li>
				<a href="{{url('/register')}}"><i class="fa fa-user-plus"></i>建立用戶</a>
			</li>
			<li>
				<a href="{{url('/admin/shop/index')}}"><i class="fa fa-shopping-cart"></i>商城</a>
			</li>
			<li>
				<a href="{{url('/admin/product/index')}}"><i class="fa fa-home"></i>商品設定</a>
			</li>
			<li>
				<a href="{{url('/admin/product/category')}}"><i class="fa fa-home"></i>商品類別</a>
            </li>
            <li>
				<a href="{{url('/admin/order-history')}}"><i class="fa fa-mobile"></i>購買紀錄</a>
            </li>
            <li>
				<a href="{{url('/admin/order-history-member')}}"><i class="fa fa-rocket"></i>用戶訂單</a>
            </li>
            <li>
				<a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-rocket"></i>
                    確定登出
                    
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
		</ul>
	</div>
	<!-- end sidebar -->
	
    @yield('content')



	<!-- mobile -->
    <script src="{{asset('mobile/js/jquery.min.js')}}"></script>
    <script src="{{asset('mobile/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('mobile/js/lightbox.js')}}"></script>
    <script src="{{asset('mobile/js/animsition.min.js')}}"></script>
    <script src="{{asset('mobile/js/animsition-custom.js')}}"></script>
    <script src="{{asset('mobile/js/jquery.big-slide.js')}}"></script>
    <script src="{{asset('mobile/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('mobile/js/main.js')}}"></script>
    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
</body>
</html>
