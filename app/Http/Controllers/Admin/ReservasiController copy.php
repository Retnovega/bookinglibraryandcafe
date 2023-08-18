<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reservasi;
use App\Models\Transaksi;
use App\Models\Detailtransaksi;
use App\Models\Qrmeja;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReservasiController extends Controller
{
  /**
      * Create a new controller instance.
      *
      * @return void
      */
     public function __construct()
     {
         $this->middleware('auth');
     }

     /**
      * Show the application dashboard.
      *
      * @return \Illuminate\Contracts\Support\Renderable
      */
     public function index()
     {
        $data['status'] = 'reserved';
        //  $data['reservasis'] = Reservasi:: where('status','=','reserved')
        //           ->join('customers', 'reservasis.idcustomer', '=', 'customers.id')
        //           ->select('reservasis.*', 'customers.pelanggan', 'customers.no_hp', 'customers.email')
        //           ->orderBy('id','asc')->get();
         return view('admin.reservasi.index', $data);
     }
     public function datareservasi($status)
     {
        if($status=='pesan'){
         $where = array(
              'status' => 'reserved'
            );
        }elseif($status=='setuju'){
         $where = array(
              'status' => 'setuju'
            );
        }elseif($status=='selesai'){
            $where = array(
              'status' => 'selesai'
            );
        }elseif($status=='ditolak'){
            $where = array(
              'status' => 'ditolak'
            );
        }else{
            $where = array(
              'status' => 'reserved'
            );
        }
         $hasil = Reservasi:: where($where)
                  ->join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                  ->select('reservasis.*', 'customers.pelanggan', 'customers.no_hp', 'customers.email')
                  ->orderBy('id','asc')->get();
        //  return view('admin.reservasi.index', $data);
        $no=1;
        foreach($hasil as $reservasi){
          if ($no==1){
            $data['reservasis'] = "<tr>"
                        ."<td class='text-center'>".$no."</td>"
                        ."<td>".$reservasi->kodereservasi."</td>"
                        ."<td>".$reservasi->tanggal."</td>"
                        ."<td>".$reservasi->jam."</td>"
                        ."<td>".$reservasi->jumlah."</td>"
                        ."<td>".$reservasi->pelanggan."</td>"
                        ."<td>".$reservasi->no_hp."</td>"
                        ."<td>".$reservasi->email."</td>"
                        ."<td>".$reservasi->no_meja."</td>"
                        ."<td class='text-center'>"
                          ."<form onsubmit='return confirm('Apakah Anda Yakin ?');' action='".route('reservasi.destroy', $reservasi->id)."' method='POST'>"
                            ."<a href='".url('admin/detailreservasi/'.$status.'/'.$reservasi->id)."' class='btn btn-sm btn-warning'><i class='fas fa-eye'></i></a>"
                              ."@csrf"
                              ."@method('DELETE')"
                            ."<button type='submit' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>"
                          ."</form>"
                        ."</td>"
                      ."</tr>";
          }else{
              $data['reservasis'] .= "<tr>"
                        ."<td class='text-center'>".$no."</td>"
                        ."<td>".$reservasi->kodereservasi."</td>"
                        ."<td>".$reservasi->tanggal."</td>"
                        ."<td>".$reservasi->jam."</td>"
                        ."<td>".$reservasi->jumlah."</td>"
                        ."<td>".$reservasi->pelanggan."</td>"
                        ."<td>".$reservasi->no_hp."</td>"
                        ."<td>".$reservasi->email."</td>"
                        ."<td>".$reservasi->no_meja."</td>"
                        ."<td class='text-center'>"
                          ."<form onsubmit='return confirm('Apakah Anda Yakin ?');' action='".route('reservasi.destroy', $reservasi->id)."' method='POST'>"
                            ."<a href='".url('admin/detailreservasi/'.$status.'/'.$reservasi->id)."' class='btn btn-sm btn-warning'><i class='fas fa-eye'></i></a>"
                              ."@csrf"
                              ."@method('DELETE')"
                            ."<button type='submit' class='btn btn-sm btn-danger'><i class='fas fa-trash'></i></button>"
                          ."</form>"
                        ."</td>"
                      ."</tr>";
          }
          $no++;
        }
        
        echo json_encode($data);
     }
     public function listreservasi($status)
     {
        $data['status'] = $status;
        
         return view('admin.reservasi.index', $data);
     }
     public function detailreservasi($status,$id)
     {
        $data['status'] = $status;
        if($status=='reserved'){
          $data['button'] = 'Setujui Reservasi';
          $data['aksi'] = 'setuju';
        }elseif($status=='setuju'){
          $data['button'] = 'Selesaikan Reservasi';
          $data['aksi'] = 'selesai';
        }elseif($status=='selesai'){
          $data['button'] = 'hide';
          $data['aksi'] = '';
        }elseif($status=='ditolak'){
          $data['button'] = 'hide';
          $data['aksi'] = '';
        }else{
            return redirect('transaksi')->with(['status' => 'error']);
        }
        $data['reservasis'] = Reservasi::where('reservasis.id','=',$id)
                    // ->join('qrmejas', 'reservasis.no_meja', '=', 'qrmejas.id')
                    ->join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                  // ->select('reservasis.*', 'qrmejas.kode', 'qrmejas.nama_meja', 'customers.name')
                  ->select('reservasis.*', 'customers.pelanggan', 'customers.email', 'customers.no_hp')
                  ->orderBy('id','asc')->first();
        $data['details'] = Detailtransaksi::where('detailtransaksis.idreservasi','=',$id)
                    ->join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')
                  ->select('detailtransaksis.*', 'menus.name')
                  ->orderBy('id','asc')->get();
        $data['no_meja'] = Qrmeja::orderBy('id','asc')->get();
        return view('admin.reservasi.view', $data);

     }
     public function prosesreservasi($status,$id)
     {
        $data['status'] = $status;
        $getreservasi = Reservasi::where('reservasis.id','=',$id)
                    ->join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                  ->select('reservasis.*', 'customers.pelanggan')
                  ->orderBy('id','asc')->first();
         Reservasi::where('id',$id)->update([
               'status' => $status
          ]);
        if($status=='selesai'){
          $idtransaksi = Transaksi::create([
             'idreservasi'     => $getreservasi->id,
             'idmeja'   => '1',
             'kodetransaksi'   => date('Ymdhis'),
             'customer'   => $getreservasi->pelanggan,
             'status'   => 'aktif',
             'aksi'   => 'reserved'
         ])->id;
         Detailtransaksi::where('idreservasi',$id)->update([
               'idtransaksi' => $idtransaksi
          ]);
        }
        return redirect('admin/detailreservasi/'.$status.'/'.$id)->with(['status' => 'Berhasil']);

     }
     public function editreservasi(Request $request)
     {
        $data['status'] = $request->aksi;
          $this->validate($request, [
             'aksi'   => 'required|min:2',
         ]);
        $getreservasi = Reservasi::where('reservasis.id','=',$request->id)
                    ->join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                  ->select('reservasis.*', 'customers.pelanggan')
                  ->orderBy('id','asc')->first();
         Reservasi::where('id',$request->id)->update([
               'status' => $request->aksi,
               'no_meja' => $request->no_meja,
               'biayalain' => $request->biayalain
          ]);
        if($request->aksi=='selesai'){
          $idtransaksi = Transaksi::create([
             'idreservasi'     => $getreservasi->id,
             'idmeja'   => $request->no_meja,
             'kodetransaksi'   => date('Ymdhis'),
             'customer'   => $getreservasi->pelanggan,
             'status'   => 'aktif',
             'aksi'   => 'reserved'
         ])->id;
         Detailtransaksi::where('idreservasi',$request->id)->update([
               'idtransaksi' => $idtransaksi
          ]);
        }
        return redirect('admin/detailreservasi/'.$request->aksi.'/'.$request->id)->with(['status' => 'Berhasil']);

     }
     public function create()
     {
       return view('admin.reservasi.add');
     }
     /**
      * store
      *
      * @param Request $request
      * @return void
      */
     public function store(Request $request)
     {
         //validate form
         $this->validate($request, [
             'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'nama'     => 'required|min:5',
             'posisi'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //upload image
         $image = $request->file('foto');
         $image->storeAs('public/reservasis', $image->hashName());

         //create post
         Reservasi::create([
             'foto'     => $image->hashName(),
             'nama'     => $request->nama,
             'posisi'   => $request->posisi,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('admin/reservasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
     }
     public function show()
     {

     }
     /**
     * edit
     *
     * @param  mixed $post
     * @return void
     */
    public function viewreservasi($id)
     {
       // echo compact('post');
         return view('admin.reservasi.edit', compact('reservasi'));
     }
     public function edit(Reservasi $reservasi)
     {
       // echo compact('post');
         return view('admin.reservasi.edit', compact('reservasi'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Reservasi $reservasi)
     {
        echo $request->aksi;
         //validate form
        //  $this->validate($request, [
        //      'aksi'   => 'required|min:2',
        //  ]);
        //  $reservasi->update([
        //        'foto'     => $image->hashName(),
        //        'nama'     => $request->nama,
        //        'posisi'   => $request->posisi,
        //        'status'   => $request->status
        //      ]);
        // $getreservasi = Reservasi::where('reservasis.id','=',$id)
        //             ->join('customers', 'reservasis.idcustomer', '=', 'customers.id')
        //           ->select('reservasis.*', 'customers.pelanggan')
        //           ->orderBy('id','asc')->first();
        //  Reservasi::where('id',$id)->update([
        //        'status' => $status
        //   ]);
        // if($status=='selesai'){
        //   $idtransaksi = Transaksi::create([
        //      'idreservasi'     => $getreservasi->id,
        //      'idmeja'   => '1',
        //      'kodetransaksi'   => date('Ymdhis'),
        //      'customer'   => $getreservasi->pelanggan,
        //      'status'   => 'aktif',
        //      'aksi'   => 'reserved'
        //  ])->id;
        //  Detailtransaksi::where('idreservasi',$id)->update([
        //        'idtransaksi' => $idtransaksi
        //   ]);
        // }
        return redirect('admin/detailreservasi/'.$status.'/'.$id)->with(['status' => 'Berhasil']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Reservasi $reservasi)
     {
       //delete image
       Storage::delete('public/reservasis/'. $reservasi->foto);

       //delete post
       $reservasi->delete();

       //redirect to index
       return redirect()->route('reservasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
