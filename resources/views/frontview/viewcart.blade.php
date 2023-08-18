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
                  $total = 0;
                @endphp
                @forelse ($detailtransaksi as $trans)
                <tr class="table-body-row">
									<td class="product-image"><img src="{{ url('storage/menus/'.$trans->foto) }}" alt=""></td>
									<td class="product-name">{{ $trans->name }}</td>
									<td class="product-price">{{ number_format($trans->harga_akhir) }}</td>
									<td class="product-quantity">{{ $trans->jumlah }}</td>
									<td class="product-total">{{ number_format($trans->total_harga) }}</td>
								</tr>
                @php
                  $total +=$trans->total_harga
                @endphp
                @empty
                <div class="alert alert-danger">
                  Data Belum Tersedia
                </div>
                @endforelse
							</tbody>
						</table>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="total-section">
						<table class="total-table">
							<thead class="total-table-head">
								<tr class="table-total-row">
									<th colspan="2"><center>Keterangan</center></th>
								</tr>
							</thead>
							<tbody>
								<tr class="total-data">
									<td><strong>Kode Transaksi </strong></td>
									<td>{{ $transaksi->kodetransaksi }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Nomor Meja </strong></td>
									<td>{{ $transaksi->kode }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Total </strong></td>
									<td>{{ 'Rp. '.number_format($total) }}</td>
								</tr>
								<tr class="total-data">
									<td><strong>Nama </strong></td>
									<td>{{ $transaksi->customer }}</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end cart -->

	<!-- logo carousel -->
	<!-- <div class="logo-carousel-section">
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
	</div> -->
	<!-- end logo carousel -->

@endsection
