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
                <form action="{{ url('editreservasi') }}" type="POST" enctype="multipart/form-data">
                  <input type="text" class="form-control" id="id" name="id" value="{{ old('id', $reservasis->id) }}" placeholder="Input Biaya Lain" hidden>
                  <input type="text" class="form-control" id="aksi" name="aksi" value="{{ old('aksi', $aksi) }}" placeholder="Input Biaya Lain" hidden>
                <div class="row">
                  <div class="col-lg-3">Kode Transaksi </div><div class="col-lg-3">: {{ $reservasis->kodereservasi }}</div>
                  <div class="col-lg-3">Customer </div><div class="col-lg-3">: {{ $reservasis->pelanggan }}</div>
                  <div class="col-lg-3">Tanggal </div><div class="col-lg-3">: {{ date('d M Y', strtotime($reservasis->tanggal)) }}</div>
                  <div class="col-lg-3">Email </div><div class="col-lg-3">: {{ $reservasis->email }}</div>
                  <div class="col-lg-3">Jam </div><div class="col-lg-3">: {{ date('h:i:s', strtotime($reservasis->jam)) }}</div>
                  <div class="col-lg-3">No HP </div><div class="col-lg-3">: {{ $reservasis->no_hp }}</div>
                  <div class="col-lg-3">Pembayaran </div><div class="col-lg-3">{{ $reservasis->pembayaran }}</div><div class="col-lg-3">Pesan </div><div class="col-lg-3">{{ $reservasis->massage }}</div>
                  <div class="col-lg-3">No Meja</div><div class="col-lg-3"><select class="form-control select2" id="no_meja" name="no_meja" style="width: 100%;">
                    @forelse ($no_meja as $meja)
                    @if($meja->id==$reservasis->no_meja)
                      <option value="{{ $meja->id }}" selected>{{ $meja->nama_meja }}</option>
                    @else
                      <option value="{{ $meja->id }}" >{{ $meja->nama_meja }}</option>
                    @endif
                    @empty
                      <div class="alert alert-danger">
                        Data Belum Tersedia
                      </div>
                    @endforelse           
                    </select></div>
                  <div class="col-lg-3">Biaya Lainnya </div><div class="col-lg-3"><input type="number" class="form-control" id="biayalain" name="biayalain" value="{{ old('biayalain', $reservasis->biayalain) }}" placeholder="Input Biaya Lain"></div>               
                  <div class="col-lg-3">Referensi</div><div class="col-lg-3">: {{ $reservasis->buktibayar }}</div><div class="col-lg-3">Bank</div><div class="col-lg-3">: {{ $reservasis->bank }}</div>
                  <div class="col-lg-3">Pemilik Rek</div><div class="col-lg-3">: {{ $reservasis->pemilik }}</div><div class="col-lg-3">Jumlah Bayar</div><div class="col-lg-3">: {{ $reservasis->jumlahbayar }}</div>
                </div>
                <hr>
                @if($button!='hide')
                <button type="submit" class="btn btn-primary" style="width:100%">{{ $button }}</button>
                <hr>
                <a href="{{ url('admin/prosesreservasi/ditolak/'.$reservasis->id) }}" class="btn btn-sm btn-danger" style="width:100%">Tolak Reservasi</a>
                <hr>
                @endif
                </form>
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
