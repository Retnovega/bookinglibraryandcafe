@extends('layouts.headfront')

@section('content')
<a href="{{ url('reservasi') }}" class="act-btn third">
		<i class="fas fa-shopping-cart"></i>
	</a>
<!-- breadcrumb-section -->
	@php 
	$imageban = url('storage/sliders/banner.png');
	@endphp
<div class="breadcrumb-section breadcrumb-bg" style="background-image: url('{{ $imageban }}')">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 offset-lg-2 text-center">
        <div class="breadcrumb-text">
          <h1>About <span class="orange-text">Us</span></h1>
          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- featured section -->
<section class="cart-banner pt-100 pb-100">
		<div class="container">
				<div class="row clearfix">
						<!--Image Column-->
						<div class="image-column col-lg-6">
								<div class="image">
										<!-- <div class="price-box">
												<div class="inner-price">
															<span class="price">
																	<strong>30%</strong> <br> off per kg
															</span>
													</div>
											</div> -->
										<img src="{{ url('storage/abouts/'.$abouts->foto) }}" alt="">
									</div>
							</div>
							<!--Content Column-->
							<div class="content-column col-lg-6">
				<h3><span class="orange-text">Tentang</span> Kami</h3>
									<h4>{{ $abouts->nama }}</h4>
									<div class="text">{!! $abouts->deskripsi !!}</div>
									<!--Countdown Timer-->
									<!-- <div class="time-counter"><div class="time-countdown clearfix" data-countdown="2020/2/01"><div class="counter-column"><div class="inner"><span class="count">00</span>Days</div></div> <div class="counter-column"><div class="inner"><span class="count">00</span>Hours</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Mins</div></div>  <div class="counter-column"><div class="inner"><span class="count">00</span>Secs</div></div></div></div> -->
								<!-- <a href="{{ url('about') }}" class="cart-btn mt-3"><i class="fas fa-info-circle"></i> Detail</a> -->
							</div>
					</div>
			</div>
	</section>
	<iframe src="{{ $abouts->lokasi }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
<!-- end featured section -->

@endsection
