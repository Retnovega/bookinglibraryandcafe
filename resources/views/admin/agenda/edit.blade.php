@extends('layouts.headadmin')

@section('content')
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Data Agenda</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('agenda.update', $agenda->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $agenda->tanggal) }}" placeholder="Input Tanggal">
                    @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam', $agenda->jam) }}" placeholder="Input Jam">
                    @error('jam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $agenda->judul) }}" placeholder="Input Judul">
                    @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="narasumber">Narasumber</label>
                    <input type="text" class="form-control" id="narasumber" name="narasumber" value="{{ old('narasumber', $agenda->narasumber) }}" placeholder="Input Narasumber">
                    @error('narasumber')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" placeholder="Masukkan Konten Post">{{ old('deskripsi', $agenda->deskripsi) }}</textarea>
                    @error('deskripsi')
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
