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
						<p>Boo.ing Library & Cafe</p>
						<h1>Cart</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- cart -->
	<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th class="product-image">Product Image</th>
									<th class="product-name">Name</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th>
								</tr>
							</thead>
							<tbody>
                @php
				$subtotal=0;
                  $total = 0;
                @endphp
                @forelse ($transaksi as $trans)
                <tr class="table-body-row" data-toggle="modal"  data-target="#modal{{ $trans->id }}">
					<td class="product-image"><img src="{{ url('storage/menus/'.$trans->foto) }}" alt=""></td>
					<td class="product-name">{{ $trans->name }}</td>
					<td class="product-price">{{ number_format($trans->harga_akhir) }}</td>
					<td class="product-quantity">{{ $trans->jumlah }}</td>
					<td class="product-total">{{ number_format($trans->total_harga) }}</td>
				</tr>
                @php
                  $subtotal +=$trans->total_harga;
                @endphp
				<div class="modal fade" id="modal{{ $trans->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                    <form action="{{ url('editcart') }}" type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                    <div class="modal-body">
                        
                            <div class="form-group">
                                <label for="exampleFormControlInput1"></label>
                                <input type="text" class="form-control" id="idtransaksi" name="idtransaksi" value="{{ $trans->id }}" hidden>
                                <input type="text" class="form-control" id="id" name="id" value="{{ $reservasi->id }}" hidden>
                                <input type="number" class="form-control" id="qty" name="qty" value="{{ $trans->jumlah }}" style="width:100%">
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                      <center><p><input type="submit" value="UPDATE" style="width:100%"></p></center>
                    </div>
                    </form>
                </div>
            </div>
        </div>
                @empty
                <div class="alert alert-danger">
                  Data Belum Tersedia
                </div>
                @endforelse
				@php
                  $total =$subtotal+$reservasi->biayalain;
                @endphp
							</tbody>
						</table>
				<center><a href="{{ url('pilihmenu/'.$reservasi->id) }}" class="boxed-btn" style="width:100%">Pilih Menu Lainnya</a></center>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th>Total</th>
									<th>Price</th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Kode : </strong></td>
									<td>{{ $reservasi->kodereservasi }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Nama : </strong></td>
									<td>{{ $reservasi->pelanggan }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Email : </strong></td>
									<td>{{ $reservasi->email }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Tanggal : </strong></td>
									<td>{{ date('d M Y', strtotime($reservasi->tanggal)) }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Jam : </strong></td>
									<td>{{ date('h:i:s', strtotime($reservasi->jam)) }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Biaya lain: </strong></td>
									<td>{{ 'Rp. '.number_format($reservasi->biayalain) }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Subtotal: </strong></td>
									<td>{{ 'Rp. '.number_format($total) }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Jenis Pembayaran : </strong></td>
									<td>{{ $reservasi->pembayaran }}</td>
								</tr>
							</tbody>
						</table>
						<div class="cart-buttons">
							@if($reservasi->pembayaran=='-')
								<center><a href="" class="boxed-btn black" style="width:100%" data-toggle="modal" data-target="#modalpilih">Check Out</a></center>
							@elseif($reservasi->pembayaran=='DITEMPAT')
								<center><a href="" class="boxed-btn black" style="width:100%" data-toggle="modal" data-target="#modalpilih">Ubah Pembayaran</a></center>
							@else
								<center><a href="" class="boxed-btn black" style="width:100%" data-toggle="modal" data-target="#modalpilih">Ubah Pembayaran</a></center>
								<hr>
								<center><a href="{{ url('getbayar/QRIS/'.$reservasi->id) }}" class="boxed-btn black" style="width:100%">Tampilkan QRIS</a></center>
							@endif
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->
<div class="modal fade" id="modalpilih" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pilih Jenis Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <!-- di dalam modal-body terdapat 4 form input yang berisi data.
                    data-data tersebut ditampilkan sama seperti menampilkan data pada tabel. -->
                    <form>
                    <div class="modal-body">
                        <center><a href="{{ url('getbayar/DITEMPAT/'.$reservasi->id) }}" class="boxed-btn black" style="width:100%">Bayar Ditempat</a></center>
						<hr>
						<center><a href="{{ url('getbayar/QRIS/'.$reservasi->id) }}" class="boxed-btn black" style="width:100%">Bayar Dengan QRIS</a></center>
                    </div>
                    <div class="modal-footer">
                      <!-- <center><p><input type="submit" value="UPDATE" style="width:100%"></p></center> -->
                    </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
