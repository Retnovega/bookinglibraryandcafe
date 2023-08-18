@extends('layouts.headadmin')

@section('content')
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Data Lapak</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('lapak.update', $lapak->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control select2" id="category" name="category" value="{{ old('category', $lapak->category) }}"  style="width: 100%;">
                      @forelse ($lapakkategoris as $kategori)
                      <option value="{{ $kategori->id }}" >{{ $kategori->kategori }}</option>
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
                    <label for="name">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $lapak->name) }}" placeholder="Input Nama">
                    @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="{{ old('harga', $lapak->harga) }}" placeholder="Input Harga">
                    @error('harga')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="diskon">Diskon</label>
                    <input type="text" class="form-control" id="diskon" name="diskon" value="{{ old('diskon', $lapak->diskon) }}" placeholder="Input Diskon">
                    @error('diskon')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Masukkan Konten Post">{{ old('deskripsi', $lapak->deskripsi) }}</textarea>
                    @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="foto">
                        <label class="custom-file-label" for="foto">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
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
