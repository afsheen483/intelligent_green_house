@extends('layouts.header')


@section('title')
    IGH-Contact
@endsection

@section('main')
            <!-- introBannerHolder -->
			<section class="introBannerHolder d-flex w-100 bgCover" style="background-image: url(assets_1/images/b-bg7.jpg);">
				<div class="container">
					<div class="row">
						<div class="col-12 pt-lg-23 pt-md-15 pt-sm-10 pt-6 text-center">
							<h1 class="headingIV fwEbold playfair mb-4">Contact</h1>
							<ul class="list-unstyled breadCrumbs d-flex justify-content-center">
								<li class="mr-2"><a href="home.html">Home</a></li>
								<li class="mr-2">/</li>
								<li class="active">Contact</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<div class="contactSec container pt-xl-24 pb-xl-23 py-lg-20 pt-md-16 pb-md-10 pt-10 pb-0">
				<div class="row">
					<div class="col-12">
						<ul class="list-unstyled contactListHolder mb-0 d-flex flex-wrap text-center">
							<li class="mb-lg-0 mb-6">
								<span class="icon d-block mx-auto bg-lightGray py-4 mb-4"><i class="fas fa-map-marker-alt"></i></span>
								<strong class="title text-uppercase playfair mb-5 d-block">address</strong>
								<address class="mb-0">GIFT University<span class="d-block"> Gujranwala</span></address>
							</li>
							<li class="mb-lg-0 mb-6">
								<span class="icon d-block mx-auto bg-lightGray py-4 mb-3"><i class="fas fa-headphones"></i></span>
								<strong class="title text-uppercase playfair mb-5 d-block">phone</strong>
								<a href="tel:84123456789" class="d-block">(+92) - 3144 - 783 - 478</a>
								<a href="tel:84321654987" class="d-block">(+92) - 3227 - 232 - 141</a>
							</li>
							<li class="mb-lg-0 mb-6">
								<span class="icon d-block mx-auto bg-lightGray py-5 mb-3"><i class="fas fa-envelope"></i></span>
								<strong class="title text-uppercase playfair mb-5 d-block">email</strong>
								<a href="#" class="d-block">igh.gift@gmail.com</a>
							<!--<a href="#" class="d-block">info@Two.lnk</a> -->
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- mapHolder -->
			<div class="mapHolder">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.91477127143!2d-74.11976341808828!3d40.697403441901386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2s!4v1573223498837!5m2!1sen!2s" style="border:0;" allowfullscreen="">
				</iframe>
			</div>
			<section class="contactSecBlock container pt-xl-23 pb-xl-24 pt-lg-20 pb-lg-10 pt-md-16 pb-md-8 py-10">
				<div class="row">
					<header class="col-12 mainHeader mb-10 text-center">
						<h1 class="headingIV playfair fwEblod mb-7">Get In Touch</h1>
						<p>Please contact with us for more information. For this, must enter accurate phone number and email address.</p>
					</header>
				</div>
				<div class="row">
					<div class="col-12">
						<form class="contactForm">
							<div class="d-flex flex-wrap row1 mb-md-1">
								<div class="form-group coll mb-5">
									<input type="text" id="name" class="form-control" name="name" placeholder="Your name  *">
								</div>
								<div class="form-group coll mb-5">
									<input type="email" class="form-control" id="email" name="Email" placeholder="Your email  *">
								</div>
								<div class="form-group coll mb-5">
									<input type="tel" class="form-control" id="tel" name="tel" placeholder="Telephone number  *">
								</div>
							</div>
							<div class="form-group w-100 mb-6">
								<textarea class="form-control" placeholder="Meesage  *"></textarea>
							</div>
							<div class="text-center">
								<button type="submit" class="btn btnTheme btnShop md-round fwEbold text-white py-3 px-4 py-md-3 px-md-4">Send Message</button>
							</div>
						</form>
					</div>
				</div>
			</section>
@endsection
