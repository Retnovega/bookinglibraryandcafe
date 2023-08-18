@extends('layouts.headadmin')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <a href="{{ route('monolog.create') }}" class="btn btn-md btn-success mb-3">TAMBAH MONOLOG</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Photo</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>judul</th>
                    <th>Penulis</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($monologs as $monolog)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td class="text-center">
                          <img src="{{ url('storage/monologs/images/'.$monolog->foto) }}" class="rounded" style="width: 150px">
                        </td>
                        <td>{{ $monolog->kategori }}</td>
                        <td>{{ $monolog->tanggal }}</td>
                        <td>{{ $monolog->judul }}</td>
                        <td>{{ $monolog->penulis }}</td>
                        <td>{!! $monolog->deskripsi !!}</td>
                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('monolog.destroy', $monolog->id) }}" method="POST">
                            <a href="{{ route('monolog.edit', $monolog->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
                    <th>Photo</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>judul</th>
                    <th>Penulis</th>
                    <th>Deskripsi</th>
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
