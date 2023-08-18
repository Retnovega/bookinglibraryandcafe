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
          <h1>Agenda</h1>
          <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, fuga quas itaque eveniet beatae optio.</p> -->
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end breadcrumb section -->
<div class="cart-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12">
					<div class="cart-table-wrap">
						<table class="cart-table">
							<thead class="cart-table-head">
								<tr class="table-head-row">
									<th >No</th>
									<th >Tanggal</th>
									<th >Jam</th>
									<th >Judul</th>
									<th >Narasumber</th>
									<th >Deskripsi</th>
									<!-- <th >Aksi</th> -->
								</tr>
							</thead>
							<tbody>
                @php
                  $no = 0;
                @endphp
                @forelse ($agendas as $agenda)
			          <tr class="table-body-row">
									<td >{{ ++ $no }}</td>
									<td >{{ date('d M Y', strtotime($agenda->tanggal)) }}</td>
									<td >{{ $agenda->jam }}</td>
									<td >{{ $agenda->judul }}</td>
									<td >{{ $agenda->narasumber }}</td>
									<td >{!! $agenda->deskripsi !!}</td>
									<!-- <td ><a href="{{ url('storage/agendas/'.$agenda->upload) }}" class="cart-btn"><i class="fas fa-eye"></i></a></td> -->
								</tr>
    		        @empty
    		        <tr class="table-body-row">
									<td colspan = "7">Data Tidak Tersedia</td>
								</tr>
    		        @endforelse
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
