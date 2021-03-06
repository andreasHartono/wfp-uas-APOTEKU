<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@home');

Route::get('cart', 'HomeController@cart');
Route::get('add-to-cart/{id}', 'HomeController@addToCart');

Route::post('/checkout', 'NotaController@checkout');

Route::get('/history', "HomeController@history");
Route::get('/history/{id}', "HomeController@historyDetail");

Route::get('/login/account', 'LoginController@Login');
Route::get('/logout/account', 'LoginController@logout');
Auth::routes();

Route::group(['middleware' => 'admin'], function () {
   //Report
   Route::get('/report/obat', 'ObatController@showObat');
   Route::get('/reportcustomer', 'ObatController@showData');
   Route::get('/reportNote', 'NotaController@index');
   Route::get('/repordetail/{id}', 'NotaDetailController@cari');

   //Obat
   Route::get('/obat', 'ObatController@dashboardAdmin')->name('obat.index');
   Route::post('/obat/add', 'ObatController@store');
   Route::delete('/obat/delete/{obat}', 'ObatController@destroy');

   //kategori
   Route::get('/kategori', 'KategoriObatController@index')->name('kategori.index');
   Route::post('/kategori/add', 'KategoriObatController@store');
   Route::post('/kategori/update/{kategoriObat}', 'KategoriObatController@edit');
   Route::delete('/kategori/delete/{kategoriObat}', 'KategoriObatController@destroy');

   //Pembeli
   Route::get('/pembeli', 'UserController@data');
   Route::post('/pembeli/edit', 'UserController@edit');

   //Dashboard
   Route::get('/dashboard', function () {
      return view('admin.info');
   });
});

//Routing yang tidak terpakai

// Route::get('/testlogin', function () {
//     return view('auth.login');
// });
// Route::group(['middleware' => 'is_admin'], function () {
// });
