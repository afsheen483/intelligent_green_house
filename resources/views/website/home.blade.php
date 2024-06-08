@extends('layouts.header')
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

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
			<section class="introBlock position-relative" style="margin-top: 5rem">
				<div class="slick-fade">
					<div>
                       
                            
						<div class="align w-100 d-flex align-items-center bgCover" style="background-image: url(assets_1/images/b-bg.jpg);">
							<!-- holder -->
                            <div class="container position-relative holder pt-xl-6 pt-0">

                             @foreach ($customer_igh as $igh)
                                <div class="card" style="width: 45rem;height:33rem; background-color: rgb(249, 250, 249);
                                opacity: .9;">
                                @if (Request()->id > 0)
                                    <div class="card-body"><a href="#" style="color: green;pointer-events: none" class="session_status_btn"><i class=" fas fa-power-off fa-1x" style="float: right;"></i></a>

                                @else
                                    <div class="card-body"><a id="{{ $igh->id }}"   class="session_status_btn"><i class=" fas fa-power-off fa-1x"></i></a>
                                @endif
                                       <div class="card-title" style="font-weight: bold;font-size:35px;margin-left:20rem">{{ $igh->name }}</div>
                                        <div class="row">
                                            <div class="col-6" >
                                                   {{-- <canvas id="myChart" height="100px" width="100px"></canvas> --}}
                                                   <img src="" alt="">

                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: 20rem;margin-top:-10rem">
                                            <div class="col-2" style="margin-left: 4rem">
                                                <a href="http://10.211.0.247:8080/video"><i class="fa fa-video-camera" aria-hidden="true" style="font-size: 3rem"></i><br>
                                                <label for="">Live Stream</label></a>
                                            </div>
                                            <div class="col-2" style="margin-left: 3rem">
                                                <a href="/view_plantlife/{{ $igh->customer_id }}"><i class="fa fa-leaf" aria-hidden="true" style="font-size: 3rem"></i><br><br>
                                                <label for="">Plant</label></a>
                                            </div>
                                           
                                        </div>
                                        <div class="row" style="margin-top:2rem;margin-left: 9rem">
                                            <div class="col-2" style="margin-left:  14rem">
                                                <a href="" class="main_modal" id="{{ $igh->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-cog" aria-hidden="true" style="font-size: 3rem"></i><br><br>
                                                <label for="">Maintenance</label></a>
                                            </div>
                                            <div class="col-2" style="margin-left: 2rem">
                                                <a id="{{ $igh->id }}" class="status_modal"  data-toggle="modal" data-target="#statusModal"><i class="fa fa-bar-chart" aria-hidden="true" style="font-size: 3rem"></i><br><br>
                                                <label for="">Currrent Status</label></a>
                                            </div>
                                           
                                        </div>
                                        <div class="row" style="margin-top:2rem;margin-left: 20rem">
                                             <div class="col-1" style="margin-left: 3rem">
                                                <a href="/igh_history/{{ $igh->id }}"><i class="fa fa-history" style="font-size: 3rem"></i><br><br>
                                                <label for="">History</label></a>
                                            </div>
                                        </div>
                                    </div>
                                  </div>
                                  <br>
                                  @endforeach
								<!-- py-12 pt-lg-30 pb-lg-25 -->
									<div class="imgHolder">
										<img src="{{ asset('assets_1/images/img79.png') }}" alt="image description" class="img-fluid w-100" style="z-index:-1;
                                        position:relative;">
									</div>
								</div>
							</div>
						</div>
                        
					</div>

				</div>
				{{-- <div class="slickNavigatorsWrap">
					<a href="#" class="slick-prev"><i class="icon-leftarrow"></i></a>
					<a href="#" class="slick-next"><i class="icon-rightarrow"></i></a>
				</div> --}}
			</section>
			<!-- chooseUs-sec -->

		</main>
		<!-- footer -->

	</div>
    <!--maintanance  Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Maintainance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('maintainance_store') }}" method="post">
            @csrf
            <input type="text" name="green_house_id" value="" class="id" hidden>
            <div class="row">
                <div class="col-6">
                    <label for="">Location</label>
                    <input type="text" placeholder="Enter the location" name="location" id="" class="form-control" required>
                </div>
                <div class="col-6">
                    <label for="">Work Hours</label>
                    <input type="number" placeholder="Enter work hours" name="work_hours" id="" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="">Feedback</label>
                    <textarea name="feedback" id="" cols="30" rows="10" class="form-control" required></textarea>
                </div>
            </div>
             <div class="row">
                <div class="col-12">
                    <label for="">Note</label>
                    <textarea name="note" id="" cols="30" rows="10" class="form-control" required></textarea>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- end modal --}}

 <!--status  Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actuator Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <form action="{{ url('status_feedback') }}" method="post">
            @csrf
            @method('PUT') --}}
            <input type="text" name="green_house_id" value="" class="status_id" hidden>
            <div class="row">
                <div class="col-9">
                    <label for="">Fan Status</label>
                </div>
                <div class="col-3 fs">
                    <input id="toggle-fan" name="fan_status" type="checkbox" data-toggle="toggle">
                     
                </div>
        
            </div>
            <br>
            <div class="row">
                <div class="col-9">
                    <label for="">Motor Status</label>
                </div>
                <div class="col-3 ms">
                     <input id="toggle-motor" name="motor_status" type="checkbox" data-toggle="toggle">
                </div>
            </div>
            <br>
             <div class="row">
                <div class="col-9">
                    <label for="">Heater Status</label>
                </div>
                <div class="col-3">
                     <input id="toggle-heater" name="heater_status" type="checkbox" data-toggle="toggle">
                </div>
            </div>
            <br>
            <div class="row">
                 <div class="col-9">
                    <label for="">Sun Light Status</label>
                </div>
                <div class="col-3">
                        <input id="toggle-light" name="light_status" type="checkbox" data-toggle="toggle">
                </div>
                </div>
                
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="save" class="btn btn-success">Save</button>
       
      </div>
      </div>
    </div>
  </div>
