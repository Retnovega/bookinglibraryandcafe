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
          <h1>About Us</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->

<!-- featured section -->
<div class="feature-bg">
  <div class="container">
    <div class="row">
      <div class="col-lg-7">
        <div class="featured-text">
          @forelse ($abouts as $about)
          <h2><span class="orange-text">{{ $about->nama }}</span></h2>
          <div class="row">
            <div class="col-lg-12 col-md-12 mb-4 mb-md-5">
              <div class="list-box d-flex">
                <div class="list-icon">
                  <i class="fa fa-pencil"></i>
                </div>
                <div class="content">
                  <h3>Deskripsi Singkat</h3>
                  <p>{!! $about->deskripsi !!}.</p>
                </div>
              </div>
            </div>
          </div>
            @empty
              <div class="alert alert-danger">
                Data Belum Tersedia
              </div>
            @endforelse
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end featured section -->

@endsection
