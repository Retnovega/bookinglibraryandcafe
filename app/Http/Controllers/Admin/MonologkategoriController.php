<?php

namespace App\Http\Controllers\Admin;

use App\Models\monolog;
use App\Models\Monologkategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MonologkategoriController extends Controller
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
         $monologkategoris = Monologkategori::latest()->get();
         return view('admin.monologkategori.index', compact('monologkategoris'));
     }
     public function create()
     {
       return view('admin.monologkategori.add');
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
         monologkategori::create([
             'kategori'   => $request->kategori,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('monologkategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(monologkategori $monologkategori)
     {
       // echo compact('post');
         return view('admin.monologkategori.edit', compact('monologkategori'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, monologkategori $monologkategori)
     {
         //validate form
         $this->validate($request, [
             'kategori'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         $monologkategori->update([
           'kategori'   => $request->kategori,
           'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('monologkategori.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(monologkategori $monologkategori)
     {
       //delete image
       Storage::delete('public/monologkategoris/'. $monologkategori->foto);

       //delete post
       $monologkategori->delete();

       //redirect to index
       return redirect()->route('monologkategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
