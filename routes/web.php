<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('/', App\Http\Controllers\FrontController::class);
Route::get('/about', [App\Http\Controllers\FrontController::class, 'about'])->name('About');
Route::get('/team', [App\Http\Controllers\FrontController::class, 'team'])->name('Team');
Route::get('/menu', [App\Http\Controllers\FrontController::class, 'menu'])->name('Menu');
Route::get('/promo', [App\Http\Controllers\FrontController::class, 'promo'])->name('Promo');
Route::get('/reservasi', [App\Http\Controllers\FrontController::class, 'reservasi'])->name('Reservasi');
Route::get('/reservasi/pesan', [App\Http\Controllers\FrontController::class, 'pesan'])->name('Pesan');
Route::get('/cekreservasi', [App\Http\Controllers\FrontController::class, 'cekreservasi'])->name('Cek Reservasi');
Route::get('/cektransaksi', [App\Http\Controllers\FrontController::class, 'cektransaksi'])->name('Cek Reservasi');
Route::get('/resensi', [App\Http\Controllers\FrontController::class, 'resensi'])->name('Resensi');
Route::get('/artikel', [App\Http\Controllers\FrontController::class, 'artikel'])->name('Artikel');
Route::get('/puisi', [App\Http\Controllers\FrontController::class, 'puisi'])->name('Puisi');
Route::get('/kajian', [App\Http\Controllers\FrontController::class, 'kajian'])->name('Kajian');
Route::get('/viewkajian/{url}', [App\Http\Controllers\FrontController::class, 'viewkajian'])->name('View Kajian');
Route::get('/agenda', [App\Http\Controllers\FrontController::class, 'agenda'])->name('Agenda');
Route::get('/lapak', [App\Http\Controllers\FrontController::class, 'lapak'])->name('Lapak');
Route::get('/monolog/{id}', [App\Http\Controllers\FrontController::class, 'monolog'])->name('Monolog');
Route::get('/viewmonolog/{id}', [App\Http\Controllers\FrontController::class, 'viewmonolog'])->name('View Monolog');
Route::get('/bacamonolog', [App\Http\Controllers\FrontController::class, 'bacamonolog'])->name('Baca');

Route::get('/pilihmenu/{id}', [App\Http\Controllers\FrontController::class, 'pilihmenu'])->name('Pilih Menu');
// Route::get('/addcart/{id}/{idmenu}', [App\Http\Controllers\FrontController::class, 'addcart'])->name('Tambah Menu');
Route::get('/addcart', [App\Http\Controllers\FrontController::class, 'addcart'])->name('Tambah Menu');
Route::get('/editcart', [App\Http\Controllers\FrontController::class, 'editcart'])->name('Tambah Menu');
Route::get('/listcart/{id}', [App\Http\Controllers\FrontController::class, 'listcart'])->name('Tambah Menu');
Route::get('/updatecart/{id}', [App\Http\Controllers\FrontController::class, 'updatecart'])->name('Tambah Menu');


