@extends('layouts.headadmin')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <a href="{{ route('menu.create') }}" class="btn btn-md btn-success mb-3">TAMBAH MENU</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Photo</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Harga Jual</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($menus as $menu)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td class="text-center">
                          <img src="{{ url('storage/menus/'.$menu->foto) }}" class="rounded" style="width: 150px">
                        </td>
                        <td>{{ $menu->kategori }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->harga }}</td>
                        <td>{{ $menu->diskon }}</td>
                        <td>{{ $diskon = $menu->harga-(($menu->harga/100)*$menu->diskon) }}</td>
                        <td>{!! $menu->deskripsi !!}</td>
                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('menu.destroy', $menu->id) }}" method="POST">
                            <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Harga Jual</th>
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
