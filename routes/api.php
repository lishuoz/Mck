<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/*
|--------------------------------------------------------------------------
| API Routes·
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/upload-image', function(Request $request){
	return response()->json('images uploaded successfully', 200);
});


Route::post('/test', function(Request $request){
	return response()->json('S3 Uploaded Succeed', 200);
});

Route::get('/user/{id}/products', 'ProductController@getUserProducts');

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/register', 'AuthController@register');

Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');
Route::post('/products', 'ProductController@store');
Route::post('/images', 'ImageController@store');

Route::get('/players', function (Request $request) {
	return App\Player::all();
});

Route::get('/teams', function (Request $request) {
	return App\Team::all();
});

Route::get('/seasons', function (Request $request) {
	return App\Season::all();
});

Route::get('/editions', function (Request $request) {
	return App\Edition::all();
});

Route::get('/levels', function (Request $request) {
	return App\Level::all();
});

Route::get('/sizes', function (Request $request) {
	return App\Size::all();
});

Route::get('/items', function (Request $request) {
	return App\Item::all();
});

Route::get('/loas', function (Request $request) {
	return App\Loa::all();
});


