<?php

namespace App\Http\Controllers\Admin;

use App\Models\Dialog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DialogController extends Controller
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
         $dialogs = Dialog::latest()->get();
         return view('admin.dialog.index', compact('dialogs'));
     }
     public function create()
     {
       return view('admin.dialog.add');
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
         $image->storeAs('public/dialogs', $image->hashName());

         //create post
         Dialog::create([
             'foto'     => $image->hashName(),
             'nama'     => $request->nama,
             'posisi'   => $request->posisi,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('dialog.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Dialog $dialog)
     {
       // echo compact('post');
         return view('admin.dialog.edit', compact('dialog'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Dialog $dialog)
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
             $image->storeAs('public/dialogs', $image->hashName());

             //delete old image
             Storage::delete('public/dialogs/'.$dialog->foto);

             //update post with new image
             $dialog->update([
               'foto'     => $image->hashName(),
               'nama'     => $request->nama,
               'posisi'   => $request->posisi,
               'status'   => $request->status
             ]);

         } else {

             //update post without image
             $dialog->update([
               'nama'     => $request->nama,
               'posisi'   => $request->posisi,
               'status'   => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('dialog.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Dialog $dialog)
     {
       //delete image
       Storage::delete('public/dialogs/'. $dialog->foto);

       //delete post
       $dialog->delete();

       //redirect to index
       return redirect()->route('dialog.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
