<?php

namespace App\Http\Controllers\Admin;

use App\Models\Katalog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KatalogController extends Controller
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
         $katalogs = Katalog::latest()->get();
         return view('admin.katalog.index', compact('katalogs'));
     }
     public function create()
     {
       return view('admin.katalog.add');
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
             'nama'     => 'required|min:5',
             'posisi'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //upload image
         $image = $request->file('foto');
         $image->storeAs('public/katalogs', $image->hashName());

         //create post
         Katalog::create([
             'foto'     => $image->hashName(),
             'nama'     => $request->nama,
             'posisi'   => $request->posisi,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('katalog.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Katalog $katalog)
     {
       // echo compact('post');
         return view('admin.katalog.edit', compact('katalog'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Katalog $katalog)
     {
         //validate form
         $this->validate($request, [
             'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'nama'     => 'required|min:5',
             'posisi'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //check if image is uploaded
         if ($request->hasFile('foto')) {

             //upload new image
             $image = $request->file('foto');
             $image->storeAs('public/katalogs', $image->hashName());

             //delete old image
             Storage::delete('public/katalogs/'.$katalog->foto);

             //update post with new image
             $katalog->update([
               'foto'     => $image->hashName(),
               'nama'     => $request->nama,
               'posisi'   => $request->posisi,
               'status'   => $request->status
             ]);

         } else {

             //update post without image
             $katalog->update([
               'nama'     => $request->nama,
               'posisi'   => $request->posisi,
               'status'   => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('katalog.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Katalog $katalog)
     {
       //delete image
       Storage::delete('public/katalogs/'. $katalog->foto);

       //delete post
       $katalog->delete();

       //redirect to index
       return redirect()->route('katalog.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
