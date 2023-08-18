<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
         $users = User::latest()->get();
         return view('admin.user.index', compact('users'));
     }
     public function create()
     {
       return view('admin.user.add');
     }
     /**
      * store
      *
      * @param Request $request
      * @return void
      */
    //  public function store(Request $request)
    //  {
    //      //validate form
    //      $this->validate($request, [
    //          'kategori'   => 'required|min:2',
    //          'status'   => 'required|min:2'
    //      ]);

    //      //create post
    //      User::create([
    //          'kategori'   => $request->kategori,
    //          'status'   => $request->status
    //      ]);

    //      //redirect to index
    //      return redirect()->route('user.index')->with(['success' => 'Data Berhasil Disimpan!']);
    //  }
     public function show()
     {

     }
     /**
     * edit
     *
     * @param  mixed $post
     * @return void
     */
     public function edit(user $user)
     {
       // echo compact('post');
         return view('admin.user.edit', compact('user'));
     }
     /**
      * update
      *
      * @param  mixed $request
      * @param  mixed $post
      * @return void
      */
     public function update(Request $request, User $user)
     {
         //validate form
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

         $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
         ]);

         //redirect to index
         return redirect()->route('user.index')->with(['success' => 'Data Berhasil Diubah!']);
     }
     /**
   * destroy
   *
   * @param  mixed $post
   * @return void
   */
     public function destroy(User $user)
     {
       //delete post
       $user->delete();

       //redirect to index
       return redirect()->route('user.index')->with(['success' => 'Data Berhasil Dihapus!']);
     }
}
