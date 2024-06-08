@extends('layouts.header')

@section('title')
    IGH-Demo
@endsection

@section('main')
    <!-- introBlock -->
			<section class="introBlock position-relative">
				<div class="slick-fade">
					<div>
						<div class="align w-100 d-flex align-items-center bgCover" style="background-image: url(assets_1/images/b-bg.jpg);">
							<!-- holder -->
							<div class="container position-relative holder pt-xl-10 pt-0">
								<!-- py-12 pt-lg-30 pb-lg-25 -->
								<div class="row">
									<div class="col-12 col-xl-7">
										<div class="txtwrap pr-lg-10">
											<span class="title d-block text-uppercase fwEbold position-relative pl-2 mb-lg-5 mb-sm-3 mb-1">welcome to </span>
											<h1 class="fwEbold position-relative pb-lg-8 pb-4 mb-xl-7 mb-lg-6">Intelligent Green House</span></h1>

											<a href="shop.html" class="btn btnTheme btnShop fwEbold text-white md-round py-md-3 px-md-4 py-2 px-3">Request Now <i class="fas fa-arrow-right ml-2"></i></a>
										</div>
									</div>
									<div class="imgHolder">
										<img src="{{ asset('assets_1/images/img79.png') }}" alt="image description" class="img-fluid w-100">
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>

			</section>
			<!-- chooseUs-sec -->

			<!-- footerHolder -->
        </div>
@endsection
@section('scripts')

@endsection
