<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kajian;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KajianController extends Controller
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
         $kajians = Kajian::latest()->get();
         return view('admin.kajian.index', compact('kajians'));
     }
     public function create()
     {
       return view('admin.kajian.add');
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
             'upload'     => 'mimes:pdf|max:10000',
             'judul'     => 'required|min:5',
             'jam'   => 'required|min:2',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'narasumber'   => 'required|min:2',
             'status'   => 'required|min:2',
         ]);
         if ($request->hasFile('upload')) {
            $upload = $request->file('upload');
            $upload->storeAs('public/kajians', $upload->hashName());
            //create post
            Kajian::create([
              'judul'     => $request->judul,
              'jam'   => $request->jam,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'narasumber'   => $request->narasumber,
              'upload' => $upload->hashName(),
              'status'   => $request->status
            ]);
         } else {
          Kajian::create([
              'judul'     => $request->judul,
              'jam'   => $request->jam,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'narasumber'   => $request->narasumber,
              'upload' => '-',
              'status'   => $request->status
            ]);
         }
         return redirect()->route('kajian.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Kajian $kajian)
     {
       // echo compact('post');
         return view('admin.kajian.edit', compact('kajian'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Kajian $kajian)
     {
         //validate form
         $this->validate($request, [
             'upload'     => 'mimes:pdf|max:10000',
             'judul'     => 'required|min:5',
             'jam'   => 'required|min:2',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'narasumber'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);
         if ($request->hasFile('upload')) {
            $upload = $request->file('upload');
            $upload->storeAs('public/kajians', $upload->hashName());

             Storage::delete('public/kajians/'.$kajian->upload);
            //create post
            $kajian->update([
               'judul'     => $request->judul,
               'jam'   => $request->jam,
               'tanggal'   => $request->tanggal,
               'deskripsi'   => $request->deskripsi,
               'narasumber'   => $request->narasumber,
               'upload'   => $upload->hashName(),
               'status'   => $request->status
             ]);
         } else {
          $kajian->update([
               'judul'     => $request->judul,
               'jam'   => $request->jam,
               'tanggal'   => $request->tanggal,
               'deskripsi'   => $request->deskripsi,
               'narasumber'   => $request->narasumber,
               'status'   => $request->status
             ]);
         }
         

         //redirect to index
         return redirect()->route('kajian.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Kajian $kajian)
     {
      Storage::delete('public/kajians/'.$kajian->upload);
       //delete post
       $kajian->delete();

       //redirect to index
       return redirect()->route('kajian.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
