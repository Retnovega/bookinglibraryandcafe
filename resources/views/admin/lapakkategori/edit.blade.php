@extends('layouts.headadmin')

@section('content')
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Data Kategori Lapak</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('lapakkategori.update', $lapakkategori->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('nama', $lapakkategori->kategori) }}" placeholder="Input Kategori">
                    @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
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
