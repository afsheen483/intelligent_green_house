@extends('layouts.header')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
        
@section('main')
<body>
	<!-- pageWrapper -->
    {{-- {{ dd(Auth::user()->id) }} --}}
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

								@if (Auth::check())
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><span>
                                {{ __('Logout') }}</span>

                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                          @else
                          <a class="dropdown-item" href="/login">Login</a>
                        @endif
							</div>
						</li>




					</ul>
				</div> --}}
				
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
            
			<!-- introBlock -->
           
         
            <br><br>
			<section class="introBlock position-relative container" style="margin-top: 5rem">
				<div class="card">
                     <div class="card-header">

                 <h6 class="card-title text-bold">Plant Information List</h6>

    </div>
  
    <div class="card-body">
                <div class="container">
                    @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @elseif ($message = Session::get('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>

            @endif
                    <div class="table-responsive">
                    <table class="table table-striped  dataTable display" id="mytable" style="width: 100%"  cellspacing="0">
                    <thead>
                        <tr>
                            <th>Plant Name</th>
                            <th>Life Duration</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plant_info as $arr)
                            <tr>
                                <td>{{ $arr->plant_name }}</td>
                                <td>{{ $arr->plant_life_duration }}</td>
                                <td>{{ $arr->plant_description }}</td>
                                <td>
                                    <a href="/plantinfo_form/{{ $arr->id }}"><i class="fa fa-edit"></i></a>
                                    <a  class="delete_btn" id="{{ $arr->id }}"><i class="fa fa-trash" style="color: red"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
				
	</section>
    <section class="introBlock position-relative container" style="margin-top: 5rem">
				<div class="card">
                     <div class="card-header">

                 <h6 class="card-title text-bold">Plant Parameters List</h6>

    </div>
  
    <div class="card-body">
                <div class="container">
                    <div class="table-responsive">
                    <table class="table table-striped  dataTable display" id="par_table" style="width: 100%"  cellspacing="0">
                    <thead>
                        <tr>
                            <th>Plant Name</th>
                            <th>Parameter Name</th>
                            <th>Range from</th>
                            <th>Range to</th>
                            <th>Required Value</th>
                            <th>Threshold</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parameters as $arr)
                            <tr>
                                <td>{{ $arr->plant_name }}</td>
                                <td>{{ $arr->parameter_name }}</td>
                                <td>{{ $arr->range_from }}</td>
                                <td>{{ $arr->range_to }}</td>
                                <td>{{ $arr->request_value }}</td>
                                <td>{{ $arr->threshold }}</td>
                                <td>
                                    <a href="/plantpara_form/{{ $arr->id }}"><i class="fa fa-edit"></i></a>
                                    <a class="delete_btn" id="{{ $arr->id }}"><i class="fa fa-trash" style="color: red"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
				
	</section>


      <section class="introBlock position-relative container" style="margin-top: 5rem">
				<div class="card">
                     <div class="card-header">

                 <h6 class="card-title text-bold">Plant Fertilizer List</h6>

    </div>
  
    <div class="card-body">
                <div class="container">
                    <div class="table-responsive">
                    <table class="table table-striped  dataTable display" id="fer_table" style="width: 100%"  cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fertilizer Name</th>
                            <th>Quantity</th>
                            <th>Time Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fertilizer as $arr)
                            <tr>
                                <td>{{ $arr->fertilizer_name }}</td>
                                <td>{{ $arr->quantity }}</td>
                                <td>{{ $arr->time_duration }}</td>
                               
                                <td>
                                    <a href="/plant_fertilizer_form/{{ $arr->id }}"><i class="fa fa-edit"></i></a>
                                    <a class="delete_btn" id="{{ $arr->id }}"><i class="fa fa-trash" style="color: red"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
				
	</section>


      <section class="introBlock position-relative container" style="margin-top: 5rem">
				<div class="card">
                     <div class="card-header">

                 <h6 class="card-title text-bold">Fertilizer Schedule List</h6>

    </div>
  
    <div class="card-body">
                <div class="container">
                    <div class="table-responsive">
                    <table class="table table-striped  dataTable display" id="sch_table" style="width: 100%"  cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fertilizer Name</th>
                            <th>Quantity</th>
                            <th>Time Duration</th>
                            <th>Day No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fertilizer_details as $arr)
                            <tr>
                                <td>{{ $arr->fertilizer_name }}</td>
                                <td>{{ $arr->quantity }}</td>
                                <td>{{ $arr->time_duration }}</td>
                                <td>{{ $arr->day_no }}</td>
                               
                                <td>
                                    <a href="/fertilizer_schedule/{{ $arr->id }}"><i class="fa fa-edit"></i></a>
                                    <a class="delete_btn" id="{{ $arr->id }}"><i class="fa fa-trash" style="color: red"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                </div>
            </div>
        </div>
				
	</section>
    <br><br><br>
		</main>

	</div>

	@endsection

