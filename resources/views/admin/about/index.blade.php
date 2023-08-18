@extends('layouts.headadmin')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <!-- <a href="{{ route('about.create') }}" class="btn btn-md btn-success mb-3">TAMBAH ABOUT</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Photo</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $no = 0;
                    @endphp
                    @forelse ($abouts as $about)
                      <tr>
                        <td class="text-center">{{ ++ $no }}</td>
                        <td class="text-center">
                          <img src="{{ url('storage/abouts/'.$about->foto) }}" class="rounded" style="width: 150px">
                        </td>
                        <td>{{ $about->nama }}</td>
                        <td>{!! $about->alamat !!}</td>
                        <td>{!! $about->nomor_hp !!}</td>
                        <td>{!! $about->deskripsi !!}</td>
                        <td>{!! $about->lokasi !!}</td>
                        <td class="text-center">
                          <a href="{{ route('about.edit', $about->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
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
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Deskripsi</th>
                    <th>Lokasi</th>
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
