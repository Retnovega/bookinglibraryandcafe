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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jumlah</th>
                    <th>Pelanggan</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>No Meja</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody id="dataisi">
   
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Jumlah</th>
                    <th>Pelanggan</th>
                    <th>No Hp</th>
                    <th>Email</th>
                    <th>No Meja</th>
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
<script>
  setInterval(reserv, 1000);//fungsi yang dijalan setiap detik, 1000 = 1 detik

function reserv() {
  $.ajax({
    type  : 'ajax',
    url   : '{{ url('admin/datareservasi/'.$status) }}',
    async : false,
    type : 'GET',
    dataType : 'json',
    data : {"id":"1"},
    success: function(data) {
      // alert(data.transaksis);
      $('#dataisi').html(data.reservasis);
    },
  });
}
</script>
@endsection
