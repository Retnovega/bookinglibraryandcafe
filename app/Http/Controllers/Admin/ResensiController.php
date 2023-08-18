<?php

namespace App\Http\Controllers\Admin;

use App\Models\Resensi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResensiController extends Controller
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
         $resensis = Resensi::latest()->get();
         return view('admin.resensi.index', compact('resensis'));
     }
     public function create()
     {
       return view('admin.resensi.add');
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
         $upload->storeAs('public/resensis', $upload->hashName());

         //create post
         Resensi::create([
             'upload'     => $upload->hashName(),
             'judul'     => $request->judul,
             'tanggal'   => $request->tanggal,
             'deskripsi'   => $request->deskripsi,
             'penulis'   => $request->penulis,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('resensi.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Resensi $resensi)
     {
       // echo compact('post');
         return view('admin.resensi.edit', compact('resensi'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Resensi $resensi)
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
             $upload->storeAs('public/resensis', $upload->hashName());

             //delete old image
             Storage::delete('public/resensis/'.$resensi->upload);

             //update post with new image
             $resensi->update([
              'upload'     => $upload->hashName(),
              'judul'     => $request->judul,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'penulis'   => $request->penulis,
              'status'   => $request->status
             ]);

         } else {

             //update post without image
             $resensi->update([
              'judul'     => $request->judul,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'penulis'   => $request->penulis,
              'status'   => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('resensi.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Resensi $resensi)
     {
       //delete image
       Storage::delete('public/resensis/'. $resensi->upload);

       //delete post
       $resensi->delete();

       //redirect to index
       return redirect()->route('resensi.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
