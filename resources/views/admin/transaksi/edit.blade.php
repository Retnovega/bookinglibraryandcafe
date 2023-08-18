@extends('layouts.headadmin')

@section('content')
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Data</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{ route('tim.update', $resevasi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                  <div class="form-group">
                    <label for="kode">Kode</label>
                    <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', $resevasi->kode) }}" placeholder="Input Kode" hidden>
                    @error('kode')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $resevasi->tanggal) }}" placeholder="Input Tanggal">
                    @error('tanggal')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="jam">Jam</label>
                    <input type="time" class="form-control" id="jam" name="jam" value="{{ old('jam', $resevasi->jam) }}" placeholder="Input Jam">
                    @error('jam')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="jumlah">Jumlah</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" value="{{ old('jumlah', $resevasi->jumlah) }}" placeholder="Input Jumlah">
                    @error('jumlah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="pelanggan">Pelanggan</label>
                    <input type="text" class="form-control" id="pelanggan" name="pelanggan" value="{{ old('pelanggan', $resevasi->pelanggan) }}" placeholder="Input Pelanggan">
                    @error('pelanggan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="no_hp">No HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $resevasi->no_hp) }}" placeholder="Input No HP">
                    @error('no_hp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $resevasi->email) }}" placeholder="Input Email">
                    @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label for="no_meja">No Meja</label>
                    <input type="text" class="form-control" id="no_meja" name="no_meja" value="{{ old('no_meja', $resevasi->no_meja) }}" placeholder="Input No Meja">
                    @error('no_meja')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control select2" id="status" name="status" style="width: 100%;">
                      <option value="reservasi" selected="selected">Reservasi</option>
                      <option value="diterima">Diterima</option>
                      <option value="ditolak">Ditolak</option>
                      <option value="selesai">Selesai</option>
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
