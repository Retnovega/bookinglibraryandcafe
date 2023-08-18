<?php

namespace App\Http\Controllers\Admin;

use App\Models\Agenda;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
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
         $agendas = Agenda::latest()->get();
         return view('admin.agenda.index', compact('agendas'));
     }
     public function create()
     {
       return view('admin.agenda.add');
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
             'judul'     => 'required|min:5',
             'jam'   => 'required|min:2',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'narasumber'   => 'required|min:2',
             'status'   => 'required|min:2',
         ]);

         //create post
         Agenda::create([
              'judul'     => $request->judul,
              'jam'   => $request->jam,
              'tanggal'   => $request->tanggal,
              'deskripsi'   => $request->deskripsi,
              'narasumber'   => $request->narasumber,
              'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('agenda.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Agenda $agenda)
     {
       // echo compact('post');
         return view('admin.agenda.edit', compact('agenda'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Agenda $agenda)
     {
         //validate form
         $this->validate($request, [
             'judul'     => 'required|min:5',
             'jam'   => 'required|min:2',
             'tanggal'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'narasumber'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         $agenda->update([
               'judul'     => $request->judul,
               'jam'   => $request->jam,
               'tanggal'   => $request->tanggal,
               'deskripsi'   => $request->deskripsi,
               'narasumber'   => $request->narasumber,
               'status'   => $request->status
             ]);

         //redirect to index
         return redirect()->route('agenda.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Agenda $agenda)
     {

       //delete post
       $agenda->delete();

       //redirect to index
       return redirect()->route('agenda.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
