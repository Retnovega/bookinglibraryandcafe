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
          <h1>Menu Kami</h1>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->
<!-- products -->
<div class="product-section mt-150 mb-150">
  <div class="container">

    <div class="row">
              <div class="col-md-12">
                  <div class="product-filters">
                      <ul>
                        @if($menuid=="")
                        <li class="active" data-filter="*">All</li>
                        @forelse ($menukategoris as $kategori)
                          @if($kategori->id>=1)
                            <li data-filter=".{{ $kategori->kategori_link }}">{{ $kategori->kategori }}</li>
                          @else
                          @endif
                        @empty
                        @endforelse
                        @else
                        <a href="{{ url('menu') }}"> <li data-filter="*">All</li></a>
                        @forelse ($menukategoris as $kategori)
                          @if($kategori->id>=1)
                            @if($kategori->kategori_link==$menuid)
                            <a href="{{ url('menu?menuid='.$kategori->kategori_link) }}"><li class="active" >{{ $kategori->kategori }}</li></a>
                            @else
                            <a href="{{ url('menu?menuid='.$kategori->kategori_link) }}"><li >{{ $kategori->kategori }}</li></a>
                            @endif
                          @else
                          @endif
                        @empty
                        @endforelse
                        @endif      
                      </ul>
                  </div>
              </div>
          </div>

    <div class="row product-lists">
      @forelse ($menus as $menu)
      @if($menu->kategori_link==$menuid)
      <div class="col-lg-4 col-md-6 text-center {{ $menu->kategori_link }}">
        <div class="single-product-item">
          <div class="product-image">
            <a href="single-product.html"><img src="{{ url('storage/menus/'.$menu->foto) }}" alt=""></a>
          </div>
          <h3>{{ $menu->name }}</h3>
          @if($menu->diskon>0)
          @php 
            $harga = $menu->harga;
          @endphp
          <s class="product-price">{{ number_format($harga) }}</s><b style="color:red">{{ ' || '.$menu->diskon.'% Off' }}</b>
          @endif
          @php 
            $harga = $menu->harga-(($menu->harga/100)*$menu->diskon);
          @endphp
          <p class="product-price">{{ number_format($harga) }}</p>
          <!-- <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a> -->
        </div>
      </div>
      @elseif($menuid=="")
      <div class="col-lg-4 col-md-6 text-center {{ $menu->kategori_link }}">
        <div class="single-product-item">
          <div class="product-image">
            <a href="single-product.html"><img src="{{ url('storage/menus/'.$menu->foto) }}" alt=""></a>
          </div>
          <h3>{{ $menu->name }}</h3>
          @if($menu->diskon>0)
          @php 
            $harga = $menu->harga;
          @endphp
          <s class="product-price">{{ number_format($harga) }}</s><b style="color:red">{{ ' || '.$menu->diskon.'% Off' }}</b>
          @endif
          @php 
            $harga = $menu->harga-(($menu->harga/100)*$menu->diskon);
          @endphp
          <p class="product-price">{{ number_format($harga) }}</p>
          <!-- <a href="cart.html" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a> -->
        </div>
      </div>
      @endif
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

<script type="text/javascript">
</script>
@endsection
