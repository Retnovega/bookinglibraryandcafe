@extends('layouts.headadmin')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <a href="{{ route('menukategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($menukategoris as $kategori)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td class="text-center">
                          <img src="{{ url('storage/menukategoris/'.$kategori->foto) }}" class="rounded" style="width: 150px">
                        </td>
                        <td>{{ $kategori->kategori }}</td>
                        <td>{!! $kategori->status !!}</td>
                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('menukategori.destroy', $kategori->id) }}" method="POST">
                            <a href="{{ route('menukategori.edit', $kategori->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
                    <th>Foto</th>
                    <th>Kategori</th>
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
