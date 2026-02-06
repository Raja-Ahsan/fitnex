<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>@yield('title')</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<meta name="csrf-token" id="token" content="{{ csrf_token() }}" />
        <link rel="icon" href="{{asset('/admin/assets/images/page') }}/{{ $home_page_data['header_favicon'] }}" type="image/png" sizes="16x16">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/ionicons.min.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/datepicker3.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/all.css')}}">
		<!-- Font Awesome 6 -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<link rel="stylesheet" href="{{asset('/admin/assets/css/select2.min.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/dataTables.bootstrap.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/jquery.fancybox.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/AdminLTE.min.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/_all-skins.min.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/summernote.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/magnific-popup.css')}}">
		<link rel="stylesheet" href="{{asset('/admin/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('/admin/assets/css/toastr.min.css')}}">

	<style>
		.navbar-custom-menu li.dropdown.user.user-menu a.dropdown-toggle {
			padding-right: 5px;
		}

		.skin-blue .wrapper,
		.skin-blue .main-header .logo,
		.skin-blue .main-header .navbar,
		.skin-blue .main-sidebar,
		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			background-color: #101010 !important;
			/* background-color: #101010 !important; */
		}

		/* .bg-blue {
			background-image: linear-gradient(to right, rgb(255 88 0), rgb(255 145 0));
		} */


		.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
			z-index: 3;
			color: #fff;
			cursor: default;
			background-color: #101010;
			border-color: #101010;
		}
		.pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
			z-index: 2;
			color: #ffffff;
			background-color: #c58501;
			border-color: #c78701;
		}

		li.treeview.mt-2 
		{
			margin-top: 5px !important;
		}

		.info-box {
			display: block !important;
			min-height: 90px !important;
			background: #fff !important;
			width: 100% !important;
			box-shadow: 5px 5px 20px 0px rgb(0 0 0 / 43%) !important;
			border-radius: 5px !important;
			margin-bottom: 15px !important;
			position: relative !important;
			transition: background-image 2s ease-in-out !important;
		}

		.info-box-content {
			padding: 10px 10px !important;
			margin-left: 90px !important;
		}

		.info-box-number {
			color: #101010 !important;
		}

		.info-box-text {
			color: #101010 !important;
		}

		.info-box:hover {
			background-image: linear-gradient(to right, #ffffff, #b7b7b7) !important;
			color: #fff !important;
		}

	/* 	a.active {
			background-image: linear-gradient(to right, rgb(255 88 0), rgb(255 145 0));
		} */

		a.btn.btn-primary.btn-sm:hover {
			background-color: #0079d4 !important;
		}

		button.btn.btn-success.pull-left:hover {
			background-color: #0079d4 !important;
		}

		.content-header .content-header-right a,
		.content .form-horizontal .btn-success {
			border-color: #0079d4 !important;
		}

		.content-header>h1,
		.content-header .content-header-left h1,
		h3 {
			color: #101010 !important;
		}

		.nav-tabs-custom>.nav-tabs>li.active {
			border-top-color: #0079d4 !important;
		}

		.skin-blue .sidebar a {
			color: #fff !important;
		}

		/* .skin-blue .sidebar-menu>li>.treeview-menu {
			margin: 0 !important;
		} */

		.skin-blue .sidebar-menu>li>a {
			border-left: 0 !important;
		}

		.nav-tabs-custom>.nav-tabs>li {
			border-top-width: 1px !important;
		}

		label.error {
			color: #dc3545;
			font-size: 14px;
		}

		@media (max-width: 425px) {

			.skin-blue .content-header {
				background: transparent;
				margin-top: 30px;
			}

			.content-header>h1 {
				margin-top: -17px;
			}

			.main-header .logo,
			.main-header .navbar {
				width: 100%;
				float: none;
				height: 60px;
			}

		}

		@media (max-width: 600px) {
			.skin-blue .content-header {
				background: transparent;
				margin-top: 30px;
			}

			.content-header>h1 {
				margin-top: 20px;
			}

			.skin-blue .main-header .navbar .nav>li>a {
				margin-left: 10px;
			}

			header.main-header a.logo img#header-logo {
				width: 100% !important;
				position: relative !important;
				left: auto !important;
				top: auto !important;
				height: 100% !important;
				max-width: 200px;
				margin: auto !important;
			}
		}

		@media (max-width: 320px) {

			.skin-blue .content-header {
				background: transparent;
				margin-top: -60px;
			}

			.skin-blue .main-header .navbar .nav>li>a {
				height: 50px !important;
				margin-left: -12px;
			}

			.content-header {
				padding: 70px 10px 0 10px;
				/* Adjust padding for smaller screens */
			}

			.content-header>h1 {
				margin-top: 20px;
			}

			.content-header .content-header-left h1 {
				margin-top: 20px !important;
			}

			.content-header .content-header-right a {
				margin-top: 25px;
			}

		}
	</style>

	@stack('css')
</head>

<body class="hold-transition fixed skin-blue sidebar-mini">
	<div class="wrapper">
		<!--header-->
		@include('layouts.admin.header')

		<!--sidebar-->
		@include('layouts.admin.sidebar')

		<div class="content-wrapper">
			@yield('content')
		</div>
	</div>
</body>

<!-- Script -->
<script src="{{asset('/admin/assets/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/select2.full.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/jscolor.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.inputmask.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('/admin/assets/js/moment.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('/admin/assets/js/icheck.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/fastclick.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.fancybox.pack.js')}}"></script>
<script src="{{asset('/admin/assets/js/app.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/summernote.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/demo.js')}}"></script>
<script src="{{asset('/admin/assets/js/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.validate.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('/admin/assets/js/toastr.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/search.js')}}"></script>

<script>
	@if(Session::has('message'))
	toastr.options = {
		"closeButton": true,
		"progressBar": true
	}
	toastr.success("{{ session('message') }}");
	@endif

	@if(Session::has('error'))
	toastr.options = {
		"closeButton": true,
		"progressBar": true
	}
	toastr.error("{{ session('error') }}");
	@endif

	@if(Session::has('info'))
	toastr.options = {
		"closeButton": true,
		"progressBar": true
	}
	toastr.info("{{ session('info') }}");
	@endif

	@if(Session::has('warning'))
	toastr.options = {
		"closeButton": true,
		"progressBar": true
	}
	toastr.warning("{{ session('warning') }}");
	@endif
</script>
@stack('js')

</html>