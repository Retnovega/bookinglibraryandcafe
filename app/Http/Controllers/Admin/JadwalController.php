<?php

namespace App\Http\Controllers\Admin;

use App\Models\Jadwal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JadwalController extends Controller
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
         $jadwals = Jadwal::latest()->get();
         return view('admin.jadwal.index', compact('jadwals'));
     }
     public function create()
     {
       return view('admin.jadwal.add');
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
             'tanggal'   => 'required|min:2',
             'jam'   => 'required|min:2',
             'keterangan'   => 'required|min:2'
         ]);

         //create post
         Jadwal::create([
            'tanggal'   => $request->tanggal,
           'jam'   => $request->jam,
           'keterangan'   => $request->keterangan
         ]);

         //redirect to index
         return redirect()->route('jadwal.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(jadwal $jadwal)
     {
       // echo compact('post');
         return view('admin.jadwal.edit', compact('jadwal'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Jadwal $jadwal)
     {
         //validate form
         $this->validate($request, [
             'tanggal'   => 'required|min:2',
             'jam'   => 'required|min:2',
             'keterangan'   => 'required|min:2'
         ]);

         $jadwal->update([
           'tanggal'   => $request->tanggal,
           'jam'   => $request->jam,
           'keterangan'   => $request->keterangan
         ]);

         //redirect to index
         return redirect()->route('jadwal.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Jadwal $jadwal)
     {
       //delete image
    //    Storage::delete('public/jadwals/'. $jadwal->foto);

       //delete post
       $jadwal->delete();

       //redirect to index
       return redirect()->route('jadwal.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
