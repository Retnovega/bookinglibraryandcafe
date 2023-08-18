@extends('layouts.headfront')

@section('content')
<a href="{{ url('reservasi') }}" class="act-btn third">
		<i class="fas fa-shopping-cart"></i>
	</a>
<!-- home page slider -->
<div class="homepage-slider">
	<!-- single home slider -->
	<!-- single home slider -->
	@php 
	$imageban = url('storage/sliders/banner.png');
	@endphp
	<div class="single-homepage-slider homepage-bg-2" style="background-image: url('{{ $imageban }}')">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">BOOKING</p>
							<h1>SELAMAT DATANG DI WEBSITE BOOK.ING</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	@forelse ($sliders as $slider)
	@php
	$imageurl = url('storage/sliders/'.$slider->foto);
	$deskripsi_1 = str_replace("<p>","", $slider->deskripsi);
	$deskripsi = str_replace("</p>","", $deskripsi_1);
    @endphp
	<div class="single-homepage-slider homepage-bg-2" style="background-image: url('{{ $imageurl }}')">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">{!!$slider->judul !!}</p>
							<h1>{!! $deskripsi !!}</h1>
							<!-- <div class="hero-btns">
								<a href="shop.html" class="boxed-btn">Visit Shop</a>
								<a href="contact.html" class="bordered-btn">Contact Us</a>
							</div> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    @empty
    <div class="single-homepage-slider homepage-bg-2" style="background-image: url('{{ $imageban }}')">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="hero-text">
						<div class="hero-text-tablecell">
							<p class="subtitle">Book.ing Library and Cafe</p>
							<h1>SELAMAT DATANG DI WEBSITE BOOK.ING</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    @endforelse
</div>
<!-- end home page slider -->

<!-- features list section -->
<div class="list-section pt-80 pb-80">
	<div class="container">

		<div class="row">
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<i class="fas fa-shipping-fast"></i>
					</div>
					<div class="content">
						<h3>Bisnis Kami</h3>
						<p>Cafe and Library</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
				<div class="list-box d-flex align-items-center">
					<div class="list-icon">
						<a href="#" onclick="window.open('https://api.whatsapp.com/send?phone=+62{{ $abouts->nomor_hp }}&text=Hallo','_blank','width=1000, height=500')"><i class="fas fa-phone-volume"></i></a>
					</div>
					<div class="content">
						<h3>Nomor Telp</h3>
						<p>+62{{ $abouts->nomor_hp }}</p>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="list-box d-flex justify-content-start align-items-center">
					<div class="list-icon">
					<a href="#" onclick="window.open('{{ $abouts->lokasi }}')"><i class="fas fa-map-marker"></i></a>

					</div>
					<div class="content">
						<h3>Alamat</h3>
						<p>{{ $abouts->alamat }}</p>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<!-- end features list section -->

<!-- product section -->
<div class="product-section mt-150 mb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Produk</span> Kami</h3>
					<p>Kami Menyediakan Berbagai Macam Makanan, Minuman dan Buku</p>
				</div>
			</div>
		</div>

		<div class="row">
			@forelse ($menukategoris as $menukategori)
			@if($menukategori->id=='0')
				<div class="col-lg-4 col-md-6 text-center">
				<div class="single-product-item">
					<div class="product-image">
						<a href="{{ url('monolog/1') }}"><img src="{{ url('storage/menukategoris/'.$menukategori->foto) }}" alt="" height="200px"></a>
					</div>
					<h3>{{$menukategori->kategori}}</h3>
					<!-- <p class="product-price"><span>Per Kg</span> 85$ </p> -->
					<a href="{{ url('monolog/1') }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Detail Data</a>
				</div>
			</div>
			@else
				<div class="col-lg-4 col-md-6 text-center">
				<div class="single-product-item">
					<div class="product-image">
						<a href="{{ url('menu?menuid='.$menukategori->kategori_link) }}"><img src="{{ url('storage/menukategoris/'.$menukategori->foto) }}" alt="" height="200px"></a>
					</div>
					<h3>{{$menukategori->kategori}}</h3>
					<!-- <p class="product-price"><span>Per Kg</span> 85$ </p> -->
					<a href="{{ url('menu?menuid='.$menukategori->kategori_link) }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Detail Data</a>
				</div>
			</div>
			@endif
			
    		@empty
    		<div class="col-lg-12 col-md-6 text-center">
				<div class="single-product-item">
					<div class="product-image">
						<a href="{{ url('menu') }}"><img src="{{ url('theme/assets/img/products/product-img-1.jpg') }}" alt=""></a>
					</div>
					<h3>Data Belum Tersedia</h3>
					<!-- <p class="product-price"><span>Per Kg</span> 85$ </p> -->
					<a href="{{ url('menu') }}" class="cart-btn"><i class="fas fa-shopping-cart"></i> Silahkan Klik Untuk Detail</a>
				</div>
			</div>
    		@endforelse
			
		</div>
	</div>
</div>
<!-- end product section -->

<!-- cart banner section -->
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
								<a href="{{ url('about') }}" class="cart-btn mt-3"><i class="fas fa-info-circle"></i> Detail</a>
							</div>
					</div>
			</div>
	</section>
	<!-- end cart banner section -->
<!-- latest news -->
<div class="latest-news pt-150 pb-150">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Our</span> Location</h3>
				</div>
			</div>
		</div>
		<iframe src="{{ $abouts->lokasi }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

<!-- 
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="section-title">
					<h3><span class="orange-text">Our</span> News</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="single-latest-news">
					<a href="single-news.html"><div class="latest-news-bg news-bg-1"></div></a>
					<div class="news-text-box">
						<h3><a href="single-news.html">You will vainly look for fruit on it in autumn.</a></h3>
						<p class="blog-meta">
							<span class="author"><i class="fas fa-user"></i> Admin</span>
							<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
						</p>
						<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
						<a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="single-latest-news">
					<a href="single-news.html"><div class="latest-news-bg news-bg-2"></div></a>
					<div class="news-text-box">
						<h3><a href="single-news.html">A man's worth has its season, like tomato.</a></h3>
						<p class="blog-meta">
							<span class="author"><i class="fas fa-user"></i> Admin</span>
							<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
						</p>
						<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
						<a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
				<div class="single-latest-news">
					<a href="single-news.html"><div class="latest-news-bg news-bg-3"></div></a>
					<div class="news-text-box">
						<h3><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></h3>
						<p class="blog-meta">
							<span class="author"><i class="fas fa-user"></i> Admin</span>
							<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
						</p>
						<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus nisi. Praesent vitae mattis nunc, egestas viverra eros.</p>
						<a href="single-news.html" class="read-more-btn">read more <i class="fas fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 text-center">
				<a href="news.html" class="boxed-btn">More News</a>
			</div>
		</div> -->
	</div>
</div>
<!-- end latest news -->

@endsection
