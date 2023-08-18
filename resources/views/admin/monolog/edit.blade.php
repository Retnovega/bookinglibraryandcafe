@extends('layouts.headadmin')

@section('content')
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Data Monolog</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('monolog.update', $monolog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control select2" id="category" name="category" value="{{ old('category', $monolog->category) }}"  style="width: 100%;">
                      @forelse ($monologkategoris as $kategori)
                        @if($kategori->id == $monolog->category)
                          <option value="{{ $kategori->id }}" selected>{{ $kategori->kategori }}</option>
                        @else
                          <option value="{{ $kategori->id }}" >{{ $kategori->kategori }}</option>
                        @endif
                      @empty
                      <div class="alert alert-danger">
                        Data Belum Tersedia
                      </div>
                      @endforelse           
                    </select>
                    @error('category')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $monolog->tanggal) }}" placeholder="Input Tanggal">
                    @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $monolog->judul) }}" placeholder="Input Judul">
                    @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{ old('penulis', $monolog->penulis) }}" placeholder="Input Penulis">
                    @error('penulis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Masukkan Konten Post">{{ old('deskripsi', $monolog->deskripsi) }}</textarea>
                    @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Upload File Monolog</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="upload" name="upload">
                        <label class="custom-file-label" for="upload">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload PDF</span>
                        @error('upload')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Upload Photo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload Photo</span>
                        @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" id="status" name="status" style="width: 100%;">
                      <option value="aktif" selected="selected">Aktif</option>
                      <option value="hidden">Hidden</option>
                      <option value="tidak">Tidak</option>
                    </select>
                    @error('status')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                    @enderror
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <button type="reset" class="btn btn-warning">Reset</button>
                </div>
              </form>
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection
