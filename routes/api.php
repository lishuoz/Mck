<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

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
	return print_r($request->all());
});

Route::get('/test', function(Request $request){
	return 'dashabi';
});



Route::post('/front-image/{id}', 'ImageController@storeFrontImage');
Route::delete('/front-image/{id}', 'ImageController@deleteFrontImage');

Route::post('/back-image/{id}', 'ImageController@storeBackImage');
Route::delete('/back-image/{id}', 'ImageController@deleteBackImage');

Route::post('/level-image/{id}', 'ImageController@storeLevelImages');
Route::delete('/level-image/{id}/{fileName}', 'ImageController@deleteLevelImage');

Route::post('/loa-image/{id}', 'ImageController@storeLoaImages');
Route::delete('/loa-image/{id}/{fileName}', 'ImageController@deleteLoaImage');

Route::post('/other-image/{id}', 'ImageController@storeOtherImages');
Route::delete('/other-image/{id}/{fileName}', 'ImageController@deleteOtherImage');

Route::post('/product-images', 'ImageController@storeProductImages');
Route::post('/additional-images', 'ImageController@storeAdditionalImages');
Route::post('/other-images', 'ImageController@storeOtherImages');

Route::get('/user/{id}/products', 'ProductController@getUserProducts');

Route::post('/users/edit', 'UserController@editProfile');
Route::post('/users/verify', 'UserController@verify');

Route::middleware(['auth:api'])->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout');


Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');
Route::patch('/products/{id}', 'ProductController@update');

Route::patch('/products/status/{id}', 'ProductController@updateStatus');
Route::delete('/products/{id}', 'ProductController@destroy');

Route::post('/products', 'ProductController@store');
Route::post('/products/sale-status', 'ProductController@storeSaleStatus');
Route::put('/products/sale-status', 'ProductController@updateSaleStatus');

Route::post('/images', 'ImageController@store');

Route::get('/players', function (Request $request) {
	return App\Player::all();
});

Route::get('/teams', function (Request $request) {
	return App\Team::all();
});

Route::get('/seasons', function (Request $request) {
	return App\Season::orderBy('id', 'DESC')->get();
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

Route::get('/jerseyzoneone', 'ProductController@jerseyZoneOne');
Route::get('/jerseyzonetwo', 'ProductController@jerseyZoneTwo');
