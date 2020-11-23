<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>			<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>			<html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="zxx">
<!--<![endif]-->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome To The Bangladesh Journal Of Extension Education</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="icon" href="{{ asset('theme/images/favicon.png') }}" type="image/x-icon">

	<link rel="stylesheet" href="{{ asset('theme/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/normalize.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/fontawesome/fontawesome-all.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/font-awesome.min.css') }}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('theme/css/linearicons.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/themify-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/owl.carousel.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/chartist.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/main.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/dashboard.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/custom.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/color.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/transitions.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/css/responsive.css') }}">
	<script src="{{ asset('theme/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>

	<meta name="csrf-token" content="{{ Session::token() }}">

</head>

<body class="sj-home">
	<!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<!--************************************
				Preloader Start
	*************************************-->
	{{-- <div class="preloader-outer">
		<div class='loader'>
			<div class='loader--dot'></div>
			<div class='loader--dot'></div>
			<div class='loader--dot'></div>
			<div class='loader--dot'></div>
		</div>
	</div> --}}
	<!--************************************
				Preloader End
	*************************************-->
	<!--************************************
			Wrapper Start
	*************************************-->
	<div id="sj-wrapper" class="sj-wrapper">
		<!--************************************
				Content Wrapper Start
		*************************************-->
		<div class="sj-contentwrapper">
			<!--************************************
					Header Start
			*************************************-->
			<header id="sj-header" class="sj-header sj-haslayout">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div class="sj-topbar">
								<ul class="sj-socialicons sj-socialiconssimple">
									<li class="sj-facebook"><a href="javascript:void(0);"><i
												class="fa fa-facebook-f"></i></a></li>
									<li class="sj-twitter"><a href="javascript:void(0);"><i
												class="fab fa-twitter"></i></a></li>
									<li class="sj-linkedin"><a href="javascript:void(0);"><i
												class="fab fa-linkedin-in"></i></a></li>
									<li class="sj-googleplus"><a href="javascript:void(0);"><i
												class="fab fa-google-plus-g"></i></a></li>
								</ul>
								<div class="sj-languagelogin">
									<div class="sj-loginarea">
										<ul class="sj-loging">
											@auth
											<li><a href="javascript:void(0);">My Account</a></li>
											<li>

												<a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
																	 document.getElementById('logout-form').submit();">
													{{ __('Logout') }}
												</a>

												<form class="hidden" id="logout-form" action="{{ route('logout') }}"
													method="POST" style="display: none;">
													@csrf
												</form>
											</li>



											@else
											<li><a href="{{ route('login') }}">Login</a></li>
											<li><a href="{{ route('register') }}" disabled>Register</a></li>
											@endauth

										</ul>
									</div>
									<div class="sj-loginarea">
										<ul class="sj-loging">
											<li><b style="font-size: 120%">ISSN 1011-3916</b></li>
										</ul>
									</div>
									<div class="sj-userloginarea">
										<a href="javascript:void(0);">
											<i class="fa fa-angle-down"></i>
											<img src="{{ asset('theme/images/user-img.jpg') }}" alt="image description">
											<div class="sj-loginusername">
												<h3>Hi, Racheal</h3>
												<span>Author</span>
											</div>
										</a>
										<nav class="sj-usernav">
											<ul>
												<li><a href="underreview.html"><i
															class="lnr lnr-sync"></i><span>Articles Under
															Review</span></a></li>
												<li><a href="addtemplates.html"><i
															class="lnr lnr-briefcase"></i><span>Add Templates</span></a>
												</li>
												<li><a href="aticle-list.html"><i class="lnr lnr-sync"></i><span>Aticle
															List</span></a></li>
												<li><a href="generalsettings.html"><i
															class="lnr lnr-layers"></i><span>General Settings</span></a>
												</li>
												<li><a href="manageuser.html"><i class="lnr lnr-users"></i><span>Manage
															Users</span></a></li>
												<li><a href="manageeditions.html"><i
															class="lnr lnr-tag"></i><span>Manage Editions</span></a>
												</li>
												<li><a href="emailtemplates.html"><i
															class="lnr lnr-envelope"></i><span>Email
															Templates</span></a></li>
												<li><a href="accountsettings.html"><i
															class="lnr lnr-lock"></i><span>Account Settings</span></a>
												</li>
												<li><a href="loginregister.html"><i
															class="lnr lnr-exit"></i><span>Logout</span></a></li>
											</ul>
										</nav>
									</div>
									<div class="sj-languages d-none">
										<a id="sj-languages-button" href="javascript:void(0);">
											<img src="{{ asset('theme/images/flags/flag-02.jpg') }}"
												alt="image description">
											<span>Eng</span>
											<i class="fa fa-angle-down"></i>
										</a>
										<ul>
											<li>
												<a href="javascript:void(0);">
													<img src="{{ asset('theme/images/flags/flag-01.jpg') }}"
														alt="image description">
													<span>Ara</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);">
													<img src="{{ asset('theme/images/flags/flag-02.jpg') }}"
														alt="image description">
													<span>Eng</span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);">
													<img src="{{ asset('theme/images/flags/flag-03.jpg') }}"
														alt="image description">
													<span>Chi</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="sj-navigationarea">
								<strong class="sj-logo"><a href="{{ route('home') }}">
										<img src="{{ asset('theme/images/logo-1.png') }}" alt="BJEE Logo"
											style="transform: translateY(-20px);"></a>
								</strong>
								<div class="sj-rightarea">
									<nav id="sj-nav" class="sj-nav navbar-expand-lg">
										<button class="navbar-toggler" type="button" data-toggle="collapse"
											data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
											aria-label="Toggle navigation">
											<i class="lnr lnr-menu"></i>
										</button>
										<div class="collapse navbar-collapse sj-navigation" id="navbarNav">
											@include('layouts.nav')
										</div>
									</nav>
									<a class="sj-btntopsearch" href="#sj-searcharea"><i
											class="lnr lnr-magnifier"></i></a>
									@role('author')
									<!--<a class="sj-btn sj-btnactive" href="{{ route('startSubmission') }}">Submit Your Article</a>-->
									@endrole

								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
			<!--************************************
					Header End
			*************************************-->
			<!--************************************
					Home Banner Start
			*************************************-->
			@hasSection ('homebanner')
			@yield('homebanner')
			@else

			@endif

			<!--************************************
					Home Banner End
			*************************************-->
			<!--************************************
					Main Start
			*************************************-->
			<main id="sj-main" class="sj-main sj-haslayout sj-sectionspace">
				@if (Session::has('success'))
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								{!! \Session::get('success') !!}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				@endif

				@if (Session::has('warning'))
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="alert alert-warning alert-dismissible fade show" role="alert">
								{!! \Session::get('warning') !!}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				@endif
				@if (Session::has('danger'))
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								{!! \Session::get('danger') !!}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				@endif

				@hasSection ('content')
				@yield('content')
				@else

				@endif
			</main>
			<!--************************************
					Main End {{ asset('theme/images/logo-1.png') }}
			*************************************-->
			<!--************************************
					Footer Start
			*************************************-->
			<footer id="sj-footer" class="sj-footer sj-haslayout">
				<div class="container">
					<div class="row">
						<a class="sj-btnscrolltotop" href="javascript:void(0);"><i class="fa fa-angle-up"></i></a>
						<div class="sj-footercolumns">
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 float-left">
								<div class="sj-fcol sj-footeraboutus">
									<strong class="sj-logo">
										<a href="index.html"><img  src="{{ asset('theme/images/logo-1.png') }}" alt="BJEE Logo"></a>
									</strong>

									<div class="sj-description">
										<p>BJEE is an international scientific journal publication of the Bangladesh Agricultural Extension Society (BAES)... <a href="{{ url('/about') }}">Read More</a></p>
									</div>
									<ul class="sj-socialicons sj-socialiconssimple">
										<li class="sj-facebook"><a href="javascript:void(0);"><i class="fab fa-facebook-f"></i></a></li>
										<li class="sj-twitter"><a href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
										<li class="sj-linkedin"><a href="javascript:void(0);"><i class="fab fa-linkedin-in"></i></a></li>
										<li class="sj-googleplus"><a href="javascript:void(0);"><i class="fab fa-google-plus-g"></i></a></li>
										<li class="sj-rss"><a href="javascript:void(0);"><i class="fa fa-rss"></i></a></li>
									</ul>
								</div>
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 float-left">
								<div class="sj-fcol sj-widget sj-widgetresources">
									<div class="sj-widgetheading">
										<h3>Resources</h3>
									</div>
									<div class="sj-widgetcontent">
										<ul>
											<li><a href="{{ url('/editorial-board') }}">Editorial Board</a></li>
											<li><a href="{{ url('/instructions-to-authors') }}">Submission Guide</a></li>
											<li><a href="{{ url('/about#copyright-statement') }}">Copyright Statement</a></li>
											<li><a href="{{ url('/about#aim-and-scope') }}">Aim & Scope</a></li>
										</ul>
									</div>
								</div>
							</div>

							<div class="col-12 col-sm-6 col-md-6 col-lg-4 float-left">
								<div class="sj-fcol sj-widget sj-widgetcontactus">
									<div class="sj-widgetheading">
										<h3>Get In Touch</h3>
									</div>
									<div class="sj-widgetcontent">
										<ul>
											<li><i class="lnr lnr-home"></i><address>Mymensingh, Bangladesh </address></li>
											<li><a href="tel:+1-521-322-XXX"><i class="lnr lnr-phone"></i><span>+1-521-322-XXX</span></a></li>
											<li><a href="tel:+1-521-322-XXX"><i class="lnr lnr-screen"></i><span>+1-521-322-XXX</span></a></li>
										    <li><a href="mailto:info@bjee.com.bd"><i class="lnr lnr-envelope"></i><span style="text-transform: lowercase;">info@bjee.com.bd</span></a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="sj-footerbottom">
							<p class="sj-copyrights">© 2019 <span>BAES Society</span>. All Rights Reserved</p>
						</div>
					</div>
				</div>
			</footer>
			<!--************************************
					Footer End
			*************************************-->
		</div>
		<!--************************************
				Content Wrapper End
		*************************************-->
	</div>
	<!--************************************
			Wrapper End
	*************************************-->
	<!--************************************
			Search Start
	*************************************-->
	<div id="sj-searcharea" class="sj-searcharea">
		<button type="button" class="close">×</button>
		<form class="sj-formtheme sj-formsearcmain">
			<input type="search" value="" placeholder="Search Here..." />
			<button type="submit" class="sj-btn sj-btnactive"><span>Search</span></button>
		</form>
	</div>
	<!--************************************
			Search End
	*************************************-->
	<script src="{{ asset('theme/js/vendor/jquery-3.3.1.js') }}"></script>
	<script src="{{ asset('theme/js/vendor/jquery-library.js') }}"></script>
	<script src="{{ asset('theme/js/vendor/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
	<script src="{{ asset('theme/js/circle-progress.js') }}"></script>
	<script src="{{ asset('theme/js/scrollbar.min.js') }}"></script>
	<script src="{{ asset('theme/js/chartist.min.js') }}"></script>
	<script src="{{ asset('theme/js/countdown.js') }}"></script>
	<script src="{{ asset('theme/js/appear.js') }}"></script>
	<script src="{{ asset('theme/js/main.js') }}"></script>

	@hasSection ('js')
	@yield('js')
	@else

	@endif
	
	<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('#keyword').select2();
    });
    </script>
</body>

<!-- Mirrored from amentotech.com/htmls/amentojourn/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 04 Nov 2019 13:55:02 GMT -->

</html>