<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tim;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TimController extends Controller
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
        $tims = Tim::latest()->get();
        return view('admin.tim.index', compact('tims'));
    }
    public function create()
    {
      return view('admin.tim.add');
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
        $image->storeAs('public/tims', $image->hashName());

        //create post
        Tim::create([
            'foto'     => $image->hashName(),
            'nama'     => $request->nama,
            'posisi'   => $request->posisi,
            'status'   => $request->status
        ]);

        //redirect to index
        return redirect()->route('tim.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
    public function edit(Tim $tim)
    {
      // echo compact('post');
        return view('admin.tim.edit', compact('tim'));
    }
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Tim $tim)
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
            $image->storeAs('public/tims', $image->hashName());

            //delete old image
            Storage::delete('public/tims/'.$tim->foto);

            //update post with new image
            $tim->update([
              'foto'     => $image->hashName(),
              'nama'     => $request->nama,
              'posisi'   => $request->posisi,
              'status'   => $request->status
            ]);

        } else {

            //update post without image
            $tim->update([
              'nama'     => $request->nama,
              'posisi'   => $request->posisi,
              'status'   => $request->status
            ]);
        }

        //redirect to index
        return redirect()->route('tim.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
  * destroy
  *
  * @param  mixed $post
  * @return void
  */
    public function destroy(Tim $tim)
    {
      //delete image
      Storage::delete('public/tims/'. $tim->foto);

      //delete post
      $tim->delete();

      //redirect to index
      return redirect()->route('tim.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
