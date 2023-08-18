<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\About;
use App\Models\Agenda;
use App\Models\Artikel;
use App\Models\Kajian;
use App\Models\Lapak;
use App\Models\Lapakkategori;
use App\Models\Menu;
use App\Models\Menukategori;
use App\Models\Monologkategori;
use App\Models\Monolog;
use App\Models\Customer;
use App\Models\Reservasi;
use App\Models\Qrmeja;
use App\Models\Transaksi;
use App\Models\Detailtransaksi;
use App\Models\Tim;
use App\Models\Keperluan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['sliders'] = Slider::latest()->paginate(10);
        // $data['abouts'] = About::latest()->paginate(10);
        $data['abouts'] = About::where('id','1')->first();
        $data['tims'] = Tim::latest()->paginate(10);
        $data['menus'] = Menu::latest()->paginate(10);
        $data['menukategoris'] = Menukategori::latest()->paginate(10);
        // $data['promos'] = Promo::latest()->paginate(10);
        $data['reservasis'] = Reservasi::latest()->paginate(10);
        $data['artikels'] = Artikel::latest()->paginate(10);
        $data['kajians'] = Kajian::latest()->paginate(10);
        $data['agendas'] = Agenda::latest()->paginate(10);
        $data['lapaks'] = Lapak::latest()->paginate(10);
        return view('frontview.front', $data);
    }
    public function about()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['abouts'] = About::where('id','1')->first();
        // $data['abouts'] = About::latest()->paginate(10);
        return view('frontview.about', $data);
    }
    public function team()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['tims'] = Tim::latest()->paginate(10);
        return view('frontview.team', $data);
    }
    public function menu(Request $request)
    {
        $data['menuid'] = $request->menuid;
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['menus'] = Menu::latest()
                  ->join('menukategoris', 'menus.category', '=', 'menukategoris.id')
                  ->select('menus.*', 'menukategoris.kategori_link')
                  ->get();
        $data['menukategoris'] = Menukategori::latest()->paginate(10);
        return view('frontview.menu', $data);
    }
    public function promo()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['menus'] = Menu::latest()
                  ->join('menukategoris', 'menus.category', '=', 'menukategoris.id')
                  ->select('menus.*', 'menukategoris.kategori_link')
                  ->where('diskon','>','0')
                  ->get();
        $data['menukategoris'] = Menukategori::latest()->paginate(10);
        return view('frontview.promo', $data);
    }
    public function reservasi()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['reservasis'] = Reservasi::orderBy('id','asc')->get();
        $data['keperluans'] = Keperluan::orderBy('id','asc')->get();
        $data['abouts'] = About::latest()->paginate(10);
        return view('frontview.reservasi', $data);
    }

    public function pesan(Request $request)
    {
        //validate form
        $this->validate($request, [
            'name'     => 'required|min:3',
            'email'   => 'required|min:2',
            'date'   => 'required|min:2',
            'phone'   => 'required|min:2',
            'keperluan'   => 'required',
            'jumlah'   => 'required',
            'time'   => 'required|min:2'
        ]);
        $wherecek = array(
            'email' => $request->email,
            'tanggal' => $request->date
        );
        // //create post
        if (Reservasi::join('customers', 'reservasis.idcustomer', '=', 'customers.id')->where($wherecek)->exists()) {
            //redirect to index
            $getdata =  Reservasi::join('customers', 'reservasis.idcustomer', '=', 'customers.id')->where($wherecek)->first('reservasis.id')->id;
            return redirect('pilihmenu/'.$getdata)->with(['status' => 'error']);
        }else{

            $wherecustomer = array(
                'email' => $request->email
            );
            $wherekeperluan = array(
                'id' => $request->keperluan
            );
            $keperluanget = Keperluan::where($wherekeperluan)->first();
            $id=0;
            if(Customer::where($wherecustomer)->exists()){
                $getid = Customer::where($wherecustomer)->first();
                $id = $getid->id;
            }else{
                $id = Customer::create([
                'pelanggan'     => $request->name,
                'no_hp'     => $request->phone,
                'email'   => $request->email,
                ])->id;
            }
            if($id>0)
            {
                $idtransaksi = reservasi::create([
                'idcustomer'     => $id,
                'kodereservasi'     => 'R'.date('Ymdhis'),
                'tanggal'   => $request->date,
                'jam'   => $request->time,
                'jumlah'   => $request->jumlah,
                'no_meja'   => '0',
                'status'   => 'reserved',
                'massage'   => $request->message,
                'pembayaran'   => '-',
                'buktibayar'   => '-',
                'bank'   => '-',
                'pemilik'   => '-',
                'jumlahbayar'   => '0',
                'biayalain'   => $keperluanget->biaya,
                'keperluanid'   => $keperluanget->id,
                ])->id;
                            //redirect to index
                return redirect('pilihmenu/'.$idtransaksi)->with(['status' => 'error', 'success' => 'Data Berhasil Disimpan!']);
            }
        }
    }
    public function getbayar($status,$id)
    {
        Reservasi::where('id',$id)->update([
               'pembayaran' => $status
             ]);
        if($status=='DITEMPAT'){
            return redirect('listcart/'.$id)->with(['status' => 'error', 'success' => 'Data Berhasil Disimpan!']);
        }else{
            return redirect('getqris/'.$id)->with(['status' => 'error', 'success' => 'Data Berhasil Disimpan!']);

        }
    }
    public function getqris($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $wherecek = array(
            'idreservasi' => $id
        );
        $data['transaksi'] =  Detailtransaksi::join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')
                                ->select('detailtransaksis.*', 'menus.name', 'menus.foto')->where($wherecek)->get();
        $data['reservasi'] = Reservasi::join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                            ->select('reservasis.*', 'customers.pelanggan', 'customers.no_hp', 'customers.email')->where('reservasis.id',$id)->first();
        return view('frontview.getqris', $data);
    }
    public function uploadbayar(Request $request)
    {
        $this->validate($request, [
             'rnn'     => 'required|min:2',
            'bank'   => 'required|min:2',
            'nama'   => 'required|min:2',
            'jumlah'   => 'required|min:2',
         ]);
        // $upload = $request->file('upload');
        // $upload->storeAs('public/buktis', $upload->hashName());
        Reservasi::where('id',$request->id)->update([
                'buktibayar'   => $request->rnn,
                'bank'   => $request->bank,
                'pemilik'   => $request->nama,
                'jumlahbayar' => $request->jumlah
             ]);
        return redirect('getqris/'.$request->id)->with(['status' => 'error']);
    }
    public function hapusbayar($id)
    {
        // $reservasi = Reservasi::where('id',$id)->first();
        // Storage::delete('public/buktis/'. $reservasi->buktibayar);
        Reservasi::where('id',$id)->update([
               'buktibayar'   => '-',
                'bank'   => '-',
                'pemilik'   => '-',
                'jumlahbayar' => '-'
             ]);
        return redirect('getqris/'.$id)->with(['status' => 'error']);
    }
    public function pilihmenu($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['menus'] = Menu::latest()
                  ->join('menukategoris', 'menus.category', '=', 'menukategoris.id')
                  ->select('menus.*', 'menukategoris.kategori_link')
                  ->get();
        $data['menukategoris'] = Menukategori::latest()->paginate(10);
        $data['reservasi'] = Reservasi::where('id',$id)->first();
        return view('frontview.reservasimenu', $data);
    }
    // public function addcart($id,$idmenu)
    public function addcart(Request $request)
    {
        $id = $request->id;
        $idmenu = $request->idmenu;
        $qty = $request->qty;
        $wherecek = array(
            'idreservasi' => $id,
            'idmenu' => $idmenu
        );
        // //create post
        if (Detailtransaksi::where($wherecek)->exists()) {
            //redirect to index
            $getdata =  Detailtransaksi::where($wherecek)->first();
            // $qty = $getdata->jumlah+1;
            $totalharga = $getdata->harga_akhir*$qty;
            Detailtransaksi::where('id',$getdata->id)->update([
               'jumlah' => $qty,
               'total_harga' => $totalharga
             ]);
            return redirect('pilihmenu/'.$id)->with(['status' => 'error']);
        }else{
            $getmenu = Menu::where('id',$idmenu)->first();
            $hargaakhir = $getmenu->harga-(($getmenu->harga/100)*$getmenu->diskon);
            $idtransaksi = Detailtransaksi::create([
                'idreservasi' => $id,
                'idtransaksi' => '0',
                'idmeja' => '0',
                'idmenu' => $getmenu->id,
                'harga_awal'  => $getmenu->harga,
                'diskon'  => $getmenu->diskon,
                'harga_akhir'  => $hargaakhir,
                'jumlah'  => $qty,
                'total_harga'  => $hargaakhir*$qty,
                'status' => 'aktif',
                'aksi' => 'reserved',
                ]);
                //redirect to index
                return redirect('pilihmenu/'.$id)->with(['status' => 'error', 'success' => 'Data Berhasil Disimpan!']);
        }
    }
    public function editcart(Request $request)
    {
        $id = $request->id;
        $idtransaksi = $request->idtransaksi;
        $qty = $request->qty;
        $wherecek = array(
            'id' => $idtransaksi
        );
        // //create post
        if($qty>0){
            $getdata =  Detailtransaksi::where($wherecek)->first();
            // $qty = $getdata->jumlah+1;
            $totalharga = $getdata->harga_akhir*$qty;
            Detailtransaksi::where('id',$getdata->id)->update([
               'jumlah' => $qty,
               'total_harga' => $totalharga
             ]);
        }else{
            Detailtransaksi::where('id',$idtransaksi)->delete();
        }
        
        return redirect('listcart/'.$id)->with(['status' => 'error']);
    }
    public function listcart($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $wherecek = array(
            'idreservasi' => $id
        );
        $data['transaksi'] =  Detailtransaksi::join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')
                                ->select('detailtransaksis.*', 'menus.name', 'menus.foto')->where($wherecek)->get();
        $data['reservasi'] = Reservasi::join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                            ->select('reservasis.*', 'customers.pelanggan', 'customers.no_hp', 'customers.email')->where('reservasis.id',$id)->first();
        return view('frontview.reservasilistcart', $data);
    }
    public function menupesan($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();  
        $where = array(
            'kodeqr' => $id,
        );    
        if(Qrmeja::where($where)->exists()){
            $data['eror']='0';
            $data['meja'] = Qrmeja::where($where)->first();
            $data['menus'] = Menu::latest()
                  ->join('menukategoris', 'menus.category', '=', 'menukategoris.id')
                  ->select('menus.*', 'menukategoris.kategori_link')
                  ->get();
            $data['menukategoris'] = Menukategori::latest()->paginate(10);
            return view('frontview.pesanmenu', $data);
        }else{
            $data['eror']='1';
            return view('frontview.pesanmenu', $data);
        }
        
    }
    // public function addpesan($id,$idmenu)
    public function addpesan(Request $request)
    {
        $id = $request->id;
        $idmenu = $request->idmenu;
        $qty = $request->qty;
        $meja = Qrmeja::where('kodeqr','=',$id)->first();
        $wherecek = array(
            'idmeja' => $meja->id,
            'aksi' => 'reserved',
            'idmenu' => $idmenu
        );
        
        // //create post
        if (Detailtransaksi::where($wherecek)->exists()) {
            //redirect to index
            $getdata =  Detailtransaksi::where($wherecek)->first();
            // $qty = $getdata->jumlah+1;
            $totalharga = $getdata->harga_akhir*$qty;
            Detailtransaksi::where('id',$getdata->id)->update([
               'jumlah' => $qty,
               'total_harga' => $totalharga
             ]);
            return redirect('menupesan/'.$id)->with(['status' => 'error']);
        }else{
            $getmenu = Menu::where('id',$idmenu)->first();
            $hargaakhir = $getmenu->harga-(($getmenu->harga/100)*$getmenu->diskon);
            $idtransaksi = Detailtransaksi::create([
                'idreservasi' => '0',
                'idtransaksi' => '0',
                'idmeja' => $meja->id,
                'idmenu' => $getmenu->id,
                'harga_awal'  => $getmenu->harga,
                'diskon'  => $getmenu->diskon,
                'harga_akhir'  => $hargaakhir,
                'jumlah'  => $qty,
                'total_harga'  => $hargaakhir*$qty,
                'status' => 'aktif',
                'aksi' => 'reserved',
                ]);
                //redirect to index
                return redirect('menupesan/'.$id)->with(['status' => 'error', 'success' => 'Data Berhasil Disimpan!']);
        }
    }
    //belumdiatur
    public function editpesan(Request $request)
    {
        $id = $request->id;
        $idtransaksi = $request->idtransaksi;
        $qty = $request->qty;
        $wherecek = array(
            'id' => $idtransaksi
        );
        // //create post
        if($qty>0){
            $getdata =  Detailtransaksi::where($wherecek)->first();
            // $qty = $getdata->jumlah+1;
            $totalharga = $getdata->harga_akhir*$qty;
            Detailtransaksi::where('id',$getdata->id)->update([
               'jumlah' => $qty,
               'total_harga' => $totalharga
             ]);
        }else{
            Detailtransaksi::where('id',$idtransaksi)->delete();
        }
        
        return redirect('listpesan/'.$id)->with(['status' => 'error']);
    }
    public function listpesan($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $meja = Qrmeja::where('kodeqr','=',$id)->first();
        $wherecek = array(
            'idmeja' => $meja->id,
            'aksi' => 'reserved',
        );
        $data['transaksi'] =  Detailtransaksi::join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')
                                ->select('detailtransaksis.*', 'menus.name', 'menus.foto')->where($wherecek)
                                ->where('detailtransaksis.created_at', '>=', date('Y-m-d 00:00:00'))
                                ->where('detailtransaksis.created_at', '<=', date('Y-m-d 23:59:59'))->get();
        $where = array(
            'kodeqr' => $id,
        );    
        $data['meja'] = Qrmeja::where($where)->first();
        return view('frontview.pesancart', $data);
    }
    public function savetransaksi(Request $request)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $this->validate($request, [
            'idmeja'     => 'required|min:1',
            'name'   => 'required|min:2'
        ]);
        $idtransaksi = Transaksi::create([
                'idreservasi'     => '0',
                'idmeja'     => $request->idmeja,
                'kodetransaksi'   => date('Ymdhis'),
                'customer'   => $request->name,
                'status'   => 'aktif',
                'aksi'   => 'reserved'
                ])->id;
        $wherecek = array(
            'idmeja' => $request->idmeja,
            'aksi' => 'reserved'
        );
        Detailtransaksi::where($wherecek)->update([
               'idtransaksi' => $idtransaksi,
             ]);
        return redirect('viewcart/'.$idtransaksi);
    }
    public function viewcart($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $wherecek = array(
            'idtransaksi' => $id,
        );
        $data['transaksi'] =  Transaksi::join('qrmejas', 'transaksis.idmeja', '=', 'qrmejas.id')->where('transaksis.id',$id)->first();
        $data['detailtransaksi'] =  Detailtransaksi::join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')->where($wherecek)->get();
        return view('frontview.viewcart', $data);
    }

    public function monolog($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['monologname'] = Monologkategori::where('id',$id)->first();
        $data['monologs'] = monolog::where('category',$id)->get();
        return view('frontview.monolog', $data);
    }
    public function viewmonolog($id)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $monolog = monolog::where('upload',$id)->first();
        $data['monologs'] = $monolog;
        if($monolog->status=='aktif'){
            return view('frontview.viewmonolog', $data);
        }else{
            return view('frontview.viewtoken', $data);
        }
        
    }
    public function bacamonolog(Request $request)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $this->validate($request, [
            'tokenkode'     => 'required|min:8',
            'url'   => 'required|min:1'
        ]);
        $transaksi = transaksi::where('kodetransaksi','=', $request->tokenkode)->exists();
        if($transaksi && date('Ymd00:00:00')<=$request->tokenkode){
            $monolog = monolog::where('id',$request->url)->first();
            $data['monologs'] = $monolog;
            return view('frontview.viewmonolog', $data);
        }else{
            $monolog = monolog::where('id',$request->url)->first();
            return redirect('viewmonolog/'.$monolog->upload)->with(['status' => 'error']);
        }
    }
    public function cektransaksi(Request $request)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        if(isset($request->tokenkode)){
            $transaksi = Transaksi::join('qrmejas', 'transaksis.idmeja', '=', 'qrmejas.id')
                        ->select('transaksis.*', 'qrmejas.nama_meja', 'qrmejas.kode')->where('kodetransaksi',$request->tokenkode);
            if($transaksi->exists()){
                $cektransaksi = $transaksi->first();
                $wherecek = array(
                    'idtransaksi' => $cektransaksi->id,
                );
                $data['transaksi'] =  $cektransaksi;
                $data['detailtransaksi'] =  Detailtransaksi::join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')->where($wherecek)->get();
                return view('frontview.viewcart', $data);
            }else{
                return view('frontview.tokentransaksi', $data);
            }
        }else{
            return view('frontview.tokentransaksi', $data);
        }
    }
    public function cekreservasi(Request $request)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        if(isset($request->tokenkode)){
            $reservasi = Reservasi::join('customers', 'reservasis.idcustomer', '=', 'customers.id')
                            ->select('reservasis.*', 'customers.pelanggan', 'customers.no_hp', 'customers.email')->where('kodereservasi',$request->tokenkode);
            if($reservasi->exists()){
                $cekreservasi = $reservasi->first();
                $wherecek = array(
                    'idreservasi' => $cekreservasi->id
                );
                $data['transaksi'] =  Detailtransaksi::join('menus', 'detailtransaksis.idmenu', '=', 'menus.id')
                                ->select('detailtransaksis.*', 'menus.name', 'menus.foto')->where($wherecek)->get();
                $data['reservasi'] = $cekreservasi;
                return view('frontview.reservasilistcart', $data);
            }else{
                return view('frontview.tokenreservasi', $data);
            }
        }else{
            return view('frontview.tokenreservasi', $data);
        }
    }
    public function artikel()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['artikels'] = Artikel::latest()->paginate(10);
        return view('frontview.artikel', $data);
    }
    public function kajian()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['kajians'] = Kajian::latest()->paginate(10);
        return view('frontview.kajian', $data);
    }
    public function viewkajian($url)
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['url'] = $url;
        return view('frontview.viewkajian', $data);
    }
    public function agenda()
    {
        $data['monologkategori'] = Monologkategori::orderBy('id','asc')->get();
        $data['agendas'] = Agenda::latest()->paginate(10);
        return view('frontview.agenda', $data);
    }
    // public function lapak()
    // {
    //     $data['lapaks'] = Lapak::latest()->paginate(10);
    //     return view('frontview.lapak', $data);
    // }

}
