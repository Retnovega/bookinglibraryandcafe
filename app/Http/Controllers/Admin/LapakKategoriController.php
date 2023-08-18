<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lapakkategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LapakKategoriController extends Controller
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
         $lapakkategoris = Lapakkategori::latest()->get();
         return view('admin.lapakkategori.index', compact('lapakkategoris'));
     }
     public function create()
     {
       return view('admin.lapakkategori.add');
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
             'kategori'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //create post
         Lapakkategori::create([
             'kategori'   => $request->kategori,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('lapakkategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Lapakkategori $lapakkategori)
     {
       // echo compact('post');
         return view('admin.lapakkategori.edit', compact('lapakkategori'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Lapakkategori $lapakkategori)
     {
         //validate form
         $this->validate($request, [
             'kategori'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         $lapakkategori->update([
           'kategori'   => $request->kategori,
           'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('lapakkategori.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Lapakkategori $lapakkategori)
     {
       //delete image
       Storage::delete('public/lapakkategoris/'. $lapakkategori->foto);

       //delete post
       $lapakkategori->delete();

       //redirect to index
       return redirect()->route('lapakkategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
