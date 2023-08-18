<?php

namespace App\Http\Controllers\Admin;

use App\Models\Monolog;
use App\Models\Monologkategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonologController extends Controller
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
        $monologs = Monolog::latest()
                  ->join('monologkategoris', 'monologs.category', '=', 'monologkategoris.id')
                  ->select('monologs.*', 'monologkategoris.kategori')
                  ->get();
         return view('admin.monolog.index', compact('monologs'));
     }
     public function create()
     {
       $monologkategoris =  Monologkategori::orderBy('id','asc')->get();
       return view('admin.monolog.add', compact('monologkategoris'));
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
             'upload'     => 'required|mimes:pdf|max:10000',
             'category'     => 'required|min:1',
             'judul'     => 'required|min:5',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'penulis'   => 'required|min:2'
         ]);

         //upload image
         $image = $request->file('foto');
         $image->storeAs('public/monologs/images', $image->hashName());

         //upload pdf
         $upload = $request->file('upload');
         $upload->storeAs('public/monologs/files', $upload->hashName());

         //create post
         Monolog::create([
            'foto'     => $image->hashName(),
             'upload'     => $upload->hashName(),
             'category'     => $request->category,
             'judul'     => $request->judul,
             'tanggal'   => $request->tanggal,
             'deskripsi'   => $request->deskripsi,
             'penulis'   => $request->penulis,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('monolog.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Monolog $monolog)
     {
       // echo compact('post');
       $monologkategoris =  Monologkategori::orderBy('id','asc')->get();
          $data = array(
            'monologkategoris' => $monologkategoris,
            'monolog' => $monolog,
          );
         return view('admin.monolog.edit', $data);
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, monolog $monolog)
     {
         //validate form
         $this->validate($request, [
             'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'upload'     => 'mimes:pdf|max:10000',
             'category'     => 'required|min:1',
             'judul'     => 'required|min:5',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'penulis'   => 'required|min:2'
         ]);

         //check if image is uploaded
         if ($request->hasFile('upload')) {

             //upload new image
             $upload = $request->file('upload');
             $upload->storeAs('public/monologs/files', $upload->hashName());

             //delete old image
             Storage::delete('public/monologs/files/'.$monolog->upload);

             //update post with new image
             if ($request->hasFile('foto')) {
                //upload new image
                $image = $request->file('foto');
                $image->storeAs('public/monologs/images', $image->hashName());

                //delete old image
                Storage::delete('public/monologs/images/'.$monolog->foto);
                $monolog->update([
                  'foto'     => $image->hashName(),
                  'upload'     => $upload->hashName(),
                  'category'     => $request->category,
                  'judul'     => $request->judul,
                  'tanggal'   => $request->tanggal,
                  'deskripsi'   => $request->deskripsi,
                  'penulis'   => $request->penulis,
                  'status'   => $request->status
                ]);
            }else{
                $monolog->update([
                  'upload'     => $upload->hashName(),
                  'category'     => $request->category,
                  'judul'     => $request->judul,
                  'tanggal'   => $request->tanggal,
                  'deskripsi'   => $request->deskripsi,
                  'penulis'   => $request->penulis,
                  'status'   => $request->status
                ]);
             }
         } else {
          //update post with new image
             if ($request->hasFile('foto')) {
                //upload new image
                $image = $request->file('foto');
                $image->storeAs('public/monologs/images', $image->hashName());

                //delete old image
                Storage::delete('public/monologs/images/'.$monolog->foto);
                $monolog->update([
                  'foto'     => $image->hashName(),
                  'category'     => $request->category,
                  'judul'     => $request->judul,
                  'tanggal'   => $request->tanggal,
                  'deskripsi'   => $request->deskripsi,
                  'penulis'   => $request->penulis,
                  'status'   => $request->status
                ]);
            }else{
                $monolog->update([
                  'category'     => $request->category,
                  'judul'     => $request->judul,
                  'tanggal'   => $request->tanggal,
                  'deskripsi'   => $request->deskripsi,
                  'penulis'   => $request->penulis,
                  'status'   => $request->status
                ]);
             }
         }

         //redirect to index
         return redirect()->route('monolog.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Monolog $monolog)
     {
       //delete image
       Storage::delete('public/monologs/files/'. $monolog->upload);
       Storage::delete('public/monologs/images/'. $monolog->foto);

       //delete post
       $monolog->delete();

       //redirect to index
       return redirect()->route('monolog.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
