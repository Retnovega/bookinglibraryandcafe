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
          <h1>{{ $monologname->kategori }}</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->
<!-- products -->
<div class="product-section mt-150 mb-150">
  <div class="container">
    <div class="row product-lists">
      @forelse ($monologs as $monolog)
      <div class="col-lg-4 col-md-6 text-center {{ $monolog->kategori }}">
        <div class="single-product-item">
          <div class="product-image">
            <a href="{{ url('viewmonolog/'.$monolog->upload) }}" ><img src="{{ url('storage/monologs/images/'.$monolog->foto) }}" alt=""></a>
          </div>
          <h3>{{ $monolog->judul }}</h3>
          <!-- <p class="product-price">{{ $harga = $monolog->harga-(($monolog->harga/100)*$monolog->diskon) }}</p> -->
          <a href="{{ url('viewmonolog/'.$monolog->upload) }}" class="cart-btn" ><i class="fas fa-eye"></i>Informasi Detail</a>
        </div>
      </div>
        

        @empty
          <div class="alert alert-danger">
            Data Belum Tersedia
          </div>
        @endforelse
    </div>


    <div class="row">
      <!-- <div class="col-lg-12 text-center">
        <div class="pagination-wrap">
          <ul>
            <li><a href="#">Prev</a></li>
            <li><a href="#">1</a></li>
            <li><a class="active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">Next</a></li>
          </ul>
        </div>
      </div> -->
    </div>
  </div>
</div>
<!-- end products -->

@endsection
