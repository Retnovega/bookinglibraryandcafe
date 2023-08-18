<?php

namespace App\Http\Controllers\admin;

use App\Models\Keperluan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KeperluanController extends Controller
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
         $keperluans = Keperluan::latest()->paginate(10);
         return view('admin.keperluan.index', compact('keperluans'));
     }
     public function create()
     {
       return view('admin.keperluan.add');
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
             'keperluan'   => 'required|min:2',
             'biaya'   => 'required|min:1',
             'status'   => 'required|min:2'
         ]);

         //create post
         Keperluan::create([
             'keperluan'   => $request->keperluan,
             'biaya'   => $request->biaya,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('keperluan.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Keperluan $keperluan)
     {
       // echo compact('post');
         return view('admin.keperluan.edit', compact('keperluan'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Keperluan $keperluan)
     {
         //validate form
         $this->validate($request, [
             'keperluan'   => 'required|min:2',
             'biaya'   => 'required|min:1',
             'status'   => 'required|min:2'
         ]);

         $keperluan->update([
           'keperluan'   => $request->keperluan,
           'biaya'   => $request->biaya,
           'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('keperluan.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Keperluan $keperluan)
     {

       //delete post
       $keperluan->delete();

       //redirect to index
       return redirect()->route('keperluan.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