</div>
{{-- end modal --}}
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
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
         var required_value =  {{ Js::from($required_value) }};
      var users =  {{ Js::from($data) }};
  
      const data = {
        required_value: required_value,
        datasets: [{
          label: 'data',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: users,
        }]
      };
  
      const config = {
        type: 'pie',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
    </script>
    <Script>
        jQuery(document).ready(function(){
            $(".main_modal").click(function(){
                var id = $(this).attr("id");
                $(".id").val(id);
            });
            $('#toggle-fan').change(function() {
            $('#fan-event').html($(this).prop('checked'));
                                       
            });
            $(".status_modal").click(function(){
                var igh_id = $(this).attr("id");
                //alert(igh_id);
                $(".status_id").val(igh_id);
                var url = "{{url('plant_details')}}/"+igh_id;

                 $.ajax({

                        url : url,
                        type : 'GET',
                        cache: false,
                        data: {
                            _token:'{{ csrf_token() }}',
                        },
                        success:function(data){
                            console.log(data);
                         
                        if (data.fan_status == 1) {
                            $('#toggle-fan').bootstrapToggle('on');
                             $('#toggle-fan').val('true');
                                 $('#toggle-fan').change(function() {
                                    $('#toggle-fan').val($(this).prop('checked'));
                                       
                                    });
                        }  else {
                            $('#toggle-fan').bootstrapToggle('off');
                             $('#toggle-fan').val('false');
                                 $('#toggle-fan').change(function() {
                                    $('#toggle-fan').val($(this).prop('checked'));
                                       
                                    });
                        }

                        if (data.motor_status == 1) {
                             $('#toggle-motor').bootstrapToggle('on');
                                 $('#toggle-motor').change(function() {
                                $('#toggle-motor').val('true');
                                 $('#toggle-motor').change(function() {
                                    $('#toggle-motor').val($(this).prop('checked'));
                                       
                                    });                                    });
                        }else{
                             $('#toggle-motor').bootstrapToggle('off');
                             $('#toggle-motor').val('false');
                                 $('#toggle-motor').change(function() {
                                    $('#toggle-motor').val($(this).prop('checked'));
                                       
                                    });
                        }
                        if (data.heater_status == 1) {
                                 $('#toggle-heater').bootstrapToggle('on');
                                 $('#toggle-heater').change(function() {
                                $('#toggle-heater').val('true');
                                 $('#toggle-heater').change(function() {
                                    $('#toggle-heater').val($(this).prop('checked'));
                                       
                                    });                                   
                                
                            });
                        }else{
                            $('#toggle-heater').bootstrapToggle('off');
                             $('#toggle-heater').val('false');
                                 $('#toggle-heater').change(function() {
                                    $('#toggle-heater').val($(this).prop('checked'));
                                       
                                    });
                        }
                         if (data.sun_light_status == 1) {
                                $('#toggle-light').bootstrapToggle('on');
                                 $('#toggle-light').change(function() {
                                $('#toggle-light').val('true');
                                 $('#toggle-light').change(function() {
                                    $('#toggle-light').val($(this).prop('checked'));
                                       
                                    });  
                                });
                        }else{
                             $('#toggle-light').bootstrapToggle('off');
                             $('#toggle-light').val('false');
                                 $('#toggle-light').change(function() {
                                    $('#toggle-light').val($(this).prop('checked'));
                                       
                                    });
                        }


                         }

            });
             });


            // fan update status
            
       
        //     $("#toggle-fan").on('change',function(){
        //           var fan_status = '';
        //           if (this.id == 'toggle-fan') {
        //             var fan_status = $(this).val();
        //         }
        //       $("#save").click(function(){
        //         var status_id = $(".status_id").val();
        //                 var url = "{{url('fan_status')}}/"+status_id;
        //                 Swal.fire({
		// 					  title: 'Are you sure?',
		// 					  text: "You want to update the status of actuator!",
		// 					  type: 'warning',
		// 					  showCancelButton: true,
		// 					  confirmButtonColor: '#3085d6',
		// 					  cancelButtonColor: '#d33',
		// 					  confirmButtonText: 'Yes, update it!'
		// 					}).then(function(result){
        //         if (result.isConfirmed)
        //           {
        //               $.ajax({

        //                 url : url,
        //                 type : 'PUT',
        //                 cache: false,
        //                 data: {_token:'{{ csrf_token() }}',
        //                 fan_status:fan_status

        //             },
        //                 success:function(data){
        //                  if (data == 1) {
        //                   Swal.fire({
        //                         title:'Update!',
        //                         text:'Your actuator has been updated successfully.',
        //                         type: 'success',
        //                       })
        //                       th.parents('tr').hide();

        //                     }
        //                   else{
        //                         Swal.fire({
        //                             title: 'Oopps!',
        //                             text: "something went wrong!",
        //                             type: 'warning',
        //                   			})
        //                   		}
        //                  }

        //                 });
        //                 }
                
        //       });
        //    });
                

        //     });



            // // motor_status update
            //  $("#toggle-motor").change(function(){
            //     var motor_status = '';
            //      if (this.id == 'toggle-motor') {
            //         var motor_status = $(this).val();
            //     }
            //        $("#save").click(function(){
            //     var status_id = $(".status_id").val();
            //             var url = "{{url('motor_status')}}/"+status_id;
            //             Swal.fire({
			// 				  title: 'Are you sure?',
			// 				  text: "You want to update the status of actuator!",
			// 				  type: 'warning',
			// 				  showCancelButton: true,
			// 				  confirmButtonColor: '#3085d6',
			// 				  cancelButtonColor: '#d33',
			// 				  confirmButtonText: 'Yes, update it!'
			// 				}).then(function(result){
            //     if (result.isConfirmed)
            //       {
            //           $.ajax({

            //             url : url,
            //             type : 'PUT',
            //             cache: false,
            //             data: {_token:'{{ csrf_token() }}',
            //             motor_status:motor_status,
                      

            //         },
            //             success:function(data){
            //              if (data == 1) {
            //               Swal.fire({
            //                     title:'Update!',
            //                     text:'Your actuator has been updated successfully.',
            //                     type: 'success',
            //                   })
            //                   th.parents('tr').hide();

            //                 }
            //               else{
            //                     Swal.fire({
            //                         title: 'Oopps!',
            //                         text: "something went wrong!",
            //                         type: 'warning',
            //               			})
            //               		}
            //              }

            //             });
            //             }
                
            //   });
            // });
                

            // });


            // heater status update

            //  $("#toggle-heater").change(function(){
            //     var heater_status = '';
                
               
            //     if (this.id == 'toggle-heater') {
            //         var heater_status = $(this).val();
            //     }
            //        $("#save").click(function(){
                    
            //     var status_id = $(".status_id").val();

            //             var url = "{{url('heater_status')}}/"+status_id;
            //             Swal.fire({
			// 				  title: 'Are you sure?',
			// 				  text: "You want to update the status of actuator!",
			// 				  type: 'warning',
			// 				  showCancelButton: true,
			// 				  confirmButtonColor: '#3085d6',
			// 				  cancelButtonColor: '#d33',
			// 				  confirmButtonText: 'Yes, update it!'
			// 				}).then(function(result){
            //     if (result.isConfirmed)
            //       {
            //           $.ajax({

            //             url : url,
            //             type : 'PUT',
            //             cache: false,
            //             data: {_token:'{{ csrf_token() }}',
                     
            //             heater_status:heater_status

            //         },
            //             success:function(data){
            //              if (data == 1) {
            //               Swal.fire({
            //                     title:'Update!',
            //                     text:'Your actuator has been updated successfully.',
            //                     type: 'success',
            //                   })
            //                   th.parents('tr').hide();

            //                 }
            //               else{
            //                     Swal.fire({
            //                         title: 'Oopps!',
            //                         text: "something went wrong!",
            //                         type: 'warning',
            //               			})
            //               		}
            //              }

            //             });
            //             }
                
            //   });
            // });
                

            // });



            // light_status update
            var flag = 1;
             $(".session_status_btn").click(function(){
               var id = $(this).attr("id");
            
           
                if(flag){
                //alert('1');
                 var url = "{{url('session_status')}}/"+id;
                        Swal.fire({
							  title: 'Are you sure?',
							  text: "You want to update the status of actuator!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, update it!'
							}).then(function(result){
                if (result.isConfirmed)
                  {
                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}',
                        flag:flag
                    },
                        success:function(data){
                         if (data == 1) {
                            $(".session_status_btn").css("color","");

                            $(".session_status_btn").css("color","green");

                          Swal.fire({
                                title:'Update!',
                                text:'Your session  has been activated successfully.',
                                type: 'success',
                              })
                              

                            }
                          else{
                            $(".session_status_btn").css("color","");
                             $(".session_status_btn").css("color","red");
                                Swal.fire({
                                    title: 'update!',
                                    text: "Your session  has been activated successfully!",
                                    type: 'success',
                          			})
                          		}
                         }

                        });
                flag = 0;

                }
            })
        }
                else{
               // alert('0');
                flag = 1;
                 var url = "{{url('session_status')}}/"+id;
                        Swal.fire({
							  title: 'Are you sure?',
							  text: "You want to update the status of session!",
							  type: 'warning',
							  showCancelButton: true,
							  confirmButtonColor: '#3085d6',
							  cancelButtonColor: '#d33',
							  confirmButtonText: 'Yes, update it!'
							}).then(function(result){
                if (result.isConfirmed)
                  {
                      $.ajax({

                        url : url,
                        type : 'PUT',
                        cache: false,
                        data: {_token:'{{ csrf_token() }}',
                        flag:flag
                    },
                        success:function(data){
                         if (data == 1) {
                             $(".session_status_btn").css("color","");
                             $(".session_status_btn").css("color","green");
                          Swal.fire({
                                title:'Update!',
                                text:'Your session status has been activated successfully.',
                                type: 'success',
                              })
                              

                            }
                          else{
                            $(".session_status_btn").css("color","");

                             $(".session_status_btn").css("color","red");
                                Swal.fire({
                                    title: 'update!',
                                    text: "Your session status has been deactivated successfully!",
                                    type: 'success',
                          			})
                          		}
                         }

                        });
                } 
                
               
        
              
               
                
               
                       
                       
                
              });
            }
        });
    });
       
    </Script>
@endsection