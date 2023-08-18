@extends('layouts.headadmin')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <a href="{{ route('qrmeja.create') }}" class="btn btn-md btn-success mb-3">TAMBAH MEJA</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Meja</th>
                    <th>Nama Meja</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($qrmejas as $qrmeja)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td>{{ $qrmeja->kode }}</td>4
                        <td>{{ $qrmeja->nama_meja }}</td>
                        <td>{!! $qrmeja->status !!}</td>
                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('qrmeja.destroy', $qrmeja->id) }}" method="POST">
                            <a href="{{ url('admin/qrcode/'.$qrmeja->id) }}" class="btn btn-sm btn-warning">Cetak QR</a>
                            <a href="{{ route('qrmeja.edit', $qrmeja->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
                    <th>Kode Meja</th>
                    <th>Nama Meja</th>
                    <th>Status</th>
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
