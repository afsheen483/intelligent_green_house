@extends('layouts.header')
<style>
/* body {
overflow: hidden; 
} */

</style>
@section('main')
 <form action="/insert_plant_lifecycle" method="post">


     @csrf

        <div class="row">
            <div class="col-xl-10 col-xm-10 col-sm-10 col-lg-10 col-md-10">
                <br>
                <br>
                <div class="card m-b-30" style="margin-top:5rem;margin-left:5cm;">
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

                    <div class="card-body">

                        <!-- Nav tabs -->
                        <ul class="nav nav-pills nav-justified" role="tablist" id="myTabs">
                            <li class="nav-item waves-effect waves-light active">
                                <a class="nav-link active" data-toggle="tab" href="#plant_info" role="tab" id="one">
                                    <span class="d-none d-md-block">Plant Info</span><span class="d-block d-md-none"><i class="mdi mdi-airplane h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#parameters" role="tab" id="two">
                                    <span class="d-none d-md-block">Parameters</span><span class="d-block d-md-none"><i class="mdi mdi-account-badge-horizontal h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#fertilizer" role="tab" id="three">
                                    <span class="d-none d-md-block">Fertilizers</span><span class="d-block d-md-none"><i class="mdi mdi-bus h5"></i></span>
                                </a>
                            </li>
                            <li class="nav-item waves-effect waves-light">
                                <a class="nav-link" data-toggle="tab" href="#timing" role="tab" id="lastnav">

                                    <span class="d-none d-md-block">Fertilizer Schedule</span><span class="d-block d-md-none"><i class="mdi mdi-bed-empty h5"></i></span>
                                </a>
                            </li>
                        </ul>
                         <div class="tab-content">
                             <div class="tab-pane show active p-3" id="plant_info" role="tabpanel">

                                
                                     <div class="validation-summary-valid" data-valmsg-summary="true">
                                         <ul>
                                             <li style="display:none"></li>
                                         </ul>
                                     </div>
                                     
                                     <div class="row">
                                         <div class="col-md-5 col-xl-5 col-5 p1-5">

                                             <div class="form-group">
                                                 <label for="">Plant Name</label>
                                                 <input class="form-control" type="text" name="plant_name" id="plant_name" placeholder="Enter plant name" required>

                                             </div>
                                        </div>
                                        <div class="col-md-5 col-xl-5 col-5 p1-5">

                                            <div class="form-group">
                                                <label for="">Plant Life Duration</label>
                                                <input class="form-control" min="1" type="number" name="plant_life_duration" id="plant_life_duration" placeholder="Enter plant life duration" required>

                                            </div>
                                        </div>
                                   </div>
                                    <div class="row">
                                        <div class="col-md-10 col-xl-10 col-10 p1-5">
                                            <div class="form-group">
                                                <label>Plant Description</label>
                                                <textarea name="plant_description" id="plant_description" class="form-control" id="" cols="30" rows="10" required></textarea>

                                            </div>
                                        </div>
                                    </div>




                             </div>
                             <div class="tab-pane p-3" id="parameters" role="tabpanel">

                                 <div class="validation-summary-valid" data-valmsg-summary="true">
                                     <ul>
                                         <li style="display:none"></li>
                                     </ul>
                                 </div>
                                 
                               <div class="row">
                                     
                                     <div class="col-md-3 p1-5">
                                         <div class="form-group">
                                             <label for="">Parameter</label>
                                             <select name="parameter_id[]" id="parameter_id" class="form-control" required>

                                                 <option value="">Select</option>
                                                 @foreach ($parameter_array as $arr)
                                                
                                                 <option value="{{ $arr->id }}">{{ $arr->parameter_name }}</option>

                                                 
                                                 @endforeach
                                             </select> </div>
                                     </div>

                                     <div class="col-md-2 p1-5">
                                         <div class="form-group">
                                             <label>Range From</label>
                                             <input type="number" name="range_from[]" id="range_from" required class="form-control" placeholder="Range from">

                                         </div>
                                     </div>
                                     <div class="col-md-2 p1-5">
                                         <div class="form-group">
                                             <label>Range To</label>
                                             <input type="number" name="range_to[]" id="range_to" required class="form-control" placeholder="Range to">

                                         </div>
                                     </div>
                                     <div class="col-md-2 p1-5">
                                         <div class="form-group">
                                             <label>Request Value</label>
                                             <input type="number" name="request_value[]" id="request_value" required class="form-control" placeholder="Request value">

                                         </div>
                                     </div>
                                     <div class="col-md-2 p1-5">
                                         <div class="form-group">
                                             <label>Thershold</label>
                                             <input type="number" name="threshold[]" id="threshold" required class="form-control" placeholder="Enter thershold">

                                         </div>
                                     </div>
                                     <div class="col-1 p1-5" id="add_btn" style="margin-top:3rem">
                                         <button type= "button" id="add" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                     </div>

                                 </div>



                             </div>
                             <div class="tab-pane p-3" id="fertilizer" role="tabpanel">

                                 <div class="validation-summary-valid" data-valmsg-summary="true">
                                     <ul>
                                         <li style="display:none"></li>
                                     </ul>
                                 </div>
                                <div class="row">
                                
                                    <div class="col-10 p1-5">
                                        <div class="form-group">
                                            <label for="">Fertilizer Name</label>
                                            <select name="fertilizer_id" id="fertilizer_id" class="form-control" required>

                                                <option value="">Select fertilizer name</option>
                                                @foreach ($fertilizer_array as $arr)
                                                <option value="{{ $arr->id }}">{{ $arr->fertilizer_name }}</option>

                                               
                                                @endforeach
                                            </select>
                                        </div>
                    
                                    </div>
                                    <div class="col-1 p1-5" style="margin-top:3rem">
                                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i></button>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-5 p1-5">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="number" name="quantity" id="quantity" required class="form-control" placeholder="quantity">

                                        </div>
                                    </div>
                                    <div class="col-5 p1-5">
                                        <div class="form-group">
                                            <label>Time Duration</label>
                                            <input type="number" name="time_duration" id="time_duration" required class="form-control" placeholder="Time duration">

                                        </div>
                                    </div>

                                </div>

                                

                             </div>
                             <div class="tab-pane p-3" id="timing" role="tabpanel">


                                 <div class="validation-summary-valid" data-valmsg-summary="true">
                                     <ul>
                                         <li style="display:none"></li>
                                     </ul>
                                 </div>
                                 <div class="row">
                                   
                                     <div class="col-lg-6 form-group">
                                         <label for="HotelDays">Numbers of Days</label>
                                         <input class="form-control text-box single-line" data-val="true" data-val-number="The field Days must be a number." id="day_no" name="day_no" placeholder="Days" type="number" value="" />

                                         <span class="field-validation-valid text-danger" data-valmsg-for="HotelDays" data-valmsg-replace="true"></span>
                                     </div>
                                 </div>
                               

                             </div>
                             
                         </div>
                        <button type="submit" class="btn btn-success btn-lg" style="float:right;display:none;" id="save">Save</button>
                        </form>
                        <button type="button" class="btn btn-secondary btn-lg next-tab" id="nextbtn" style="float:right">Next</button>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add Fertilizer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                             <form method="POST" action="{{ url('fertilizer_store')}}">
                                @csrf
                                     <div class="container" style="margin-left: 2%">
                                         <div class="row">

                                             <div class="col-12 p1-5">
                                                 <div class="form-group">
                                                     <label>Fertilizer Name</label>
                                                     <input type="text" name="fertilizer_name" required class="form-control" placeholder="Enter fertilizer name">
                                                 </div>
                                             </div>
                                         </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button class="btn btn-success submit-btn">Save</button>

                        </div>
                    </form>

                    </div>
                </div>
            </div>
            {{-- end --}}
        </div>
