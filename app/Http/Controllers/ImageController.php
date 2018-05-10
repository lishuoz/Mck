<?php

namespace App\Http\Controllers;

use Image; 
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
	// public function store(Request $request){
	// 	// return $request->all();
	// 	$product = Product::findOrFail($request->id);
	// 	// if($request->has('frontImage') && $request->has('backImage')){
	// 	$frontImage = $request->frontImage;
	// 	$frontImageWidth = 960;
	// 	$frontImageHeight = $frontImageWidth * Image::make($frontImage)->height() / Image::make($frontImage)->width();
	// 	$coverImageWidth = 240;
	// 	$coverImageHeight = $coverImageWidth * Image::make($frontImage)->height() / Image::make($frontImage)->width();

	// 	$backImage = $request->backImage;
	// 	$backImageWidth = 960;
	// 	$backImageHeight = $backImageWidth * Image::make($backImage)->height() / Image::make($backImage)->width();

	// 	$s3 = Storage::disk('s3');

	// 	$cover = Image::make($frontImage)
	// 	->fit($coverImageWidth, intval($coverImageHeight))
	// 	->encode('jpg', 75)
	// 	->stream();
	// 	$coverName = 'cover_'.time().'_'.$frontImage->getClientOriginalName();
	// 	$s3->put($product->id.'/'.$coverName, $cover->__toString(), 'public');

	// 	$front = Image::make($frontImage)
	// 	->fit($frontImageWidth, intval($frontImageHeight))
	// 	->encode('jpg', 90)
	// 	->stream();
	// 	$frontName = 'front_'.time().'_'.$frontImage->getClientOriginalName();
	// 	$s3->put($product->id.'/'.$frontName, $front->__toString(), 'public');

	// 	$frontThumbnail = Image::make($frontImage)
	// 	->fit(75, 75)
	// 	->encode('jpg', 75)
	// 	->stream();
	// 	$frontThumbnailName = 'front_thumbnail_'.time().'_'.$frontImage->getClientOriginalName();
	// 	$s3->put($product->id.'/'.$frontThumbnailName, $frontThumbnail->__toString(), 'public');

	// 	$back = Image::make($backImage)
	// 	->fit($backImageWidth, intval($backImageHeight))
	// 	->encode('jpg', 90)
	// 	->stream();
	// 	$backName = 'back_'.time().'_'.$backImage->getClientOriginalName();
	// 	$s3->put($product->id.'/'.$backName, $back->__toString(), 'public');

	// 	$backThumbnail = Image::make($backImage)
	// 	->fit(75, 75)
	// 	->encode('jpg', 75)
	// 	->stream();
	// 	$backThumbnailName = 'back_thumbnail'.time().'_'.$backImage->getClientOriginalName();
	// 	$s3->put($product->id.'/'.$backThumbnailName, $backThumbnail->__toString(), 'public');

	// 	$product->productImage()->create([
	// 		'product_id' => $product->id,
	// 		'cover_path' => env('AWS_URL').$product->id.'/'.$coverName,
	// 		'front_path' => env('AWS_URL').$product->id.'/'.$frontName,
	// 		'thumbnail_front_path' => env('AWS_URL').$product->id.'/'.$frontThumbnailName,
	// 		'back_path' => env('AWS_URL').$product->id.'/'.$backName,
	// 		'thumbnail_back_path' => env('AWS_URL').$product->id.'/'.$backThumbnailName,
	// 	]);

	// 	if($request->has('matchImages')){
	// 		$matchImages = $request->matchImages;

	// 		foreach ($matchImages as $matchImage){

	// 			$matchImageWidth = 960;
	// 			$matchImageHeight = $matchImageWidth * Image::make($matchImage)->height() / Image::make($matchImage)->width();
	// 			$match = Image::make($matchImage)
	// 			->fit($matchImageWidth, intval($matchImageHeight))
	// 			->encode('jpg', 90)
	// 			->stream();
	// 			$matchName = 'match_'.time().'_'.$matchImage->getClientOriginalName();
	// 			$s3->put($product->id.'/'.$matchName, $match->__toString(), 'public');

	// 			$matchThumbnail = Image::make($matchImage)
	// 			->fit(75, 75)
	// 			->encode('jpg', 75)
	// 			->stream();
	// 			$matchThumbnailName = 'match_thumbnail_'.time().'_'.$matchImage->getClientOriginalName();
	// 			$s3->put($product->id.'/'.$matchThumbnailName, $matchThumbnail->__toString(), 'public');

	// 			$product->matchImages()->create([
	// 				'product_id' => $product->id,
	// 				'path' => env('AWS_URL').$product->id.'/'.$matchName,
	// 				'thumbnail_path' => env('AWS_URL').$product->id.'/'.$matchThumbnailName,
	// 			]);
	// 		}
	// 	}

	// 	if($request->has('loaImages')){
	// 		$loaImages = $request->loaImages;

	// 		foreach ($loaImages as $loaImage){
	// 			$loaImageWidth = 960;
	// 			$loaImageHeight = $loaImageWidth * Image::make($loaImage)->height() / Image::make($loaImage)->width();

	// 			$loa = Image::make($loaImage)
	// 			->fit($loaImageWidth, intval($loaImageHeight))
	// 			->encode('jpg', 90)
	// 			->stream();
	// 			$loaName = 'loa_'.time().'_'.$loaImage->getClientOriginalName();
	// 			$s3->put($product->id.'/'.$loaName, $loa->__toString(), 'public');

	// 			$loaThumbnail = Image::make($loaImage)
	// 			->fit(75, 75)
	// 			->encode('jpg', 75)
	// 			->stream();
	// 			$loaThumbnailName = 'loa_thumbnail_'.time().'_'.$loaImage->getClientOriginalName();
	// 			$s3->put($product->id.'/'.$loaThumbnailName, $loaThumbnail->__toString(), 'public');

	// 			$product->loaImages()->create([
	// 				'product_id' => $product->id,
	// 				'path' => env('AWS_URL').$product->id.'/'.$loaName,
	// 				'thumbnail_path' => env('AWS_URL').$product->id.'/'.$loaThumbnailName,
	// 			]);
	// 		}
	// 	}

	// 	if($request->has('otherImages')){
	// 		$otherImages = $request->otherImages;

	// 		foreach ($otherImages as $otherImage){
	// 			$otherImageWidth = 960;
	// 			$otherImageHeight = $otherImageWidth * Image::make($otherImage)->height() / Image::make($otherImage)->width();

	// 			$other = Image::make($otherImage)
	// 			->fit($otherImageWidth, intval($otherImageHeight))
	// 			->encode('jpg', 90)
	// 			->stream();
	// 			$otherName = 'other_'.time().'_'.$otherImage->getClientOriginalName();
	// 			$s3->put($product->id.'/'.$otherName, $other->__toString(), 'public');

	// 			$otherThumbnail = Image::make($otherImage)
	// 			->fit(75, 75)
	// 			->encode('jpg', 75)
	// 			->stream();
	// 			$otherThumbnailName = 'other_thumbnail_'.time().'_'.$otherImage->getClientOriginalName();
	// 			$s3->put($product->id.'/'.$otherThumbnailName, $otherThumbnail->__toString(), 'public');

	// 			$product->otherImages()->create([
	// 				'product_id' => $product->id,
	// 				'path' => env('AWS_URL').$product->id.'/'.$otherName,
	// 				'thumbnail_path' => env('AWS_URL').$product->id.'/'.$otherThumbnailName,
	// 			]);
	// 		}

	// 	}
	// // }
	// 	return response()->json('S3 Uploaded Succeed', 200);
	// }

	public function storeProductImages(Request $request){
		$product = Product::with('level')->findOrFail($request->id);
		$s3 = Storage::disk('s3');
		$frontImage = $request->frontImage;
		$frontName = $frontImage->getClientOriginalName();
		$backImage = $request->backImage;
		$backName = $backImage->getClientOriginalName();

		$thumbnailFront = $this->makeThumbnailImage($frontImage);
		$thumbnailFrontName = 'th_front_'.md5($frontName . time());
		$s3->put($product->id.'/'.$thumbnailFrontName, $thumbnailFront->__toString(), 'public');
		
		$smallFront = $this->makeSmallImage($frontImage);
		$smallFrontName = 's_front_'.md5($frontName . time());
		$s3->put($product->id.'/'.$smallFrontName, $smallFront->__toString(), 'public');
		
		$mediumFront = $this->makeMediumImage($frontImage);
		$mediumFrontName = 'm_front_'.md5($frontName . time());
		$s3->put($product->id.'/'.$mediumFrontName, $mediumFront->__toString(), 'public');
		
		$largeFront = $this->makeLargeImage($frontImage);
		$largeFrontName = 'l_front_'.md5($frontName . time());
		$s3->put($product->id.'/'.$largeFrontName, $largeFront->__toString(), 'public');

		$thumbnailBack = $this->makeThumbnailImage($backImage);
		$thumbnailBackName = 'th_back_'.md5($backName . time());
		$s3->put($product->id.'/'.$thumbnailBackName, $thumbnailBack->__toString(), 'public');

		$smallBack = $this->makeSmallImage($backImage);
		$smallBackName = 's_back_'.md5($backName . time());
		$s3->put($product->id.'/'.$smallBackName, $smallBack->__toString(), 'public');
		
		$mediumBack = $this->makeMediumImage($backImage);
		$mediumBackName = 'm_back_'.md5($backName . time());
		$s3->put($product->id.'/'.$mediumBackName, $mediumBack->__toString(), 'public');
		
		$largeBack = $this->makeLargeImage($backImage);
		$largeBackName = 'l_back_'.md5($backName . time());
		$s3->put($product->id.'/'.$largeBackName, $largeBack->__toString(), 'public');

		$product->frontImage()->create([
			'product_id' => $product->id,
			'small_path' => env('AWS_URL').$product->id.'/'.$smallFrontName,
			'medium_path' => env('AWS_URL').$product->id.'/'.$mediumFrontName,
			'large_path' => env('AWS_URL').$product->id.'/'.$largeFrontName,
			'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailFrontName,
		]);

		$product->backImage()->create([
			'product_id' => $product->id,
			'small_path' => env('AWS_URL').$product->id.'/'.$smallBackName,
			'medium_path' => env('AWS_URL').$product->id.'/'.$mediumBackName,
			'large_path' => env('AWS_URL').$product->id.'/'.$largeBackName,
			'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailBackName,
		]);

		return $product;
	}

	public function storeAdditionalImages(Request $request){
		$product = Product::findOrFail($request->id);
		$s3 = Storage::disk('s3');
		if($request->has('levelImages')){
			$levelImages = $request->levelImages;

			foreach ($levelImages as $levelImage){
				$levelName = $levelImage->getClientOriginalName();

				$thumbnailLevel = $this->makeThumbnailImage($levelImage);
				$thumbnailLevelName = 'th_level_'.md5($levelName . time());
				$s3->put($product->id.'/'.$thumbnailLevelName, $thumbnailLevel->__toString(), 'public');

				$smallLevel = $this->makeSmallImage($levelImage);
				$smallLevelName = 's_level_'.md5($levelName . time());
				$s3->put($product->id.'/'.$smallLevelName, $smallLevel->__toString(), 'public');

				$mediumLevel = $this->makeMediumImage($levelImage);
				$mediumLevelName = 'm_level_'.md5($levelName . time());
				$s3->put($product->id.'/'.$mediumLevelName, $mediumLevel->__toString(), 'public');

				$largeLevel = $this->makeLargeImage($levelImage);
				$largeLevelName = 'l_level_'.md5($levelName . time());
				$s3->put($product->id.'/'.$largeLevelName, $largeLevel->__toString(), 'public');

				$product->levelImages()->create([
					'product_id' => $product->id,
					'small_path' => env('AWS_URL').$product->id.'/'.$smallLevelName,
					'medium_path' => env('AWS_URL').$product->id.'/'.$mediumLevelName,
					'large_path' => env('AWS_URL').$product->id.'/'.$largeLevelName,
					'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailLevelName,
				]);
			}
		}
		if($request->has('loaImages')){
			$loaImages = $request->loaImages;

			foreach ($loaImages as $loaImage){
				$loaName = $loaImage->getClientOriginalName();

				$thumbnailLoa = $this->makeThumbnailImage($loaImage);
				$thumbnailLoaName = 'th_loa_'.md5($loaName . time());
				$s3->put($product->id.'/'.$thumbnailLoaName, $thumbnailLoa->__toString(), 'public');

				$smallLoa = $this->makeSmallImage($loaImage);
				$smallLoaName = 's_loa_'.md5($loaName . time());
				$s3->put($product->id.'/'.$smallLoaName, $smallLoa->__toString(), 'public');

				$mediumLoa = $this->makeMediumImage($loaImage);
				$mediumLoaName = 'm_loa_'.md5($loaName . time());
				$s3->put($product->id.'/'.$mediumLoaName, $mediumLoa->__toString(), 'public');

				$largeLoa = $this->makeLargeImage($loaImage);
				$largeLoaName = 'l_loa_'.md5($loaName . time());
				$s3->put($product->id.'/'.$largeLoaName, $largeLoa->__toString(), 'public');

				$product->loaImages()->create([
					'product_id' => $product->id,
					'small_path' => env('AWS_URL').$product->id.'/'.$smallLoaName,
					'medium_path' => env('AWS_URL').$product->id.'/'.$mediumLoaName,
					'large_path' => env('AWS_URL').$product->id.'/'.$largeLoaName,
					'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailLoaName,
				]);
			}
		}
		return $product;
	}

	public function storeOtherImages(Request $request){
		$product = Product::findOrFail($request->id);
		$s3 = Storage::disk('s3');
		if($request->has('otherImages')){
			$otherImages = $request->otherImages;

			foreach ($otherImages as $otherImage){
				$otherName = $otherImage->getClientOriginalName();

				$thumbnailOther = $this->makeThumbnailImage($otherImage);
				$thumbnailOtherName = 'th_other_'.md5($otherName . time());
				$s3->put($product->id.'/'.$thumbnailOtherName, $thumbnailOther->__toString(), 'public');

				$smallOther = $this->makeSmallImage($otherImage);
				$smallOtherName = 's_other_'.md5($otherName . time());
				$s3->put($product->id.'/'.$smallOtherName, $smallOther->__toString(), 'public');

				$mediumOther = $this->makeMediumImage($otherImage);
				$mediumOtherName = 'm_other_'.md5($otherName . time());
				$s3->put($product->id.'/'.$mediumOtherName, $mediumOther->__toString(), 'public');

				$largeOther = $this->makeLargeImage($otherImage);
				$largeOtherName = 'l_other_'.md5($otherName . time());
				$s3->put($product->id.'/'.$largeOtherName, $largeOther->__toString(), 'public');

				$product->otherImages()->create([
					'product_id' => $product->id,
					'small_path' => env('AWS_URL').$product->id.'/'.$smallOtherName,
					'medium_path' => env('AWS_URL').$product->id.'/'.$mediumOtherName,
					'large_path' => env('AWS_URL').$product->id.'/'.$largeOtherName,
					'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailOtherName,
				]);
			}
		}
		return $product;
	}

	public function makeThumbnailImage($image){
		return Image::make($image)
		->fit(100, 100)
		->encode('jpg', 75)
		->stream();
	}

	public function makeSmallImage($image){
		$width = 240;
		$height = $width * Image::make($image)->height() / Image::make($image)->width();
		return Image::make($image)
		->fit($width, intval($height))
		->encode('jpg', 75)
		->stream();
	}

	public function makeMediumImage($image){
		$width = 480;
		$height = $width * Image::make($image)->height() / Image::make($image)->width();
		return Image::make($image)
		->fit($width, intval($height))
		->encode('jpg', 75)
		->stream();
	}

	public function makeLargeImage($image){
		$width = 960;
		$height = $width * Image::make($image)->height() / Image::make($image)->width();
		return Image::make($image)
		->fit($width, intval($height))
		->encode('jpg', 90)
		->stream();
	}

}
