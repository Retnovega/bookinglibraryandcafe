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
                    <th>Jumlah</th>
                    <th>Pelanggan</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>No Meja</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($reservasis as $reservasi)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td>{{ $reservasi->kodereservasi }}</td>
                        <td>{{ $reservasi->tanggal }}</td>
                        <td>{!! $reservasi->jam !!}</td>
                        <td>{!! $reservasi->jumlah !!}</td>
                        <td>{!! $reservasi->pelanggan !!}</td>
                        <td>{!! $reservasi->no_hp !!}</td>
                        <td>{!! $reservasi->email !!}</td>
                        <td>{!! $reservasi->no_meja !!}</td>
                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('reservasi.destroy', $reservasi->id) }}" method="POST">
                            <a href="{{ url('admin/detailreservasi/'.$status.'/'.$reservasi->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-eye"></i></a>
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
                    <th>Jumlah</th>
                    <th>Pelanggan</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>No Meja</th>
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