Route::get('/menupesan/{id}', [App\Http\Controllers\FrontController::class, 'menupesan'])->name('Menu Meja');
// Route::get('/addpesan/{id}/{idmenu}', [App\Http\Controllers\FrontController::class, 'addpesan'])->name('Tambah Menu');
Route::get('/addpesan', [App\Http\Controllers\FrontController::class, 'addpesan'])->name('Tambah Menu');
Route::get('/editpesan', [App\Http\Controllers\FrontController::class, 'editpesan'])->name('Tambah Menu');
Route::get('/listpesan/{id}', [App\Http\Controllers\FrontController::class, 'listpesan'])->name('Tambah Menu');
Route::get('/updatepesan/{id}', [App\Http\Controllers\FrontController::class, 'updatepesan'])->name('Tambah Menu');
Route::get('/savetransaksi', [App\Http\Controllers\FrontController::class, 'savetransaksi'])->name('Simpan');
Route::get('/viewcart/{id}', [App\Http\Controllers\FrontController::class, 'viewcart'])->name('View');
Route::get('/getbayar/{status}/{id}', [App\Http\Controllers\FrontController::class, 'getbayar'])->name('View');
Route::get('/getqris/{id}', [App\Http\Controllers\FrontController::class, 'getqris'])->name('View');
Route::post('/uploadbayar', [App\Http\Controllers\FrontController::class, 'uploadbayar'])->name('View');
Route::get('/hapusbayar/{id}', [App\Http\Controllers\FrontController::class, 'hapusbayar'])->name('View');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Membuat routes controller admin
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/admin/slider', App\Http\Controllers\Admin\SliderController::class);
Route::resource('/admin/about', App\Http\Controllers\Admin\AboutController::class);
Route::resource('/admin/agenda', App\Http\Controllers\Admin\AgendaController::class);
Route::resource('/admin/artikel', App\Http\Controllers\Admin\ArtikelController::class);
Route::resource('/admin/kajian', App\Http\Controllers\Admin\KajianController::class);
Route::resource('/admin/katalog', App\Http\Controllers\Admin\KatalogController::class);
Route::resource('/admin/lapakkategori', App\Http\Controllers\Admin\LapakKategoriController::class);
Route::resource('/admin/lapak', App\Http\Controllers\Admin\LapakController::class);
Route::resource('/admin/menukategori', App\Http\Controllers\Admin\MenuKategoriController::class);
Route::resource('/admin/menu', App\Http\Controllers\Admin\MenuController::class);
Route::resource('/admin/puisi', App\Http\Controllers\Admin\PuisiController::class);
Route::resource('/admin/resensi', App\Http\Controllers\Admin\ResensiController::class);
Route::resource('/admin/tim', App\Http\Controllers\Admin\TimController::class);
Route::resource('/admin/transaksi', App\Http\Controllers\Admin\TransaksiController::class);
Route::resource('/admin/keperluan', App\Http\Controllers\Admin\KeperluanController::class);
Route::get('/admin/listtransaksi/{status}', [App\Http\Controllers\Admin\TransaksiController::class, 'listtransaksi'])->name('List');
Route::get('/admin/detailtransaksi/{status}/{id}', [App\Http\Controllers\Admin\TransaksiController::class, 'detailtransaksi'])->name('Detail');
Route::get('/admin/prosestransaksi/{status}/{id}', [App\Http\Controllers\Admin\TransaksiController::class, 'prosestransaksi'])->name('Proses');
Route::get('/admin/counttransaksi', [App\Http\Controllers\Admin\TransaksiController::class, 'counttransaksi'])->name('Hitung');
Route::resource('/admin/laporan', App\Http\Controllers\Admin\LaporanController::class);
Route::resource('/admin/user', App\Http\Controllers\Admin\UserController::class);
Route::resource('/admin/reservasi', App\Http\Controllers\Admin\ReservasiController::class);
Route::get('admin/listreservasi/{status}', [App\Http\Controllers\Admin\ReservasiController::class, 'listreservasi'])->name('List');
Route::get('admin/datareservasi/{status}', [App\Http\Controllers\Admin\ReservasiController::class, 'datareservasi'])->name('List');
Route::get('admin/detailreservasi/{status}/{id}', [App\Http\Controllers\Admin\ReservasiController::class, 'detailreservasi'])->name('Detail');
Route::get('/admin/prosesreservasi/{status}/{id}', [App\Http\Controllers\Admin\ReservasiController::class, 'prosesreservasi'])->name('Proses');
Route::get('/editreservasi', [App\Http\Controllers\Admin\ReservasiController::class, 'editreservasi'])->name('Simpan');
Route::resource('/admin/monologkategori', App\Http\Controllers\Admin\MonologkategoriController::class);
Route::resource('/admin/jadwal', App\Http\Controllers\Admin\JadwalController::class);
Route::resource('/admin/monolog', App\Http\Controllers\Admin\MonologController::class);
Route::resource('/admin/dialog', App\Http\Controllers\Admin\DialogController::class);
Route::resource('/admin/qrmeja', App\Http\Controllers\Admin\QrmejaController::class);
Route::get('admin/qrcode/{id}', [App\Http\Controllers\Admin\QrmejaController::class, 'generate'])->name('Generate');
