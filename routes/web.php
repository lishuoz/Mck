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
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
	echo "123";
	$s3 = Storage::disk('s3');
	$s3->put('myfile.txt', 'This is a dummy file for s3', 'public');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
