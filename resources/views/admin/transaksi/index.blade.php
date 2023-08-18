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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>No Meja</th>
                    <th>Customer</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($transaksis as $transaksi)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td>{{ $transaksi->kodetransaksi }}</td>
                        <td>{{ date('d M Y', strtotime($transaksi->created_at)) }}</td>
                        <td>{{ date('h:i:s', strtotime($transaksi->created_at)) }}</td>
                        <td>{!! $transaksi->kode !!}</td>
                        <td>{!! $transaksi->customer !!}</td>
                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST">
                            <a href="{{ url('admin/detailtransaksi/'.$status.'/'.$transaksi->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
                            <!-- <a href="{{ route('tim.edit', $transaksi->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a> -->
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
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>No Meja</th>
                    <th>Customer</th>
                    <th>Aksi</th>
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
