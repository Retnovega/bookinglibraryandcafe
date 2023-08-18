<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lapak;
use App\Models\Lapakkategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LapakController extends Controller
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
         $lapaks = DB::table('lapaks')
                  ->join('lapakkategoris', 'lapaks.category', '=', 'lapakkategoris.id')
                  ->select('lapaks.*', 'lapakkategoris.kategori')
                  ->get();


         return view('admin.lapak.index', compact('lapaks'));
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
