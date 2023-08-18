<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artikel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
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
         $artikels = Artikel::latest()->get();
         return view('admin.artikel.index', compact('artikels'));
     }
     public function create()
     {
       return view('admin.artikel.add');
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
             'upload'     => 'required|mimes:pdf|max:10000',
             'judul'     => 'required|min:5',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'penulis'   => 'required|min:2'
         ]);

         //upload pdf
         $upload = $request->file('upload');
         $upload->storeAs('public/artikels', $upload->hashName());

         //create post
         Artikel::create([
             'upload'     => $upload->hashName(),
             'judul'     => $request->judul,
             'tanggal'   => $request->tanggal,
             'deskripsi'   => $request->deskripsi,
             'penulis'   => $request->penulis,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Artikel $artikel)
     {
       // echo compact('post');
         return view('admin.artikel.edit', compact('artikel'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Artikel $artikel)
     {
         //validate form
         $this->validate($request, [
             'upload'     => 'mimes:pdf|max:10000',
             'judul'     => 'required|min:5',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'penulis'   => 'required|min:2'
         ]);

         //check if image is uploaded
         if ($request->hasFile('upload')) {

             //upload new image
             $upload = $request->file('upload');
             $upload->storeAs('public/artikels', $upload->hashName());

             //delete old image
             Storage::delete('public/artikels/'.$artikel->upload);

             //update post with new image
             $artikel->update([
              'upload'     => $upload->hashName(),
              'judul'     => $request->judul,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'penulis'   => $request->penulis,
              'status'   => $request->status
             ]);

         } else {

             //update post without image
             $artikel->update([
              'judul'     => $request->judul,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'penulis'   => $request->penulis,
              'status'   => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Artikel $artikel)
     {
       //delete image
       Storage::delete('public/artikels/'. $artikel->upload);

       //delete post
       $artikel->delete();

       //redirect to index
       return redirect()->route('artikel.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
