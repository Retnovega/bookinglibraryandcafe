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
						<h1>Rincian</h1>
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
                @php
				$subtotal=0;
                  $total = 0;
                @endphp
                @forelse ($transaksi as $trans)
                @php
                  $subtotal +=$trans->total_harga;
                @endphp
                @empty
                <div class="alert alert-danger">
                  Data Belum Tersedia
                </div>
                @endforelse
				@php
                  $total =$subtotal+$reservasi->biayalain;
                @endphp
					</div>
				</div>

				<div class="col-lg-12">
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
						Silahkan Scan QRIS Dibawah Ini
						<center><img src="{{ url('storage/qris/qris.png') }}" alt=""></center>

						<div class="modal-body">
                            <div class="contact-form">
								<form action="{{ url('uploadbayar') }}" method="POST" enctype="multipart/form-data" id="fruitkha-contact" onSubmit="return valid_datas( this );">
								@csrf
								<input type="text" class="form-control" id="id" name="id" value="{{ $reservasi->id }}" style="width:100%" hidden>
								@if($reservasi->buktibayar=='-')
								<p><input type="text" placeholder="Input RNN / Reff ID / No Referensi" name="rnn" id="rnn" style="width:100%" require></p>
								<p><input type="text" placeholder="Nama Bank" name="bank" id="bank" style="width:100%" require></p>
								<p><input type="text" placeholder="Nama Pemilik Rekening" name="nama" id="nama" style="width:100%" require></p>
								<p><input type="number" placeholder="Jumlah Dibayar" name="jumlah" id="jumlah" style="width:100%" require></p>
								<hr>
								<center><p><input type="submit" value="Upload Bukti" style="width:100%"></p></center>

								@error('upload')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
								@enderror
								@else
								<table>
									<tbody>
										<tr class="total-data">
											<td><strong>Ref/RNN : </strong></td>
											<td>{{ $reservasi->buktibayar }}</td>
										</tr>
										<tr class="total-data">
											<td><strong>Bank : </strong></td>
											<td>{{ $reservasi->bank }}</td>
										</tr>
										<tr class="total-data">
											<td><strong>Pemilik : </strong></td>
											<td>{{ $reservasi->pemilik }}</td>
										</tr>
										<tr class="total-data">
											<td><strong>Jumlah : </strong></td>
											<td>{{ $reservasi->jumlahbayar }}</td>
										</tr>
									</tbody>
								</table>
									<a href="{{ url('hapusbayar/'.$reservasi->id) }}" class="btn btn-sm btn-danger" style="width:100%"><i class="fas fa-trash"></i></a>

								@endif
                            </div>
                        </div>
					</form>
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
@endsection
