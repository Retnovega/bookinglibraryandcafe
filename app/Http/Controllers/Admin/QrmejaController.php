<?php

namespace App\Http\Controllers\Admin;

use App\Models\Qrmeja;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrmejaController extends Controller
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
        $qrmejas = Qrmeja::latest()->get();
        return view('admin.qrmeja.index', compact('qrmejas'));
    }
    public function create()
    {
      return view('admin.qrmeja.add');
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
            'nama_meja'     => 'required|min:5',
            'kode'   => 'required|min:2',
            'status'   => 'required|min:2'
        ]);
        //create post
        qrmeja::create([
            'nama_meja'     => $request->nama_meja,
            'kode'   => $request->kode,
            'kodeqr'   => '-',
            'status'   => $request->status
        ]);

        //redirect to index
        return redirect()->route('qrmeja.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    public function generate ($id)
    {
        $data = Qrmeja::findOrFail($id);
        $kode = md5($data->id);
        Qrmeja::where('id', $data->id)->update([
              'kodeqr'     => $kode
            ]);
        $qrcode = QrCode::size(400)->generate(url('menupesan/'.$kode));
        return view('qrcode',compact('qrcode'));
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
    public function edit(Qrmeja $qrmeja)
    {
      // echo compact('post');
        return view('admin.qrmeja.edit', compact('qrmeja'));
    }
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Qrmeja $qrmeja)
    {
        //validate form
        $this->validate($request, [
            'nama_meja'     => 'required|min:5',
            'kode'   => 'required|min:2',
            'status'   => 'required|min:2'
        ]);

        //update post without image
            $qrmeja->update([
              'nama_meja'     => $request->nama_meja,
              'kode'   => $request->kode,
              'status'   => $request->status
            ]);

        //redirect to index
        return redirect()->route('qrmeja.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
  * destroy
  *
  * @param  mixed $post
  * @return void
  */
    public function destroy(Qrmeja $qrmeja)
    {

      //delete post
      $qrmeja->delete();

      //redirect to index
      return redirect()->route('qrmeja.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
