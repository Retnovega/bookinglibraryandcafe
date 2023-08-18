<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
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
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }
    public function create()
    {
      return view('admin.slider.add');
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
            'judul'     => 'required|min:2',
            'deskripsi'   => 'required|min:2',
            'status'   => 'required|min:2'
        ]);

        //upload image
        $image = $request->file('foto');
        $image->storeAs('public/sliders', $image->hashName());

        //create post
        Slider::create([
            'foto'     => $image->hashName(),
            'judul'     => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'status'   => $request->status
        ]);

        //redirect to index
        return redirect()->route('slider.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
    public function edit(Slider $slider)
    {
      // echo compact('post');
        return view('admin.slider.edit', compact('slider'));
    }
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function update(Request $request, Slider $slider)
    {
        //validate form
        $this->validate($request, [
            'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul'     => 'required|min:2',
            'deskripsi'   => 'required|min:2',
            'status'   => 'required|min:2'
        ]);

        //check if image is uploaded
        if ($request->hasFile('foto')) {

            //upload new image
            $image = $request->file('foto');
            $image->storeAs('public/sliders', $image->hashName());

            //delete old image
            Storage::delete('public/sliders/'.$slider->foto);

            //update post with new image
            $slider->update([
              'foto'     => $image->hashName(),
              'judul'     => $request->judul,
              'deskripsi'   => $request->deskripsi,
              'status'   => $request->status
            ]);

        } else {

            //update post without image
            $slider->update([
              'judul'     => $request->judul,
              'deskripsi'   => $request->deskripsi,
              'status'   => $request->status
            ]);
        }

        //redirect to index
        return redirect()->route('slider.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    /**
  * destroy
  *
  * @param  mixed $post
  * @return void
  */
    public function destroy(Slider $slider)
    {
      //delete image
      Storage::delete('public/sliders/'. $slider->foto);

      //delete post
      $slider->delete();

      //redirect to index
      return redirect()->route('slider.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
