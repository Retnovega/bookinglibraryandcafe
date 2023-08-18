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
          <h1>Tim <span class="orange-text">Booking</span></h1>
          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- team section -->
<div class="mt-150">
  <div class="container">
    <div class="row">
      @forelse ($tims as $tim)
      @php
	      $imageurl = url('storage/tims/'.$tim->foto);
      @endphp
      <div class="col-lg-4 col-md-6">
        <div class="single-team-item">
          <div class="team-bg team-bg-1" style="background-image: url('{{ $imageurl }}')">
            <!-- <img src="{{ url('storage/tims/'.$tim->foto) }}" alt=""> -->
          </div>
          <h4>{{ $tim->nama }}<span>{{ $tim->posisi }}</span></h4>
          <!-- <ul class="social-link-team">
            <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
            <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
          </ul> -->
        </div>
      </div>
        @empty
          <div class="alert alert-danger" >
            Data Belum Tersedia
          </div>
        @endforelse

    </div>
  </div>
</div>
<!-- end team section -->
@endsection
