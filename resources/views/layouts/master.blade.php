<!DOCTYPE html>
<html lang="en">


<!-- index22:59-->
<head>
      <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo-1.png') }}">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index-2.html" class="logo">
					<img src="{{ asset('assets/img/icon.png') }}" width="53px" height="53px" alt=""> <span>IGH</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">


                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="{{ asset('assets/img/user.jpg') }}" width="24" alt="Admin">
							{{-- <span class="status online"></span> --}}
						</span>
						<span>{{ Auth::user()->first_name }}</span>
                    </a>
					<div class="dropdown-menu">
                        <a class="dropdown-item" href="/profile">My Profile</a>
                        <a class="dropdown-item" href="/change_password">Password</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#newmodel">Login as Customer</a>
                        <a href="/maintainance" class="dropdown-item">Maintainance</a>
                    
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="/profile">My Profile</a>
                    <a class="dropdown-item" href="/change_password">Password</a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}
                 </a>

                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                 </form>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="">
                            <a href="/dashboard" ><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="/greenhouse"><i class="fa fa-home"></i> <span>Green House</span></a>
                        </li>
                         <li>
                            <a href="/inventory"><i class="fas fa-inventory"></i> <span>Inventory</span></a>
                        </li>
                            <li>
                            <a href="/sessions"><i class="fa fa-calendar" aria-hidden="true"></i>
                                <span>Sessions</span></a>
                        </li>
                         <li>
                            <a href="/parameter_log"><i class="fa fa-recycle" aria-hidden="true"></i>
                                <span>Parameter Log</span></a>
                        </li>
                        <li>
                            <a href="/expense"><i class=" fas fa-money-bill" aria-hidden="true"></i>
                                <span>Expense</span></a>
                        </li>
        
                        <li>
                            <a href="/sale"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span>Sales</span></a>
                        </li>
                        
                        <li>
                            <a href="/balance_sheet"><i class="fa fa-file" aria-hidden="true"></i>
                                <span>Balance Sheet & Ledger</span></a>
                        </li>
                        <li>
                            <a href="/customer_request"><i class="fa fa-rocket" aria-hidden="true"></i>
                                <span>Buys's Requests</span></a>
                        </li>
                        {{-- <li>
                            <a href="/maintainance"><i class="fa fa-gear" style="font-size:24px"></i>
                                <span>Maintainance</span></a>
                        </li> --}}
                        <li>
                            <a href="/reports"><i class="fa fa-file" aria-hidden="true"></i>
                                <span>Reports</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="far fa-user"></i><span> User Management </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
							<li>
                            <a href="../user"><i class="fa fa-user"></i><span>Users</span></a>
                            </li>
                            <li>
                                <a href="../customers"><i class="fa fa-user"></i><span>Customers</span></a>
                            </li>
    						<li>
                                <a href="../roles"><i class="fa fa-user"></i><span>Roles</span></a>
                            </li>

                            <li>
                            <a href="../permissions"><i class="fas fa-key"></i><span>Permissions</span></a>
                            </li>

							</ul>
						</li>




                        
                        {{-- <li>
                            <a href="/plant_basic_info"><i class="fa fa-recycle" aria-hidden="true"></i>
                                <span>Plant's Basic Info</span></a>
                        </li> --}}
                        {{-- <li>
                            <a href="/fertilizer"><i class="fa fa-medkit" aria-hidden="true"></i>
                                <span>Fertilizer</span></a>
                        </li> --}}
                        {{-- <li>
                            <a href="schedule"><i class='far fa-clock'></i> <span>Fertilizer Schedule</span></a>
                        </li> --}}
                        {{-- <li>
                            <a href="/plant_parameter"><i class="fa fa-leaf" aria-hidden="true"></i>
                                <span>Plant Parameters</span></a>
                        </li> --}}
                        {{-- <li>
                            <a href="/plant_fertilizer"><i class="fa fa-medkit" aria-hidden="true"></i> <span>Plant's Fertilizer</span></a>
                        </li> --}}

                    


                       

                        {{-- <li>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i><span>
                            {{ __('Logout') }}</span>

                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>

						</li> --}}

                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                @yield('content')

            </div>

        </div>
    </div>


    {{-- model --}}
  <div class="modal fade" id="newmodel" tabindex="-1" role="dialog" aria-labelledby="newmodelLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="newmodelLabel">Buyer's Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ url('login_customer') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <label for="">Customer Name</label>
                        <select name="customer_id" id="" class="form-control" required>
                            <option value="">Select a Customer</option>
                            @foreach ($customer_array as $array)
                                <option value="{{ $array->id }}">{{ $array->first_name }}{{ " " }}{{ $array->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="submit" class="btn btn-primary">Login</button>
        </form>
        </div>
      </div>
    </div>
  </div>


    {{-- end model --}}
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> --}}

	<script src="{{ asset('assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/chart.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    @yield('scripts')
</body>
<script>


   jQuery( document ).ready(function( $ ) {
        $('#location option').each(function() {
            var location_name = $(this).val();

            if($(this).is(':selected'))
            //alert(location_name);
            var url = "{{ url('location') }}";
            $.ajax({
                url: url,
                type: "GET",
                cache: false,
                dataType: 'JSON',
                data: {
                    _token: '{{ csrf_token() }}',
                    location_name:location_name,
                },
                success: function(data) {
                 console.log(data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("update request failure");
                    //errorFunction();
                }
            });
           });
    });

    // $('.sidebar li').on('mouseover click',function(e) {

    //     $('.sidebar li').removeClass('active');

    //     var $this = $(this);
    //     if (!$this.hasClass('active')) {
    //         $this.addClass('active');
    //     }
    //     //e.preventDefault();
    // });
   jQuery( document ).ready(function( $ ) {

        var url = window.location;
    // Will only work if string in href matches with location
        $('.sidebar a[href="' + url + '"]').parent().addClass('active');

    // Will also work for relative and absolute hrefs
        $('.sidebar a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');



        });


</script>

<!-- index22:59-->
</html>
