<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaksi;
use App\Models\Reservasi;
use App\Models\Detailtransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
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
        //  $lapaks = Lapak::latest()->get();
        $data['status'] = 'pesan';
         $data['transaksis'] = Transaksi::where('aksi','=','reserved')
                    ->join('qrmejas', 'transaksis.idmeja', '=', 'qrmejas.id')
                  ->select('transaksis.*', 'qrmejas.kode', 'qrmejas.nama_meja')
                  ->orderBy('id','asc')->get();
         return view('admin.transaksi.index', $data);
     }
     public function counttransaksi()
     {
        //  $lapaks = Lapak::latest()->get();
        $where = array(
              'aksi' => 'reserved'
            );
        $data['transaksis'] = Transaksi::where($where)
                    ->join('qrmejas', 'transaksis.idmeja', '=', 'qrmejas.id')
                  ->select('transaksis.*', 'qrmejas.kode', 'qrmejas.nama_meja')
                  ->orderBy('id','asc')->count();
        $data['reservasis'] = Reservasi:: where('status','=','reserved')
                  ->join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                  ->select('reservasis.*', 'customers.pelanggan', 'customers.no_hp', 'customers.email')
                  ->orderBy('id','asc')->count();
        echo json_encode($data);
     }
     public function listtransaksi($status)
     {
        //  $lapaks = Lapak::latest()->get();
        $data['status'] = $status;
        if($status=='pesan'){
         $where = array(
              'aksi' => 'reserved'
            );
        }elseif($status=='diproses'){
         $where = array(
              'aksi' => 'diproses'
            );
        }elseif($status=='selesai'){
            $where = array(
              'aksi' => 'selesai'
            );
        }else{
            return redirect('listtransaksi/pesan')->with(['status' => 'error']);
        }
        $data['transaksis'] = Transaksi::where($where)
                    ->join('qrmejas', 'transaksis.idmeja', '=', 'qrmejas.id')
                  ->select('transaksis.*', 'qrmejas.kode', 'qrmejas.nama_meja')
                  ->orderBy('id','asc')->get();
         return view('admin.transaksi.index', $data);
     }
     public function detailtransaksi($status,$id)
     {
        $data['status'] = $status;
        if($status=='pesan'){
          $data['button'] = 'Proses Pesanan';
          $data['aksi'] = 'diproses';
        }elseif($status=='diproses'){
          $data['button'] = 'Selesaikan Pesanan';
          $data['aksi'] = 'selesai';
        }elseif($status=='selesai'){
          $data['button'] = 'hide';
          $data['aksi'] = 'selesai';
        }else{
            return redirect('listtransaksi/pesan')->with(['status' => 'error']);
        }
         $data['transaksis'] = Transaksi::where('transaksis.id','=',$id)
                    ->join('qrmejas', 'transaksis.idmeja', '=', 'qrmejas.id')
                  ->select('transaksis.*', 'qrmejas.kode', 'qrmejas.nama_meja')
                  ->orderBy('id','asc')->first();
        $data['details'] = Detailtransaksi::where('detailtransaksis.idtransaksi','=',$id)
                    ->join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')
                  ->select('detailtransaksis.*', 'menus.name')
                  ->orderBy('id','asc')->get();
        return view('admin.transaksi.view', $data);

     }
     public function prosestransaksi($status,$id)
     {
        $data['status'] = $status;
         Transaksi::where('id',$id)->update([
               'aksi' => $status
          ]);
          Detailtransaksi::where('idtransaksi',$id)->update([
               'aksi' => $status
          ]);
        return redirect('admin/detailtransaksi/'.$status.'/'.$id)->with(['status' => 'error']);

     }
     public function create()
     {
       $lapakkategoris = Lapakkategori::latest()->get();
       return view('admin.lapak.add', compact('lapakkategoris'));
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
             'category'     => 'required|min:1',
             'name'     => 'required|min:2',
             'harga'   => 'required|min:2',
             'diskon'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //upload image
         $image = $request->file('foto');
         $image->storeAs('public/lapaks', $image->hashName());

         //create post
         Lapak::create([
             'foto'     => $image->hashName(),
             'category'     => $request->category,
             'name'   => $request->name,
             'status'   => $request->status,
             'harga'     => $request->harga,
             'diskon'     => $request->diskon,
             'deskripsi'   => $request->deskripsi,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('lapak.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Lapak $lapak)
     {
       // echo compact('post');
          $lapakkategoris = lapakkategori::latest()->get();
          $data = array(
            'lapakkategoris' => $lapakkategoris,
            'lapak' => $lapak,
          );
         return view('admin.lapak.edit', $data);
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Lapak $lapak)
     {
         //validate form
         $this->validate($request, [
             'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'category'     => 'required|min:1',
             'name'     => 'required|min:2',
             'harga'   => 'required|min:2',
             'diskon'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //check if image is uploaded
         if ($request->hasFile('foto')) {

             //upload new image
             $image = $request->file('foto');
             $image->storeAs('public/lapaks', $image->hashName());

             //delete old image
             Storage::delete('public/lapaks/'.$lapak->foto);

             //update post with new image
             $lapak->update([
              'foto'     => $image->hashName(),
              'category'     => $request->category,
              'name'   => $request->name,
              'status'   => $request->status,
              'harga'     => $request->harga,
              'diskon'     => $request->diskon,
              'deskripsi'   => $request->deskripsi,
              'status'   => $request->status
             ]);

         } else {

             //update post without image
             $lapak->update([
              'category'     => $request->category,
              'name'   => $request->name,
              'status'   => $request->status,
              'harga'     => $request->harga,
              'diskon'     => $request->diskon,
              'deskripsi'   => $request->deskripsi,
              'status'   => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('lapak.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(lapak $lapak)
     {
       //delete image
       Storage::delete('public/lapaks/'. $lapak->foto);

       //delete post
       $lapak->delete();

       //redirect to index
       return redirect()->route('lapak.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
