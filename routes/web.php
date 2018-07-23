<?php

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
	return view('welcome');
});

Route::middleware(['admin'])->get('/pool', 'ProductController@showPool');
Route::middleware(['admin'])->get('/pool/{id}', 'ProductController@showPoolDetail');
Route::middleware(['admin'])->patch('/productStatus/{id}', 'ProductController@updateProductStatus');

Route::get('/logout', function(Request $request){
	\Session::flush();
	return Redirect::to($request->post_logout_redirect_uri);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
