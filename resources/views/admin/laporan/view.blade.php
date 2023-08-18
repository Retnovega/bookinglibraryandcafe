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
                <div class="row">
                  <div class="col-lg-3">Kode Transaksi </div><div class="col-lg-9">: {{ $transaksis->kodetransaksi }}</div>
                  <div class="col-lg-3">No Meja </div><div class="col-lg-9">: {{ $transaksis->kode }}</div>
                  <div class="col-lg-3">Customer </div><div class="col-lg-9">: {{ $transaksis->customer }}</div>
                </div>
                <hr>
                @if($button!='hide')
                <a href="{{ url('admin/prosestransaksi/'.$aksi.'/'.$transaksis->id) }}" class="btn btn-sm btn-primary" style="width:100%">{{ $button }}</a>
                <hr>
                @endif
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Harga Akhir</th>
                    <th>Qty</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    $total=0;
                    @endphp
                    @forelse ($details as $detail)
                    @php
                     $total +=$detail->total_harga
                    @endphp
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td>{{ $detail->name }}</td>
                        <td>{{ number_format($detail->harga_awal) }}</td>
                        <td>{!! $detail->diskon !!}</td>
                        <td>{!! number_format($detail->harga_akhir) !!}</td>
                        <td>{!! number_format($detail->jumlah) !!}</td>
                        <td>{!! number_format($detail->total_harga) !!}</td>
                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ url('admin/deletetransaksi', $detail->id) }}" method="POST">
                            <!-- <a href="{{ route('tim.edit', $detail->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a> -->
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                          </form>
                        </td>
                      </tr>
                      @empty
                        <div class="alert alert-danger">
                          Data Belum Tersedia
                        </div>
                      @endforelse
                  </tbody>
                  <tfoot>
                  <tr>
                    <th colspan="6">Jumlah</th>
                    <th colspan="2">{{ number_format($total) }}</th>-
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