@section('footer')

 <div class="container">
     <div class="row">
         <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-4">
             <h3 class="headingVI fwEbold text-uppercase mb-7">Contact Us</h3>
             <ul class="list-unstyled footerContactList mb-3">
                 <li class="mb-3 d-flex flex-nowrap pr-xl-20 pr-0"><span class="icon icon-place mr-3"></span>
                     <address class="fwEbold m-0">Address: Faiz Alam Town Gujranwala.</address>
                 </li>
                 <li class="mb-3 d-flex flex-nowrap"><span class="icon icon-phone mr-3"></span> <span class="leftAlign">Phone : <a href="javascript:void(0);">(+032) 3456 7890</a></span></li>
                 <li class="email d-flex flex-nowrap"><span class="icon icon-email mr-2"></span> <span class="leftAlign">Email: <a href="javascript:void(0);">igh.gift@gmail.com</a></span></li>
             </ul>
             <ul class="list-unstyled followSocailNetwork d-flex flex-nowrap">
                 <li class="fwEbold mr-xl-11 mr-md-8 mr-3">Follow us:</li>
                 <li class="mr-xl-6 mr-md-5 mr-2"><a href="javascript:void(0);" class="fab fa-facebook-f"></a></li>
                 <li class="mr-xl-6 mr-md-5 mr-2"><a href="javascript:void(0);" class="fab fa-twitter"></a></li>
                 <li class="mr-xl-6 mr-md-5 mr-2"><a href="javascript:void(0);" class="fab fa-pinterest"></a></li>
                 <li class="mr-2"><a href="javascript:void(0);" class="fab fa-google-plus-g"></a></li>
             </ul>
         </div>
         <div class="col-12 col-sm-6 col-lg-3 pl-xl-14 mb-lg-0 mb-4">
             <h3 class="headingVI fwEbold text-uppercase mb-6">Information</h3>
             <ul class="list-unstyled footerNavList">
                 <li class="mb-1"><a href="javascript:void(0);">New Products</a></li>
                 <li class="mb-2"><a href="javascript:void(0);">Top Sellers</a></li>
                 <li class="mb-2"><a href="javascript:void(0);">Our Blog</a></li>
                 <li class="mb-2"><a href="javascript:void(0);">About Our Shop</a></li>
                 <li><a href="javascript:void(0);">Privacy policy</a></li>
             </ul>
         </div>
         <div class="col-12 col-sm-6 col-lg-3 pl-xl-12 mb-lg-0 mb-4">
             <h3 class="headingVI fwEbold text-uppercase mb-7">My Account</h3>
             <ul class="list-unstyled footerNavList">
                 <li class="mb-1"><a href="javascript:void(0);">My account</a></li>
                 {{-- <li class="mb-2"><a href="javascript:void(0);">Discount</a></li> --}}
                 <li class="mb-2"><a href="javascript:void(0);">Orders history</a></li>
                 <li><a href="javascript:void(0);">Personal information</a></li>
             </ul>
         </div>
         <div class="col-12 col-sm-6 col-lg-2 pl-xl-18 mb-lg-0 mb-4">
             <h3 class="headingVI fwEbold text-uppercase mb-5">PRODUCTS</h3>
             <ul class="list-unstyled footerNavList">
                 <li class="mb-2"><a href="javascript:void(0);">Delivery</a></li>
                 {{-- <li class="mb-2"><a href="javascript:void(0);">Legal notice</a></li> --}}
                 {{-- <li class="mb-2"><a href="javascript:void(0);">Prices drop</a></li> --}}
                 <li class="mb-2"><a href="javascript:void(0);">New products</a></li>
                 <li><a href="javascript:void(0);">Best sales</a></li>
             </ul>
         </div>
     </div>
 </div>

