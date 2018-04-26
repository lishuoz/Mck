<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('user')
        ->with('team')
        ->with('players')
        ->with('seasons')
        ->with('items')
        ->with('edition')
        ->with('level')
        ->with('loas')
        ->with('sizes')
        ->with('productImage')
        ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $product = new Product;
        if ($request->has('price')){
            $product->price = $request->price;
        }
        $product->user_id = $request->userId;
        $product->team()->associate($request->team);
        $product->edition()->associate($request->edition);
        $product->level()->associate($request->level);
        $product->note = $request->note;
        $product->forSale = $request->forSale === 'true'? true: false;;
        $product->tradeMethod = $request->tradeMethod;
        $product->quotedMethod = $request->quotedMethod;
        $product->description = $request->description;
        $product->save();
        $product->players()->attach($request->players);
        $product->seasons()->attach($request->seasons);
        $product->sizes()->attach($request->sizes);
        $product->items()->attach($request->items);
        $product->loas()->attach($request->loas);
        // foreach($request->file('photo') as $photo){
        //     $s3 = Storage::disk('s3');
        //     $fileName = time().'_'.$photo->getClientOriginalName();
        //     $s3->put($fileName, file_get_contents($photo), 'public');
        //     $product->images()->create([
        //         'path' => env('AWS_URL').$fileName,
        //         'name' => $fileName,
        //         'thumbnail_path' => 'thumbnail_'.$fileName,
        //     ]);
        // }
        // $product = Product::first();
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::with('user')
        ->with('team')
        ->with('players')
        ->with('seasons')
        ->with('items')
        ->with('edition')
        ->with('level')
        ->with('loas')
        ->with('sizes')
        ->with('productImage')
        ->with('matchImages')
        ->with('otherImages')
        ->with('loaImages')
        ->findOrFail($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getUserProducts($id)
    {
     $products = Product::with('user')
     ->with('team')
     ->with('players')
     ->with('seasons')
     ->with('items')
     ->with('edition')
     ->with('level')
     ->with('loas')
     ->with('sizes')
     ->with('productImage')
     ->with('matchImages')
     ->with('otherImages')
     ->with('loaImages')
     ->where('user_id', $id)
     ->get();
     return $products;
 }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
