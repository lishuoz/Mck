<?php

namespace App\Http\Controllers;

use Image; 
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
	public function store(Request $request){
		// return $request->all();
		$product = Product::findOrFail($request->id);
		// if($request->has('frontImage') && $request->has('backImage')){
		$frontImage = $request->frontImage;
		// $frontImageWidth = Image::make($frontImage)->width();

		// return $frontImageWidth;


		$backImage = $request->backImage;

		$s3 = Storage::disk('s3');

		$cover = Image::make($frontImage)
		->fit(240, 320)
		->encode('jpg', 75)
		->stream();
		$coverName = 'cover_'.time().'_'.$frontImage->getClientOriginalName();
		$s3->put($product->id.'/'.$coverName, $cover->__toString(), 'public');

		$front = Image::make($frontImage)
		->fit(960, 1280)
		->encode('jpg', 90)
		->stream();
		$frontName = 'front_'.time().'_'.$frontImage->getClientOriginalName();
		$s3->put($product->id.'/'.$frontName, $front->__toString(), 'public');

		$frontThumbnail = Image::make($frontImage)
		->fit(75, 75)
		->encode('jpg', 75)
		->stream();
		$frontThumbnailName = 'front_thumbnail_'.time().'_'.$frontImage->getClientOriginalName();
		$s3->put($product->id.'/'.$frontThumbnailName, $frontThumbnail->__toString(), 'public');

		$back = Image::make($backImage)
		->fit(960, 1280)
		->encode('jpg', 90)
		->stream();
		$backName = 'back_'.time().'_'.$backImage->getClientOriginalName();
		$s3->put($product->id.'/'.$backName, $back->__toString(), 'public');

		$backThumbnail = Image::make($backImage)
		->fit(75, 75)
		->encode('jpg', 75)
		->stream();
		$backThumbnailName = 'back_thumbnail'.time().'_'.$backImage->getClientOriginalName();
		$s3->put($product->id.'/'.$backThumbnailName, $backThumbnail->__toString(), 'public');

		$product->productImage()->create([
			'product_id' => $product->id,
			'cover_path' => env('AWS_URL').$product->id.'/'.$coverName,
			'front_path' => env('AWS_URL').$product->id.'/'.$frontName,
			'thumbnail_front_path' => env('AWS_URL').$product->id.'/'.$frontThumbnailName,
			'back_path' => env('AWS_URL').$product->id.'/'.$backName,
			'thumbnail_back_path' => env('AWS_URL').$product->id.'/'.$backThumbnailName,
		]);

		if($request->has('matchImages')){
			$matchImages = $request->matchImages;
			
			foreach ($matchImages as $matchImage){
				$match = Image::make($matchImage)
				->fit(960, 1280)
				->encode('jpg', 90)
				->stream();
				$matchName = 'match_'.time().'_'.$matchImage->getClientOriginalName();
				$s3->put($product->id.'/'.$matchName, $match->__toString(), 'public');

				$matchThumbnail = Image::make($matchImage)
				->fit(75, 75)
				->encode('jpg', 75)
				->stream();
				$matchThumbnailName = 'match_thumbnail_'.time().'_'.$matchImage->getClientOriginalName();
				$s3->put($product->id.'/'.$matchThumbnailName, $matchThumbnail->__toString(), 'public');

				$product->matchImages()->create([
					'product_id' => $product->id,
					'path' => env('AWS_URL').$product->id.'/'.$matchName,
					'thumbnail_path' => env('AWS_URL').$product->id.'/'.$matchThumbnailName,
				]);
			}
		}

		if($request->has('loaImages')){
			$loaImages = $request->loaImages;

			foreach ($loaImages as $loaImage){
				$loa = Image::make($loaImage)
				->fit(960, 1280)
				->encode('jpg', 90)
				->stream();
				$loaName = 'loa_'.time().'_'.$loaImage->getClientOriginalName();
				$s3->put($product->id.'/'.$loaName, $loa->__toString(), 'public');

				$loaThumbnail = Image::make($loaImage)
				->fit(75, 75)
				->encode('jpg', 75)
				->stream();
				$loaThumbnailName = 'loa_thumbnail_'.time().'_'.$loaImage->getClientOriginalName();
				$s3->put($product->id.'/'.$loaThumbnailName, $loaThumbnail->__toString(), 'public');

				$product->loaImages()->create([
					'product_id' => $product->id,
					'path' => env('AWS_URL').$product->id.'/'.$loaName,
					'thumbnail_path' => env('AWS_URL').$product->id.'/'.$loaThumbnailName,
				]);
			}
		}

		if($request->has('otherImages')){
			$otherImages = $request->otherImages;

			foreach ($otherImages as $otherImage){
				$other = Image::make($otherImage)
				->fit(960, 1280)
				->encode('jpg', 90)
				->stream();
				$otherName = 'other_'.time().'_'.$otherImage->getClientOriginalName();
				$s3->put($product->id.'/'.$otherName, $other->__toString(), 'public');

				$otherThumbnail = Image::make($otherImage)
				->fit(75, 75)
				->encode('jpg', 75)
				->stream();
				$otherThumbnailName = 'other_thumbnail_'.time().'_'.$otherImage->getClientOriginalName();
				$s3->put($product->id.'/'.$otherThumbnailName, $otherThumbnail->__toString(), 'public');

				$product->otherImages()->create([
					'product_id' => $product->id,
					'path' => env('AWS_URL').$product->id.'/'.$otherName,
					'thumbnail_path' => env('AWS_URL').$product->id.'/'.$otherThumbnailName,
				]);
			}

		}
	// }
		return response()->json('S3 Uploaded Succeed', 200);
	}

}
