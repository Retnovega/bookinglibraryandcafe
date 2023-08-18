<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\Menukategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class MenuController extends Controller
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
        //  $menus = Menu::latest()->get();
        $menus = Menu::latest()
                  ->join('menukategoris', 'menus.category', '=', 'menukategoris.id')
                  ->select('menus.*', 'menukategoris.kategori')
                  ->get();
         return view('admin.menu.index', compact('menus'));
     }
     public function create()
     {
       $menukategoris = Menukategori::latest()->get();
       return view('admin.menu.add', compact('menukategoris'));
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
             'category'     => 'required|min:1',
             'name'     => 'required|min:2',
             'harga'   => 'required|min:2',
             'diskon'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //upload image
         $image = $request->file('foto');
         $image->storeAs('public/menus', $image->hashName());

         //create post
         Menu::create([
             'foto'     => $image->hashName(),
             'category'     => $request->category,
             'name'   => $request->name,
             'status'   => $request->status,
             'harga'     => $request->harga,
             'diskon'     => $request->diskon,
             'deskripsi'   => $request->deskripsi,
             'status'   => $request->status
         ]);

         //redirect to index
         return redirect()->route('menu.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
     public function edit(Menu $menu)
     {
       // echo compact('post');
          $menukategoris = Menukategori::latest()->get();
          $data = array(
            'menukategoris' => $menukategoris,
            'menu' => $menu,
          );
         return view('admin.menu.edit', $data);
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, Menu $menu)
     {
         //validate form
         $this->validate($request, [
             'foto'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'category'     => 'required|min:1',
             'name'     => 'required|min:2',
             'harga'   => 'required|min:2',
             'diskon'   => 'required|min:2',
             'deskripsi'   => 'required|min:2',
             'status'   => 'required|min:2'
         ]);

         //check if image is uploaded
         if ($request->hasFile('foto')) {

             //upload new image
             $image = $request->file('foto');
             $image->storeAs('public/menus', $image->hashName());

             //delete old image
             Storage::delete('public/menus/'.$menu->foto);

             //update post with new image
             $menu->update([
              'foto'     => $image->hashName(),
              'category'     => $request->category,
              'name'   => $request->name,
              'status'   => $request->status,
              'harga'     => $request->harga,
              'diskon'     => $request->diskon,
              'deskripsi'   => $request->deskripsi,
              'status'   => $request->status
             ]);

         } else {

             //update post without image
             $menu->update([
              'category'     => $request->category,
              'name'   => $request->name,
              'status'   => $request->status,
              'harga'     => $request->harga,
              'diskon'     => $request->diskon,
              'deskripsi'   => $request->deskripsi,
              'status'   => $request->status
             ]);
         }

         //redirect to index
         return redirect()->route('menu.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(Menu $menu)
     {
       //delete image
       Storage::delete('public/menus/'. $menu->foto);

       //delete post
       $menu->delete();

       //redirect to index
       return redirect()->route('menu.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