<br>
<br>
<br>

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
    <p class="mb-0">Coppyright 2019 by <a href="javascript:void(0);">Code chip</a> - All right reserved</p>
</div>
@endsection

@section('scripts')
            <script>
                $('.next-tab').click(function () {
                $('.nav-pills > .nav-item > .active').parent().next('li').find('a').trigger('click');

                });
                
                $('#lastnav').click(function () {
                if (this.id == 'lastnav') {
                $("#nextbtn").hide();
                $("#save").show();
                }
            });
                //hide the save button when we click on previous tab
                $("#one,#two,#three").click(function(){
                    if(this.id == 'one'){
                        $("#save").hide();
                        $("#nextbtn").show();
                    }
                    else if(this.id == 'two'){
                    $("#save").hide();
                    $("#nextbtn").show();
                    } 
                    else if(this.id == 'three'){
                    $("#save").hide();
                    $("#nextbtn").show();
                    }


                });


            var MaxInputs = 365; //maximum extra input boxes allowed
            var InputsWrapper = $("#parameters"); //Input boxes wrapper ID
            var AddButton = $("#add");
            var x = InputsWrapper.length; //initlal text box count
            var FieldCount=1;


            $(AddButton).click(function(){
                 if(x <= MaxInputs) { FieldCount++; //text box added ncrement //add input box 
                                    //$(InputsWrapper).append('<div><input type="text" name="mytext[]" id="field_'+ FieldCount +'" /> <a href="#" class="removeclass">Remove</a></div>');
                    $(InputsWrapper).append('<span><div class="row add_row"><div class="col-md-3 p1-5"><div class="form-group"><label for="">Parameter</label><select name="parameter_id[]" id="field_'+ FieldCount +'" class="form-control" required><option value="">Select</option><option value="1">Soil moisture</option><option value="2">Humidity</option><option value="3">Sun Light</option><option value="4">Temperature</option></select> </div></div><div class="col-md-2 p1-5"><div class="form-group"><label>Range From</label><input type="number" name="range_from[]" id="field_'+ FieldCount +'" required class="form-control" placeholder="Range from"></div></div><div class="col-md-2 p1-5"><div class="form-group"><label>Range To</label><input type="number" name="range_to[]" id="field_'+ FieldCount +'" class="form-control" placeholder="Range to" required></div></div><div class="col-md-2 p1-5"><div class="form-group"><label>Request Value</label><input type="number" name="request_value[]" id="field_'+ FieldCount +'" required class="form-control" placeholder="Request value"></div></div><div class="col-md-2 p1-5"><div class="form-group"><label>Thershold</label><input type="number" name="threshold[]" id="field_'+ FieldCount +'" required class="form-control" placeholder="Enter thershold"></div></div><div class="col-1 p1-5" style="margin-top:3rem"><button class="btn btn-danger remove" id='+FieldCount+'><i class="fa fa-trash"></i></button></div></div></span>');

                     x++; //text box increment

                     $("#add_btn").show();
                     $('#add').html("<i class='fa fa-plus'></i>");

                     // Delete the "add"-link if there is 3 fields.
                     if(x == 365) {
                     $("#add").hide();
                     $("#lineBreak").html("<br>");
                     }
                     }
                     return false;

               
                
            });
            $("#parameters").on("click",".remove", function(e){ //user click on remove text
            var delete_id = $(this).attr("id");
             var th=$(this);
            //alert(delete_id);
            if( x >= 1 ) {
            //$(this).remove(); //remove text box
            th.closest('span').remove();




            x--; //decrement textbox

            $("#add_btn").show();
            $("#add").show();


            $("#lineBreak").html("");

            // Adds the "add" link again when a field is removed.
            $('#add').html("<i class='fa fa-plus'></i>");

            }
            return false;
            })

            $("#save").click(function(){
                var plant_name = $("#plant_name").val();
                var plant_life_duration = $("#plant_life_duration").val();
                var plant_description = $("#plant_description").val();
                var plant_id = $("#plant_id").val();
                var parameter_id = $("#parameter_id").val();
                var range_from = $("#range_from").val();
                var range_to = $("#range_to").val();
                var requested_value = $("#requested_value").val();
                var threshold = $("#threshold").val();
               

            });
            </script>
@endsection