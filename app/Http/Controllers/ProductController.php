<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::withAllRelations()
        ->with('user')
        ->where('status', 'approved')
        ->orderBy('created_at', 'DESC')
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
        // $validatedData = $request->validate([
        //     'user_id' => 'required',
        //     'team' => 'required',
        //     'edition' => 'required',
        //     'level' => 'required',
        //     'forSale' => 'required',
        //     'players' => 'required',
        //     'seasons' => 'required',
        //     'sizes' => 'required',
        //     'items' => 'required',
        //     'loas' => 'required',
        //     'note' => 'string|max:255',
        //     'description' => 'string|max:255',
        // ]);
        $product = new Product;
        $product->user_id = $request->userId;
        $product->team()->associate($request->team);
        $product->edition()->associate($request->edition);
        $product->level()->associate($request->level);
        $product->note = $request->note;
        $product->description = $request->description;
        $product->save();
        $product->players()->attach($request->players);
        $product->seasons()->attach($request->seasons);
        $product->sizes()->attach($request->sizes);
        $product->items()->attach($request->items);
        $product->loas()->attach($request->loas);
        return $product;
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function storeSaleStatus(Request $request)
      {
        // return $request->all();
        $product = Product::findOrFail($request->productId);
        $product->saleStatus()->create([
            'product_id' => $request->productId,
            'forSale' => $request->forSale,
            'tradeMethod' => $request->tradeMethod,
            'quotedMethod' => $request->quotedMethod,
            'price' => $request->price,
            'status' => 'complete',
        ]);
        return response(200);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function updateSaleStatus(Request $request)
     {  
        // return ($request->all());
        $product = Product::findOrFail($request->productId);
        $product->saleStatus()->update([
            'product_id' => $request->productId,
            'forSale' => $request->forSale,
            'tradeMethod' => $request->tradeMethod,
            'quotedMethod' => $request->quotedMethod,
            'price' => $request->price,
            'status' => 'complete',
        ]);
        return response(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        return Product::withAllRelations()
        ->with('user')
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
        $products = Product::withAllRelations()
        ->with('user')
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
    public function updateStatus(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $product->status = 'pending';
        $product->save();
        return $product;
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $product->team()->associate($request->team);
        $product->edition()->associate($request->edition);
        $product->level()->associate($request->level);
        $product->note = $request->note;
        $product->description = $request->description;
        $product->players()->sync($request->players);
        $product->seasons()->sync($request->seasons);
        $product->sizes()->sync($request->sizes);
        $product->items()->sync($request->items);
        $product->loas()->sync($request->loas);
        $product->status = 'unverified';
        $product->save();
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        $product = Product::find($id);
        $product->delete();
        return response()->json('产品删除成功', 200);
    }

    public function showPool(){
        $products = Product::withAllRelations()->with('user')->where('status', 'pending')->get();
        return view('pool', ['products' => $products]);
    }

    public function showPoolDetail($id){
        $product = Product::withAllRelations()
        ->with('user')
        ->findOrFail($id);
        return view('pool-detail', ['product' => $product]);
    }

    public function updateProductStatus(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->status = $request->status;
        $product->save();
        $products = Product::withAllRelations()->with('user')->where('status', 'pending')->get();
        return Redirect::to('/pool');
    }

    public function jerseyZoneOne(){
        $result = array();
        $ids = [32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 65];
        foreach ($ids as $id) {
            array_push($result,$this->show($id));
        }
        return $result;
    }

    public function jerseyZoneTwo(){
        $result = array();
        $ids = [48, 49, 50, 51, 52];
        foreach ($ids as $id) {
            array_push($result,$this->show($id));
        }
        return $result;
    }

    public function jerseyZoneThree(){
        $result = array();
        $ids = [ 53, 54, 55, 56, 58, 59, 60, 61];
        foreach ($ids as $id) {
            array_push($result,$this->show($id));
        }
        return $result;
    }
}
