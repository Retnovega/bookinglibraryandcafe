@extends('layouts.headadmin')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
              <div class="card">
              <div class="card-header">
                <!-- <a href="{{ route('tim.create') }}" class="btn btn-md btn-success mb-3">TAMBAH TIM</a> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ url('admin/laporan') }}" type="POST" id="fruitkha-contact" onSubmit="return valid_datas( this );">
                <div class="form-group">
                    <label>Tanggal Awal</label>
                    <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal" value="{{ $tanggal_awal }}">
                </div>
                <div class="form-group">
                    <label>Tanggal Akhir</label>
                    <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" value="{{ $tanggal_akhir }}">
                </div>
                <div class="form-group">
                    <label>Jenis Laporan</label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <option value="transaksi" >Transaksi</option>     
                      <option value="menu" >Transaksi Menu</option>
                      <option value="tanggal" >Transaksi Tanggal</option>           
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                <hr>
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