@endsection
@section('copyright')
<div class="copyRightHolder text-center pt-lg-5 pb-lg-4 py-3">
    <p class="mb-0">Coppyright 2022 by <a href="javascript:void(0);">Code chip</a> - All right reserved</p>
</div>
@endsection

@section('scripts')
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
             var table =  $('.table').DataTable({

                destroy: true,
                "ordering":false,
                "lengthMenu": [ 10, 50, 100, "All"],
             });
            //   var table =  $('#par_table').DataTable({

            //     destroy: true,
            //     "ordering":false,
            //     "lengthMenu": [ 10, 50, 100, "All"],
            //  });
            //   var table =  $('#fer_table').DataTable({

            //     destroy: true,
            //     "ordering":false,
            //     "lengthMenu": [ 10, 50, 100, "All"],
            //  });
            //   var table =  $('#sch_table').DataTable({

            //     destroy: true,
            //     "ordering":false,
            //     "lengthMenu": [ 10, 50, 100, "All"],
             //});

             jQuery( document ).ready(function( $ ) {
               jQuery.noConflict();
                $('.delete_btn').on('click',function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('plantinfo_delete')}}/"+delete_id;
          Swal.fire({
							  title: 'Are you sure?',
							  text: "You won't be able to revert this!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, delete it!'
							}).then(function(result){
                if (result.isConfirmed)
                  {
                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Deleted!',
                                text:'Your file and data has been deleted.',
                                type: 'success',
                              })
                              th.parents('tr').hide();

                            }
                          else{
                                Swal.fire({
                                    title: 'Oopps!',
                                    text: "something went wrong!",
                                    type: 'warning',
                          			})
                          		}
                         }

                        });
                }
              });

        });

// plant parameter delete
          $('#par_table').on('click', '.delete_btn', function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('plantpara_delete')}}/"+delete_id;
          Swal.fire({
							  title: 'Are you sure?',
							  text: "You won't be able to revert this!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, delete it!'
							}).then(function(result){
                if (result.isConfirmed)
                  {
                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Deleted!',
                                text:'Your file and data has been deleted.',
                                type: 'success',
                              })
                              th.parents('tr').hide();

                            }
                          else{
                                Swal.fire({
                                    title: 'Oopps!',
                                    text: "something went wrong!",
                                    type: 'warning',
                          			})
                          		}
                         }

                        });
                }
              });

        });


            // plant fertilizer 
             $('#fer_table').on('click', '.delete_btn', function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('plant_fertilizer_delete')}}/"+delete_id;
          Swal.fire({
							  title: 'Are you sure?',
							  text: "You won't be able to revert this!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, delete it!'
							}).then(function(result){
                if (result.isConfirmed)
                  {
                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Deleted!',
                                text:'Your file and data has been deleted.',
                                type: 'success',
                              })
                              th.parents('tr').hide();

                            }
                          else{
                                Swal.fire({
                                    title: 'Oopps!',
                                    text: "something went wrong!",
                                    type: 'warning',
                          			})
                          		}
                         }

                        });
                }
              });

        });

        // plant fertilizer schedule
             $('#sch_table').on('click', '.delete_btn', function () {
          var delete_id = $(this).attr("id");
          var th=$(this);
          console.log(delete_id);
          var url = "{{url('plant_fertilizer_schedule_delete')}}/"+delete_id;
          Swal.fire({
							  title: 'Are you sure?',
							  text: "You won't be able to revert this!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, delete it!'
							}).then(function(result){
                if (result.isConfirmed)
                  {
                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}'},
                        success:function(data){
                         if (data == 1) {
                          Swal.fire({
                                title:'Deleted!',
                                text:'Your file and data has been deleted.',
                                type: 'success',
                              })
                              th.parents('tr').hide();

                            }
                          else{
                                Swal.fire({
                                    title: 'Oopps!',
                                    text: "something went wrong!",
                                    type: 'warning',
                          			})
                          		}
                         }

                        });
                }
              });

        });


            }); 
        </script>
@endsection