@extends('layouts.headfront')

@section('content')
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
                        <li class="active" data-filter="*">All</li>
                        @forelse ($menukategoris as $kategori)
                        @if($kategori->id>=1)
                          <li data-filter=".{{ $kategori->kategori_link }}">{{ $kategori->kategori }}</li>
                        @else
                        @endif
                        @empty
                          
                        @endforelse
                          
                      </ul>
                  </div>
              </div>
          </div>

    <div class="row product-lists">
      @forelse ($menus as $menu)
      <div class="col-lg-4 col-md-6 text-center {{ $menu->kategori_link }}">
        <div class="single-product-item">
          <div class="product-image">
            <a href="" data-toggle="modal"
            data-target="#modal{{ $menu->id }}"><img src="{{ url('storage/menus/'.$menu->foto) }}" alt=""></a>
          </div>
          <h3>{{ $menu->name }}</h3>
          @php 
            $harga = $menu->harga-(($menu->harga/100)*$menu->diskon);
          @endphp
          <p class="product-price">{{ number_format($harga) }}</p>
          <a href="" class="cart-btn" data-toggle="modal"
            data-target="#modal{{ $menu->id }}"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
        </div>
      </div>
        @empty
          <div class="alert alert-danger">
            Data Belum Tersedia
          </div>
        @endforelse
    </div>

    <div class="row">
      <div class="col-lg-12 text-center"><a href="{{ url('listcart/'.$reservasi->id) }}" class="cart-btn" style="width:100%"><i class="fas fa-shopping-cart"></i> Selesaikan Pemesanan</a></div>
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
@forelse($menus as $menu)
<div class="modal fade" id="modal{{ $menu->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Input Jumlah Pesanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                    data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                    <form action="{{ url('addcart') }}" type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="exampleFormControlInput1"></label>
                                <input type="text" class="form-control" id="idmenu" name="idmenu" value="{{ $menu->id }}" hidden>
                                <input type="text" class="form-control" id="id" name="id" value="{{ $reservasi->id }}" hidden>
                                <input type="number" class="form-control" id="qty" name="qty" value="1" style="width:100%">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                      <center><p><input type="submit" value="PESAN" style="width:100%"></p></center>
                    </div>
                    </form>
                </div>
            </div>
        </div>
@empty
@endforelse
@endsection
