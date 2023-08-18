<?php

namespace App\Http\Controllers\Admin;

use App\Models\Puisi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PuisiController extends Controller
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
         $puisis = Puisi::latest()->get();
         return view('admin.puisi.index', compact('puisis'));
     }
     public function create()
     {
       return view('admin.puisi.add');
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
         $upload->storeAs('public/puisis', $upload->hashName());

         //create post
         Puisi::create([
             'upload'     => $upload->hashName(),
             'judul'     => $request->judul,
             'tanggal'   => $request->tanggal,
             'deskripsi'   => $request->deskripsi,
             'penulis'   => $request->penulis,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('puisi.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Puisi $puisi)
     {
       // echo compact('post');
         return view('admin.puisi.edit', compact('puisi'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Puisi $puisi)
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
             $upload->storeAs('public/puisis', $upload->hashName());

             //delete old image
             Storage::delete('public/puisis/'.$puisi->upload);

             //update post with new image
             $puisi->update([
              'upload'     => $upload->hashName(),
              'judul'     => $request->judul,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'penulis'   => $request->penulis,
              'status'   => $request->status
             ]);

         } else {

             //update post without image
             $puisi->update([
              'judul'     => $request->judul,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'penulis'   => $request->penulis,
              'status'   => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('puisi.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(puisi $puisi)
     {
       //delete image
       Storage::delete('public/puisis/'. $puisi->upload);

       //delete post
       $puisi->delete();

       //redirect to index
       return redirect()->route('puisi.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
