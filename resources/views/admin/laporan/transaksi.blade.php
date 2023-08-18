@extends('layouts.headadmin')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <!-- <a href="{{ route('tim.create') }}" class="btn btn-md btn-success mb-3">TAMBAH TIM</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/laporan') }}" type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="{{ $tanggal_awal }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
                </div>
                <div class="form-group">
                    <label>Jenis Laporan</label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <option value="transaksi" >Transaksi</option>     
                      <option value="menu" >Transaksi Menu</option>
                      <option value="tanggal" >Transaksi Tanggal</option>           
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <hr>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Qty</th>
                    <th>Sub Total</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    $total = 0;
                    @endphp
                    @forelse ($transaksis as $transaksi)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td>{{ $transaksi->kodetransaksi }}</td>
                        <td>{{ date('d M Y', strtotime($transaksi->created_at)) }}</td>
                        @php
                          $qty = 0;
                          $subtotal = 0;
                        @endphp
                        @forelse ($details as $detail)
                          @php
                            if($transaksi->id==$detail->idtransaksi){
                              $qty += $detail->jumlah;
                              $subtotal += $detail->total_harga;
                            }
                          @endphp
                        @empty
                          $qty = 0;
                          $subtotal = 0;
                        @endforelse
                        <td>{{ number_format($qty) }}</td>
                        <td>{{ number_format($subtotal) }}</td>
                      </tr>
                      @php
                          $total += $subtotal;
                      @endphp
                      @empty
                        <div class="alert alert-danger">
                          Data Belum Tersedia
                        </div>
                      @endforelse

                  </tbody>
                  <tfoot>
                  <tr>
                    <th colspan="4"  class="text-center">Jumlah</th>
                    <th>{{ number_format($total) }}</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
@endsection
