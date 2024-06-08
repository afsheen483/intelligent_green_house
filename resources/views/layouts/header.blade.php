<!DOCTYPE html>
<html lang="en">
<head>
	<!-- set the encoding of your site -->
	  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	<meta charset="utf-8">

	<!-- set the Compatible of your site -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- set the page title -->
	<title>IGH - Intelligent Green House</title>
	<!-- include the site Google Fonts stylesheet -->
	<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700%7CRoboto:300,400,500,700,900&display=swap" rel="stylesheet">
	<!-- include the site bootstrap stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets_1/css/bootstrap.css') }}">
	<!-- include the site fontawesome stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets_1/css/fontawesome.css') }}">
	<!-- include the site stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets_1/css/style.css') }}">
	<!-- include theme plugins setting stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets_1/css/plugins.css') }}">
	<!-- include theme color setting stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets_1/css/color.css') }}">
	<!-- include theme responsive setting stylesheet -->
	<link rel="stylesheet" href="{{ asset('assets_1/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>
	<!-- pageWrapper -->
	<div id="pageWrapper">
		<!-- pageHeader -->

		<header id="header" class="pt-lg-5 pt-md-3 pt-2 position-absolute w-100">
			<div class="container-fluid px-xl-17 px-lg-5 px-md-3 px-0 d-flex flex-wrap">
				{{-- <div class="col-6 col-sm-3 col-lg-2 order-sm-2 order-md-0 dis-none">
					<!-- langList -->
					<ul class="nav nav-tabs langList pt-xl-6 pt-lg-4 pt-3 border-bottom-0">

						<li>
							<a class="icon-menu" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="true" aria-expanded="false"></a>

							<div class="dropdown-menu pl-4 pr-4">

							</div>
						</li>




					</ul>
				</div> --}}
				<div class="col-12 col-sm-12 col-lg-12 static-block">
					<!-- mainHolder -->
					<div class="mainHolder justify-content-center">
						<!-- pageNav1 -->
						<nav class="navbar navbar-expand-lg navbar-light p-0 pageNav1 position-static">
							<button type="button" class="navbar-toggle collapsed position-relative mt-md-2" data-toggle="collapse" data-target="#navbarNav" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<div class="collapse navbar-collapse" id="navbarNav">
								<ul class="navbar-nav mx-auto text-uppercase d-inline-block">
									@if (Auth::check())
										<li class="nav-item active">
										<a href="/customer_home/0" class="d-block">Dashboard</a>
									</li>
									@else
										{{-- <li class="nav-item">
											<a href="/demo" class="d-block">Demo</a>
										</li> --}}
									@endif
									
								
									@if (Auth::check())
									{{-- <li class="nav-item">
										<a class="d-block" >User Guide</a>
									</li> --}}
									@else
										{{-- <li class="nav-item">
										<a class="d-block" >Usage</a> --}}
									</li>
									@endif

									
									@if (Auth::check())
									<li class="nav-item">
									    <a class="d-block" href="/life_cycle" id="btn">Plant Life Cycle</a>
									</li>
									<li class="nav-item">
									    <a class="d-block" href="/view_plantlife/{{ Auth::user()->id }}" id="btn">View PlantLife Cycle</a>
									</li>
									@else
									<li class="nav-item">
										<a class="d-block" >Pricing</a>
									</li>
									<li class="nav-item">
										<a class="d-block" href="/about">About</a>
									</li>
									@endif
									
									<li class="nav-item">
										<a class="d-block" href="/contact">contact</a>
									</li>

									<!--<li class="nav-item">
										<a class="nLogo" href="home.html"><img src="images/IGH Logo/testing.png" alt="logo" class="img-fluid"></a>
									</li>-->
									


									

									<li class="nav-item">
										<a class="d-block"  href="/request" >Buy New One?</a>
									</li>


                                    <li class="nav-item">
                                        @if (Auth::check())
                                        <a class="d-block" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><span>
                                        {{ __('Logout') }}</span>

                                  </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                                  @else
                                  <a class="d-block" href="/login">Login</a>
                                @endif
										{{-- <a class="d-block" href="/contact">Login</a> --}}
									</li>

								</ul>
							</div>
						</nav>

					</div>
				</div>
				{{-- <div class="col-6 col-sm-3 col-lg-2 order-sm-3 order-md-0 dis-none">
					<!-- wishList -->
					<ul class="nav nav-tabs wishList pt-xl-5 pt-lg-4 pt-3 mr-xl-3 mr-0 justify-content-end border-bottom-0">
						<li class="nav-item"><a class="nav-link icon-search" href="javascript:void(0);"></a></li>

					</ul>
				</div> --}}
			</div>
		</header>
		<!-- main -->
		<main>
			@yield('main')
		</main>
          <!-- footerHolder -->
    <aside class="footerHolder overflow-hidden bg-lightGray pt-xl-23 pb-xl-8 pt-lg-10 pb-lg-8 pt-md-12 pb-md-8 pt-10">
       @yield('footer')
    </aside>
		<!-- footer -->
		<footer id="footer" class="container-fluid overflow-hidden px-lg-20">
			@yield('copyright')
		</footer>
	</div>
	<!-- include jQuery library -->
	<script src="{{ asset('assets_1/js/jquery-3.4.1.min.js') }}"></script>
	<!-- include bootstrap popper JavaScript -->
	<script src="{{ asset('assets_1/js/popper.min.js') }}"></script>
	<!-- include bootstrap JavaScript -->
	<script src="{{ asset('assets_1/js/bootstrap.min.js') }}"></script>
	<!-- include custom JavaScript -->
	{{-- <script src="{{ asset('assets_1/js/jqueryCustome.js') }}"></script> --}}
    @yield('scripts')
</body>
</html>
