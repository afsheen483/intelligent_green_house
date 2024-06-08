@extends('layouts.header')


@section('main')

<div class="card" style="margin-top:6rem">
    <div class="card-header">
              <a href="{{ url()->previous() }}" style="float:right" class="btn btn-success">Back</a>

      {{-- <h5 class="title">New Plant Information</h5> --}}
    </div>
    <div class="card-body">
     @if (request()->id == 0)
       <form method="POST" action="{{ url('plantpara_store')}}">
      @csrf
    @else
    <form method="POST" action="{{ url('plantpara_update',['id'=>$plant_info->id])}}">
      @csrf
      @method('PUT')
    @endif
      <div class="container" style="margin-left: 2%">
        <div class="row">
          <div class="col-md-2 p1-5">
            <div class="form-group">
                <label for="">Plant Name</label>
                <select name="plant_id" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($plant_array as $arr)
                        @if ($plant_info->plant_id == $arr->id)
                            <option value="{{ $arr->id }}" selected>{{ $arr->plant_name }}</option>
                        @else
                        <option value="{{ $arr->id }}">{{ $arr->plant_name }}</option>

                        @endif
                    @endforeach
                </select>
            </div>
          </div>
          <div class="col-md-2 p1-5">
            <div class="form-group">
                <label for="">Parameter</label>
                <select name="parameter_id" id="" class="form-control" required>
                    <option value="">Select</option>
                    @foreach ($parameter_array as $arr)
                        @if ($plant_info->parameter_id == $arr->id)
                            <option value="{{ $arr->id }}" selected>{{ $arr->parameter_name }}</option>

                        @else
                            <option value="{{ $arr->id }}">{{ $arr->parameter_name }}</option>

                        @endif
                    @endforeach
                </select>            </div>
          </div>

            <div class="col-md-2 p1-5">
              <div class="form-group">
                <label>Range From</label>
                <input type="number" name="range_from" required class="form-control" placeholder="Range from" value="{{ is_null($plant_info->range_from) ? '' :  $plant_info->range_from}}">
              </div>
            </div>
            <div class="col-md-2 p1-5">
                <div class="form-group">
                  <label>Range To</label>
                  <input type="number" name="range_to" required class="form-control" placeholder="Range to" value="{{ is_null($plant_info->range_to) ? '' :  $plant_info->range_to}}">
                </div>
              </div>
              <div class="col-md-2 p1-5">
                <div class="form-group">
                  <label>Request Value</label>
                  <input type="number" name="request_value" required class="form-control" placeholder="Request value" value="{{ is_null($plant_info->request_value) ? '' :  $plant_info->request_value}}">
                </div>
              </div>
              <div class="col-md-2 p1-5">
                <div class="form-group">
                  <label>Thershold</label>
                  <input type="number" name="threshold" required class="form-control" placeholder="Enter thershold" value="{{ is_null($plant_info->threshold) ? '' :  $plant_info->threshold}}">
                </div>
              </div>
          </div>
          <div class="row">
            <div class="col-md-6 p1-5">
                <button class="btn btn-success submit-btn">Save</button>
            </div>
         </div>
          {{-- <div class="row" style="display: none" id="hide">
            <div class="col-md-2 p1-5">
                <div class="form-group">
                    <label for="">Plant Name</label>
                    <select name="plant_id" id="" class="form-control" required>
                        <option value="">Select</option>
                        @foreach ($plant_array as $arr)
                            <option value="{{ $arr->id }}">{{ $arr->plant_name }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <div class="col-md-2 p1-5">
                <div class="form-group">
                    <label for="">Parameter</label>
                    <select name="paramete_id" id="" class="form-control" required>
                        <option value="">Select</option>
                        @foreach ($parameter_array as $arr)
                            <option value="{{ $arr->id }}">{{ $arr->parameter_name }}</option>
                        @endforeach
                    </select>            </div>
              </div>

                <div class="col-md-2 p1-5">
                  <div class="form-group">
                    <label>Range From</label>
                    <input type="number" name="range_from" required class="form-control" placeholder="Range from">
                  </div>
                </div>
                <div class="col-md-2 p1-5">
                    <div class="form-group">
                      <label>Range To</label>
                      <input type="number" name="range_to" required class="form-control" placeholder="Range to">
                    </div>
                  </div>
                  <div class="col-md-2 p1-5">
                    <div class="form-group">
                      <label>Request Value</label>
                      <input type="number" name="request_value" required class="form-control" placeholder="Request value">
                    </div>
                  </div>
                  <div class="col-md-2 p1-5">
                    <div class="form-group">
                      <label>Thershold</label>
                      <input type="number" name="thershold" required class="form-control" placeholder="Enter thershold">
                    </div>
                  </div>
          </div> --}}
          {{-- <div class="row">
            <div class="col-md-1">
                <button class="btn btn-primary " id="add">Add</button>
              </div>
              <div class="col-md-1">
                <button class="btn btn-danger " id="remove">Remove</button>
              </div>
          </div> --}}
          <br>



      </div>
      </form>
    </div>
</div>


<br><br>





@endsection
@section('footer')
 <div class="container">
     <div class="row">
         <div class="col-12 col-sm-6 col-lg-4 mb-lg-0 mb-4">
             <h3 class="headingVI fwEbold text-uppercase mb-7">Contact Us</h3>
             <ul class="list-unstyled footerContactList mb-3">
                 <li class="mb-3 d-flex flex-nowrap pr-xl-20 pr-0"><span class="icon icon-place mr-3"></span>
                     <address class="fwEbold m-0">Address: London Oxford Street, 012 United Kingdom.</address>
                 </li>
                 <li class="mb-3 d-flex flex-nowrap"><span class="icon icon-phone mr-3"></span> <span class="leftAlign">Phone : <a href="javascript:void(0);">(+032) 3456 7890</a></span></li>
                 <li class="email d-flex flex-nowrap"><span class="icon icon-email mr-2"></span> <span class="leftAlign">Email: <a href="javascript:void(0);">Botanicalstore@gmail.com</a></span></li>
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
                 <li class="mb-2"><a href="javascript:void(0);">Discount</a></li>
                 <li class="mb-2"><a href="javascript:void(0);">Orders history</a></li>
                 <li><a href="javascript:void(0);">Personal information</a></li>
             </ul>
         </div>
         <div class="col-12 col-sm-6 col-lg-2 pl-xl-18 mb-lg-0 mb-4">
             <h3 class="headingVI fwEbold text-uppercase mb-5">PRODUCTS</h3>
             <ul class="list-unstyled footerNavList">
                 <li class="mb-2"><a href="javascript:void(0);">Delivery</a></li>
                 <li class="mb-2"><a href="javascript:void(0);">Legal notice</a></li>
                 <li class="mb-2"><a href="javascript:void(0);">Prices drop</a></li>
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
    <script>
      $(document).ready(function(){
        // $("#add").click(function(){
        //     $("#hide").toggle();
        // });
      });
    </script>
@endsection
