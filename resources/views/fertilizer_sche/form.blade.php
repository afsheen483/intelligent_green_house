@extends('layouts.header')



@section('main')

<div class="card" style="margin-top:9rem">
    <div class="card-header">
              <a href="{{ url()->previous() }}" style="float:right" class="btn btn-success">Back</a>

      <h5 class="title">New Plant Information</h5>
    </div>
    <div class="card-body">
     @if (request()->id == 0)
       <form method="POST" action="{{ url('plantinfo_store')}}">
      @csrf
    @else
    <form method="POST" action="{{ url('plantfertilizer_schedule_update',['id'=>$plant_info->id])}}">
      @csrf
      @method('PUT')
    @endif
      <div class="container" style="margin-left: 15%">
        <div class="row">
          <div class="col-md-3 p1-5">
            <div class="form-group">
                <label for="">Day No</label>
                <input class="form-control" type="number" name="day_no" placeholder="Enter plant name" required value="{{ is_null($plant_info->day_no) ? '' : $plant_info->day_no }}">
            </div>
          </div>
         
          </div>
          

         <div class="row">
            <div class="col-md-6 p1-5">
                <button class="btn btn-success submit-btn">Save</button>
            </div>
         </div>
        </div>

      </form>
    </div>
</div>

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






@endsection

@section('scripts')
    <script>
      $(document).ready(function(){

      });
    </script>
@endsection
