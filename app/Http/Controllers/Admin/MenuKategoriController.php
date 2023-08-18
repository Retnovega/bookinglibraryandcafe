<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menukategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuKategoriController extends Controller
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
         $menukategoris = Menukategori::latest()->get();
         return view('admin.menukategori.index', compact('menukategoris'));
     }
     public function create()
     {
       return view('admin.menukategori.add');
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
             'kategori'     => 'required|min:5',
             'status'   => 'required|min:2'
         ]);
         $kategorilink = str_replace(" ","",strtolower($request->kategori));
         //upload image
         $image = $request->file('foto');
         $image->storeAs('public/menukategoris', $image->hashName());
         //create post
         MenuKategori::create([
              'foto'     => $image->hashName(),
              'kategori_link'   => $kategorilink,
              'kategori'   => $request->kategori,
              'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('menukategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(MenuKategori $menukategori)
     {
       // echo compact('post');
         return view('admin/menukategori.edit', compact('menukategori'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, MenuKategori $menukategori)
     {
         //validate form
         $this->validate($request, [
             'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'kategori'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);
         $kategorilink = str_replace(" ","",strtolower($request->kategori));

         //check if image is uploaded
         
         if ($request->hasFile('foto')) {

             //upload new image
             $image = $request->file('foto');
             $image->storeAs('public/menukategoris', $image->hashName());

             //delete old image
             Storage::delete('public/menukategoris/'.$menukategori->foto);

             //update post with new image
             
             $menukategori->update([
                'foto'     => $image->hashName(),
                'kategori_link'   => $kategorilink,
                'kategori'   => $request->kategori,
                'status'   => $request->status
              ]);

         } else {

             //update post without image
             $menukategori->update([
                'kategori_link'   => $kategorilink,
                'kategori'   => $request->kategori,
                'status'   => $request->status
              ]);
         }

         //redirect to index
         return redirect()->route('menukategori.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(MenuKategori $menukategori)
     {
      //delete image
       Storage::delete('public/menukategoris/'. $menukategori->foto);
       //delete post
       $menukategori->delete();

       //redirect to index
       return redirect()->route('menukategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
