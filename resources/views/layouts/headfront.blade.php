<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Selamat Datang Di Website Book.ing">

	<!-- title -->
	<title>Booking</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{{ url('storage/logos/logo.png') }}">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ url('theme/assets/css/all.min.css') }}">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ url('theme/assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ url('theme/assets/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ url('theme/assets/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ url('theme/assets/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ url('theme/assets/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ url('theme/assets/css/main.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ url('theme/assets/css/responsive.css') }}">
	<style type="text/css">
		.act-btn{
      		box-sizing: border-box;
			-webkit-appearance: none;
			-moz-appearance: none;
          	appearance: none;
  			background-color: transparent;
  			border: 1px solid #e74c3c;
  			border-radius: 0.6em;
  			color: #e74c3c;
  			cursor: pointer;
  			display: flex;
  			align-self: center;
  			line-height: 1;
  			margin: 5px;
  			padding: 0.2em 0.4em;
  			text-decoration: none;
  			text-align: center;
  			text-transform: uppercase;
  			font-family: 'Montserrat', sans-serif;
  			font-weight: 700;
      		position: fixed;
			z-index: 999;
      		right: 70px;
      		bottom:70px;
			font-size:45px;
			animation: jiggle 2s infinite ease-in;
    	}

		.act-btn:hover, .btn:focus {
			color: #fff;
			outline: 0;
		}
		.third {
  			border-color: #07212e;
  			color: #fff;
  			box-shadow: 0 0 40px 40px #07212e inset, 0 0 0 0 #07212e;
  			transition: all 150ms ease-in-out;
		}
		.third:hover {
			color: black;
  			box-shadow: 0 0 10px 0 #07212e inset, 0 0 10px 4px #07212e;
		}
		@keyframes jiggle {
			45%, 65% {
				transform: scale(1.0, 1.0)
			}
			50% {
				transform: scale(1.1, 0.9)
			}
			55% {
				transform: scale(0.9, 1.1) translate(0, -5px)
			 }
			 60% {
				transform: scale(1.0, 1.0) translate(0, -5px)
			}
		}
    </style>
	

</head>
<body>

	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="{{ url('') }}">
								<img src="{{ url('storage/logos/logo-text.png') }}" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="{{ url('') }}">Home</a>
								</li>
								<li><a href="" data-toggle="collapse">About</a>
									<ul class="sub-menu">
										<li><a href="{{ url('about') }}">About Book.ing</a></li>
										<li><a href="{{ url('team') }}">Team</a></li>
									</ul>
								</li>
								<li><a href="" data-toggle="collapse">Katalog</a>
									<ul class="sub-menu">
										<li><a href="{{ url('menu') }}">Menu</a></li>
										<li><a href="{{ url('promo') }}">Promo</a></li>
										<li><a href="{{ url('reservasi') }}">Reservasi</a></li>
										<li><a href="{{ url('cekreservasi') }}">Cek Reservasi</a></li>
										<li><a href="{{ url('cektransaksi') }}">Cek Transaksi</a></li>
									</ul>
								</li>
								<li><a href="" data-toggle="collapse">Monolog</a>
									<ul class="sub-menu">
										@forelse ($monologkategori as $kategori)
										<li><a href="{{ url('monolog/'.$kategori->id) }}">{{ $kategori->kategori }}</a></li>
										@empty
										<div class="alert alert-danger">
											Data Belum Tersedia
										</div>
										@endforelse
									</ul>
								</li>
								<li><a href="" data-toggle="collapse">Dialog</a>
									<ul class="sub-menu">
										<li><a href="{{ url('kajian') }}">Kajian</a></li>
										<li><a href="{{ url('agenda') }}">Agenda</a></li>
									</ul>
								</li>
								<li>
									<!-- <div class="header-icons">
										<a class="shopping-cart" href="cart.html"><i class="fas fa-shopping-cart"></i></a>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div> -->
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Search For:</h3>
							<input type="text" placeholder="Keywords">
							<button type="submit">Search <i class="fas fa-search"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end search area -->
@yield('content')
	<!-- logo carousel -->
	<!-- <div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="{{ url('theme/assets/img/company-logos/1.png') }}" alt="">
						</div>
						<div class="single-logo-item">
							<img src="{{ url('theme/assets/img/company-logos/2.png') }}" alt="">
						</div>
						<div class="single-logo-item">
							<img src="{{ url('theme/assets/img/company-logos/3.png') }}" alt="">
						</div>
						<div class="single-logo-item">
							<img src="{{ url('theme/assets/img/company-logos/4.png') }}" alt="">
						</div>
						<div class="single-logo-item">
							<img src="{{ url('theme/assets/img/company-logos/5.png') }}" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end logo carousel -->

	<!-- footer -->
	<!-- <div class="footer-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="footer-box about-widget">
						<h2 class="widget-title">About us</h2>
						<p>Ut enim ad minim veniam perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box get-in-touch">
						<h2 class="widget-title">Get in Touch</h2>
						<ul>
							<li>34/8, East Hukupara, Gifirtok, Sadan.</li>
							<li>support@fruitkha.com</li>
							<li>+00 111 222 3333</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box pages">
						<h2 class="widget-title">Pages</h2>
						<ul>
							<li><a href="index.html">Home</a></li>
							<li><a href="about.html">About</a></li>
							<li><a href="services.html">Shop</a></li>
							<li><a href="news.html">News</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="footer-box subscribe">
						<h2 class="widget-title">Subscribe</h2>
						<p>Subscribe to our mailing list to get the latest updates.</p>
						<form action="index.html">
							<input type="email" placeholder="Email">
							<button type="submit"><i class="fas fa-paper-plane"></i></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end footer -->

	<!-- copyright -->
	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12">
					<p>Copyrights  @php echo date('Y');
                    @endphp - <a href="#">Book.ing Library & Cafe</p>
				</div>
				<div class="col-lg-6 text-right col-md-12">
					<!-- <div class="social-icons">
						<ul>
							<li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-linkedin"></i></a></li>
							<li><a href="#" target="_blank"><i class="fab fa-dribbble"></i></a></li>
						</ul>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	<!-- end copyright -->

	<!-- jquery -->
	<script src="{{ url('theme/assets/js/jquery-1.11.3.min.js') }}"></script>
	<!-- bootstrap -->
	<script src="{{ url('theme/assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- count down -->
	<script src="{{ url('theme/assets/js/jquery.countdown.js') }}"></script>
	<!-- isotope -->
	<script src="{{ url('theme/assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
	<!-- waypoints -->
	<script src="{{ url('theme/assets/js/waypoints.js') }}"></script>
	<!-- owl carousel -->
	<script src="{{ url('theme/assets/js/owl.carousel.min.js') }}"></script>
	<!-- magnific popup -->
	<script src="{{ url('theme/assets/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- mean menu -->
	<script src="{{ url('theme/assets/js/jquery.meanmenu.min.js') }}"></script>
	<!-- sticker js -->
	<script src="{{ url('theme/assets/js/sticker.js') }}"></script>
	<!-- main js -->
	<script src="{{ url('theme/assets/js/main.js') }}"></script>

</body>
</html>
