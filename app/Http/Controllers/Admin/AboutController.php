<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
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
         $abouts = About::latest()->paginate(10);
         return view('admin.about.index', compact('abouts'));
     }
     public function create()
     {
       return view('admin.about.add');
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
           'nama' => 'required|min:2',
           'alamat' => 'required|min:2',
           'nomor_hp' => 'required|min:2',
           'deskripsi' => 'required|min:2',
           'lokasi' => 'required|min:2',
           'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'status' => 'required|min:2'
         ]);

         //upload image
         $image = $request->file('foto');
         $image->storeAs('public/abouts', $image->hashName());

         //create post
         About::create([
           'nama' => $request->nama,
           'alamat' => $request->alamat,
           'nomor_hp' => $request->nomor_hp,
           'deskripsi' => $request->deskripsi,
           'lokasi' => $request->lokasi,
           'foto' => $image->hashName(),
           'status' => $request->status
         ]);

         //redirect to index
         return redirect()->route('about.edit', $about->id)->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(About $about)
     {
       // echo compact('post');
         return view('admin.about.edit', compact('about'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, About $about)
     {
         //validate form
         $this->validate($request, [
           'nama' => 'required|min:2',
           'alamat' => 'required|min:2',
           'nomor_hp' => 'required|min:2',
           'deskripsi' => 'required|min:2',
           'lokasi' => 'required|min:2',
           'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
           'status' => 'required|min:2'
         ]);

         //check if image is uploaded
         if ($request->hasFile('foto')) {

             //upload new image
             $image = $request->file('foto');
             $image->storeAs('public/abouts', $image->hashName());

             //delete old image
             Storage::delete('public/abouts/'.$about->foto);

             //update post with new image
             $about->update([
               'nama' => $request->nama,
               'alamat' => $request->alamat,
               'nomor_hp' => $request->nomor_hp,
               'deskripsi' => $request->deskripsi,
               'lokasi' => $request->lokasi,
               'foto' => $image->hashName(),
               'status' => $request->status
             ]);

         } else {

             //update post without image
             $about->update([
               'nama' => $request->nama,
               'alamat' => $request->alamat,
               'nomor_hp' => $request->nomor_hp,
               'deskripsi' => $request->deskripsi,
               'lokasi' => $request->lokasi,
               'status' => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('about.edit', $about->id)->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(About $about)
     {
       //delete image
       Storage::delete('public/abouts/'. $about->foto);

       //delete post
       $about->delete();

       //redirect to index
       return redirect()->route('about.edit', $about->id)->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
