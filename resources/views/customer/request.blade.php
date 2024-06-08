@extends('layouts.header')


@section('title')
    IGH-Request
@endsection

@section('main')
          <!-- introBannerHolder -->
			<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url(assets_1/images/b-bg7.jpg);">
				<div class="container">
					<div class="row">
						<div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center" style="margin-top: 10rem">
							<h1 class="headingIV fwEbold playfair mb-4">Request for IGH</h1>
							<ul class="list-unstyled breadCrumbs d-flex justify-content-center">
								<li class="mr-2"><a href="/">Home</a></li>
								<li class="mr-2">/</li>
								<li class="active">Request for IGH</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<div class="contactSec container pt-xl-24 pb-xl-23 py-lg-20 pt-md-16 pb-md-10 pt-10 pb-0">

			</div>

			<section class="contactSecBlock container pt-xl-23 pb-xl-24 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 py-10">
				<div class="row">
					<header class="col-12 mainHeader mb-10 text-center" style="margin-top: -10rem">
						<h1 class="headingIV playfair fwEblod mb-7">Get In Touch</h1>
						<p>Please contact with us for more information. For this, must enter accurate phone number and email address.</p>
					</header>
				</div>

				<div class="row">
					<div class="col-12">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                        @endif

                        <form action="{{ url('request_save') }}" method="post" class="contactForm">
                            @csrf
							<div class="d-flex flex-wrap row1 mb-md-1">
								<div class="form-group w-50 coll mb-6">
									<input type="text" id="name" class="form-control" name="name" placeholder="Your name  *" required="">
								</div>
								<div class="form-group w-50 coll mb-6">
									<input type="email" class="form-control" id="email" name="Email" placeholder="Your email(Optional)">
								</div>
							</div>
							<div class="d-flex flex-wrap row1 mb-md-1">
								<div class="form-group w-50 coll mb-6">
									<input type="tel" class="form-control" id="tel" name="phone_no" placeholder="Telephone number  *" required="">
								</div>
								<div class="form-group w-50 coll mb-6">
									<input type="text" class="form-control" id="tel" name="address" placeholder="Address  *" required="">
								</div>
							</div>
							<div class="form-group w-100 mb-6">
								<textarea class="form-control" placeholder="Meesage  *" name="desc"></textarea>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4">Send Message</button>
							</div>
						</form>
					</div>
				</div>
			</section>

            <section class="processStepSec container pt-xl-23 pb-xl-10 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 pt-10 pb-0">
				<div class="row">
					<header class="col-12 mainHeader mb-3 text-center">
						<h1 class="headingIV playfair fwEblod mb-4">Delivery Process</h1>
						<span class="headerBorder d-block mb-5"><img src="{{ asset('assets_1/images/hbdr.png') }}" alt="Header Border" class="img-fluid img-bdr"></span>
					</header>
				</div>
				<div class="row">
					<div class="col-12 pl-xl-23 mb-lg-3 mb-10">
						<div class="stepCol position-relative bg-lightGray py-6 px-6">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 01</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Make a Request</h2>
							<p class="mb-5">Make a request for an Intelligent Green House by clicking on the Request IGH from the Navbar and then fill the form.</p>
							<p>Must fill up the accurate information.</p>
						</div>
					</div>
					<div class="col-12 pr-xl-23 mb-lg-3 mb-10">
						<div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 02</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">View Request</h2>
							<p class="mb-5">We will view your request and then we will call you for further discussion.</p>
						</div>
					</div>
					<div class="col-12 pl-xl-23 mb-lg-3 mb-10">
						<div class="stepCol position-relative bg-lightGray py-6 px-6">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 03</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Negotiation</h2>
							<p class="mb-5">We will discuss about your requirements for Green House and will try to fulfill your expectations.</p>
						</div>
					</div>
					<div class="col-12 pr-xl-23 mb-lg-3 mb-10">
						<div class="stepCol rightArrow position-relative bg-lightGray py-6 px-6 float-right">
							<strong class="mainTitle text-uppercase mt-n8 mb-5 d-block text-center py-1 px-3">step 04</strong>
							<h2 class="headingV fwEblod text-uppercase mb-3">Get your IGH</h2>
							<p class="mb-5">The plug and Play product will be delivered to you at your place.</p>
						</div>
					</div>
				</div>
                </section>
			<!-- footerHolder -->
@endsection
