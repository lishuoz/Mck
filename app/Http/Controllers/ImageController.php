<?php

namespace App\Http\Controllers;

use Image; 
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
	public function storeFrontImage(Request $request, $id){
		$s3 = Storage::disk('s3');
		$product = Product::findOrFail($id);

		$frontImage = $request->file;
		$frontName = md5($frontImage->getClientOriginalName() . time());

		$thumbnailFront = $this->makeThumbnailImage($frontImage);
		$thumbnailFrontName = 'th_front_'.$frontName;
		$s3->put($product->id.'/frontImage/'.$thumbnailFrontName, $thumbnailFront->__toString(), 'public');
		
		$smallFront = $this->makeSmallImage($frontImage);
		$smallFrontName = 's_front_'.$frontName;
		$s3->put($product->id.'/frontImage/'.$smallFrontName, $smallFront->__toString(), 'public');
		
		$mediumFront = $this->makeMediumImage($frontImage);
		$mediumFrontName = 'm_front_'.$frontName;
		$s3->put($product->id.'/frontImage/'.$mediumFrontName, $mediumFront->__toString(), 'public');
		
		$largeFront = $this->makeLargeImage($frontImage);
		$largeFrontName = 'l_front_'.$frontName;
		$s3->put($product->id.'/frontImage/'.$largeFrontName, $largeFront->__toString(), 'public');

		$product->frontImage()->create([
			'product_id' => $product->id,
			'name' => $frontName,
			'small_path' => env('AWS_URL').$product->id.'/frontImage/'.$smallFrontName,
			'medium_path' => env('AWS_URL').$product->id.'/frontImage/'.$mediumFrontName,
			'large_path' => env('AWS_URL').$product->id.'/frontImage/'.$largeFrontName,
			'thumbnail_path' => env('AWS_URL').$product->id.'/frontImage/'.$thumbnailFrontName,
		]);
		return $product::withAllRelations()->find($id);
	}

	public function deleteFrontImage($id){
		$product = Product::findOrFail($id);
		Storage::disk('s3')->deleteDirectory($id . '/frontImage');
		$product->frontImage()->delete();
		return $product::withAllRelations()->find($id);
	}


	public function storeBackImage(Request $request, $id){
		$s3 = Storage::disk('s3');
		$product = Product::findOrFail($id);

		$backImage = $request->file;
		$backName = md5($backImage->getClientOriginalName() . time());

		$thumbnailBack = $this->makeThumbnailImage($backImage);
		$thumbnailBackName = 'th_back_'.$backName;
		
		$smallBack = $this->makeSmallImage($backImage);
		$smallBackName = 's_back_'.$backName;
		
		$mediumBack = $this->makeMediumImage($backImage);
		$mediumBackName = 'm_back_'.$backName;
		
		$largeBack = $this->makeLargeImage($backImage);
		$largeBackName = 'l_back_'.$backName;

		$s3->put($product->id.'/backImage/'.$thumbnailBackName, $thumbnailBack->__toString(), 'public');
		$s3->put($product->id.'/backImage/'.$smallBackName, $smallBack->__toString(), 'public');
		$s3->put($product->id.'/backImage/'.$mediumBackName, $mediumBack->__toString(), 'public');
		$s3->put($product->id.'/backImage/'.$largeBackName, $largeBack->__toString(), 'public');

		$product->backImage()->create([
			'product_id' => $product->id,
			'name' => $backName,
			'small_path' => env('AWS_URL').$product->id.'/backImage/'.$smallBackName,
			'medium_path' => env('AWS_URL').$product->id.'/backImage/'.$mediumBackName,
			'large_path' => env('AWS_URL').$product->id.'/backImage/'.$largeBackName,
			'thumbnail_path' => env('AWS_URL').$product->id.'/backImage/'.$thumbnailBackName,
		]);
		return $product::withAllRelations()->find($id);
	}

	public function deleteBackImage($id){
		$product = Product::findOrFail($id);
		Storage::disk('s3')->deleteDirectory($id . '/backImage');
		$product->backImage()->delete();
		return $product::withAllRelations()->find($id);
	}

	public function storeLevelImages(Request $request, $id){
		$s3 = Storage::disk('s3');
		$product = Product::findOrFail($id);
		$levelImages = $request->file;
		foreach($levelImages as $levelImage){
			$levelName = md5($levelImage->getClientOriginalName() . time());

			$thumbnailLevel = $this->makeThumbnailImage($levelImage);
			$thumbnailLevelName = 'th_level_'.$levelName;

			$smallLevel = $this->makeSmallImage($levelImage);
			$smallLevelName = 's_level_'.$levelName;

			$mediumLevel = $this->makeMediumImage($levelImage);
			$mediumLevelName = 'm_level_'.$levelName;

			$largeLevel = $this->makeLargeImage($levelImage);
			$largeLevelName = 'l_level_'.$levelName;

			$s3->put($product->id.'/levelImages/'.$levelName.'/'.$thumbnailLevelName, $thumbnailLevel->__toString(), 'public');
			$s3->put($product->id.'/levelImages/'.$levelName.'/'.$smallLevelName, $smallLevel->__toString(), 'public');
			$s3->put($product->id.'/levelImages/'.$levelName.'/'.$mediumLevelName, $mediumLevel->__toString(), 'public');
			$s3->put($product->id.'/levelImages/'.$levelName.'/'.$largeLevelName, $largeLevel->__toString(), 'public');

			$product->levelImages()->create([
				'product_id' => $product->id,
				'name' => $levelName,
				'small_path' => env('AWS_URL').$product->id.'/levelImages/'.$levelName.'/'.$smallLevelName,
				'medium_path' => env('AWS_URL').$product->id.'/levelImages/'.$levelName.'/'.$mediumLevelName,
				'large_path' => env('AWS_URL').$product->id.'/levelImages/'.$levelName.'/'.$largeLevelName,
				'thumbnail_path' => env('AWS_URL').$product->id.'/levelImages/'.$levelName.'/'.$thumbnailLevelName,
			]);
		}
		return $product::withAllRelations()->find($id);
	}

	public function deleteLevelImage($id, $fileName){
		$product = Product::findOrFail($id);
		Storage::disk('s3')->deleteDirectory($id . '/levelImages/'.$fileName);
		$product->levelImages()->where('name', $fileName)->delete();
		return $product::withAllRelations()->find($id);
	}

	public function storeLoaImages(Request $request, $id){
		$s3 = Storage::disk('s3');
		$product = Product::findOrFail($id);
		$loaImages = $request->file;
		foreach($loaImages as $loaImage){
			$loaName = md5($loaImage->getClientOriginalName() . time());

			$thumbnailLoa = $this->makeThumbnailImage($loaImage);
			$thumbnailLoaName = 'th_loa_'.$loaName;

			$smallLoa = $this->makeSmallImage($loaImage);
			$smallLoaName = 's_loa_'.$loaName;

			$mediumLoa = $this->makeMediumImage($loaImage);
			$mediumLoaName = 'm_loa_'.$loaName;

			$largeLoa = $this->makeLargeImage($loaImage);
			$largeLoaName = 'l_loa_'.$loaName;

			$s3->put($product->id.'/loaImages/'.$loaName.'/'.$thumbnailLoaName, $thumbnailLoa->__toString(), 'public');
			$s3->put($product->id.'/loaImages/'.$loaName.'/'.$smallLoaName, $smallLoa->__toString(), 'public');
			$s3->put($product->id.'/loaImages/'.$loaName.'/'.$mediumLoaName, $mediumLoa->__toString(), 'public');
			$s3->put($product->id.'/loaImages/'.$loaName.'/'.$largeLoaName, $largeLoa->__toString(), 'public');

			$product->loaImages()->create([
				'product_id' => $product->id,
				'name' => $loaName,
				'small_path' => env('AWS_URL').$product->id.'/loaImages/'.$loaName.'/'.$smallLoaName,
				'medium_path' => env('AWS_URL').$product->id.'/loaImages/'.$loaName.'/'.$mediumLoaName,
				'large_path' => env('AWS_URL').$product->id.'/loaImages/'.$loaName.'/'.$largeLoaName,
				'thumbnail_path' => env('AWS_URL').$product->id.'/loaImages/'.$loaName.'/'.$thumbnailLoaName,
			]);
		}
		return $product::withAllRelations()->find($id);
	}

	public function deleteLoaImage($id, $fileName){
		$product = Product::findOrFail($id);
		Storage::disk('s3')->deleteDirectory($id . '/loaImages/'.$fileName);
		$product->loaImages()->where('name', $fileName)->delete();
		return $product::withAllRelations()->find($id);
	}

	public function storeOtherImages(Request $request, $id){
		$s3 = Storage::disk('s3');
		$product = Product::findOrFail($id);
		$otherImages = $request->file;
		foreach($otherImages as $otherImage){
			$otherName = md5($otherImage->getClientOriginalName() . time());

			$thumbnailOther = $this->makeThumbnailImage($otherImage);
			$thumbnailOtherName = 'th_other_'.$otherName;

			$smallOther = $this->makeSmallImage($otherImage);
			$smallOtherName = 's_other_'.$otherName;

			$mediumOther = $this->makeMediumImage($otherImage);
			$mediumOtherName = 'm_other_'.$otherName;

			$largeOther = $this->makeLargeImage($otherImage);
			$largeOtherName = 'l_other_'.$otherName;

			$s3->put($product->id.'/otherImages/'.$otherName.'/'.$thumbnailOtherName, $thumbnailOther->__toString(), 'public');
			$s3->put($product->id.'/otherImages/'.$otherName.'/'.$smallOtherName, $smallOther->__toString(), 'public');
			$s3->put($product->id.'/otherImages/'.$otherName.'/'.$mediumOtherName, $mediumOther->__toString(), 'public');
			$s3->put($product->id.'/otherImages/'.$otherName.'/'.$largeOtherName, $largeOther->__toString(), 'public');

			$product->otherImages()->create([
				'product_id' => $product->id,
				'name' => $otherName,
				'small_path' => env('AWS_URL').$product->id.'/otherImages/'.$otherName.'/'.$smallOtherName,
				'medium_path' => env('AWS_URL').$product->id.'/otherImages/'.$otherName.'/'.$mediumOtherName,
				'large_path' => env('AWS_URL').$product->id.'/otherImages/'.$otherName.'/'.$largeOtherName,
				'thumbnail_path' => env('AWS_URL').$product->id.'/otherImages/'.$otherName.'/'.$thumbnailOtherName,
			]);
		}
		return $product::withAllRelations()->find($id);
	}

	public function deleteOtherImage($id, $fileName){
		$product = Product::findOrFail($id);
		Storage::disk('s3')->deleteDirectory($id . '/otherImages/'.$fileName);
		$product->otherImages()->where('name', $fileName)->delete();
		return $product::withAllRelations()->find($id);
	}
	// public function storeAdditionalImages(Request $request){
	// 	$product = Product::findOrFail($request->id);
	// 	$s3 = Storage::disk('s3');
	// 	if($request->has('levelImages')){
	// 		$levelImages = $request->levelImages;

	// 		foreach ($levelImages as $levelImage){
	// 			$levelName = $levelImage->getClientOriginalName();

	// 			$thumbnailLevel = $this->makeThumbnailImage($levelImage);
	// 			$thumbnailLevelName = 'th_level_'.md5($levelName . time());
	// 			$s3->put($product->id.'/'.$thumbnailLevelName, $thumbnailLevel->__toString(), 'public');

	// 			$smallLevel = $this->makeSmallImage($levelImage);
	// 			$smallLevelName = 's_level_'.md5($levelName . time());
	// 			$s3->put($product->id.'/'.$smallLevelName, $smallLevel->__toString(), 'public');

	// 			$mediumLevel = $this->makeMediumImage($levelImage);
	// 			$mediumLevelName = 'm_level_'.md5($levelName . time());
	// 			$s3->put($product->id.'/'.$mediumLevelName, $mediumLevel->__toString(), 'public');

	// 			$largeLevel = $this->makeLargeImage($levelImage);
	// 			$largeLevelName = 'l_level_'.md5($levelName . time());
	// 			$s3->put($product->id.'/'.$largeLevelName, $largeLevel->__toString(), 'public');

	// 			$product->levelImages()->create([
	// 				'product_id' => $product->id,
	// 				'small_path' => env('AWS_URL').$product->id.'/'.$smallLevelName,
	// 				'medium_path' => env('AWS_URL').$product->id.'/'.$mediumLevelName,
	// 				'large_path' => env('AWS_URL').$product->id.'/'.$largeLevelName,
	// 				'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailLevelName,
	// 			]);
	// 		}
	// 	}

	// 	if($request->has('loaImages')){
	// 		$loaImages = $request->loaImages;

	// 		foreach ($loaImages as $loaImage){
	// 			$loaName = $loaImage->getClientOriginalName();

	// 			$thumbnailLoa = $this->makeThumbnailImage($loaImage);
	// 			$thumbnailLoaName = 'th_loa_'.md5($loaName . time());
	// 			$s3->put($product->id.'/'.$thumbnailLoaName, $thumbnailLoa->__toString(), 'public');

	// 			$smallLoa = $this->makeSmallImage($loaImage);
	// 			$smallLoaName = 's_loa_'.md5($loaName . time());
	// 			$s3->put($product->id.'/'.$smallLoaName, $smallLoa->__toString(), 'public');

	// 			$mediumLoa = $this->makeMediumImage($loaImage);
	// 			$mediumLoaName = 'm_loa_'.md5($loaName . time());
	// 			$s3->put($product->id.'/'.$mediumLoaName, $mediumLoa->__toString(), 'public');

	// 			$largeLoa = $this->makeLargeImage($loaImage);
	// 			$largeLoaName = 'l_loa_'.md5($loaName . time());
	// 			$s3->put($product->id.'/'.$largeLoaName, $largeLoa->__toString(), 'public');

	// 			$product->loaImages()->create([
	// 				'product_id' => $product->id,
	// 				'small_path' => env('AWS_URL').$product->id.'/'.$smallLoaName,
	// 				'medium_path' => env('AWS_URL').$product->id.'/'.$mediumLoaName,
	// 				'large_path' => env('AWS_URL').$product->id.'/'.$largeLoaName,
	// 				'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailLoaName,
	// 			]);
	// 		}
	// 	}

	// 	return $product;
	// }

	// public function storeOtherImages(Request $request){
	// 	$product = Product::findOrFail($request->id);
	// 	$s3 = Storage::disk('s3');
	// 	if($request->has('otherImages')){
	// 		$otherImages = $request->otherImages;

	// 		foreach ($otherImages as $otherImage){
	// 			$otherName = $otherImage->getClientOriginalName();

	// 			$thumbnailOther = $this->makeThumbnailImage($otherImage);
	// 			$thumbnailOtherName = 'th_other_'.md5($otherName . time());
	// 			$s3->put($product->id.'/'.$thumbnailOtherName, $thumbnailOther->__toString(), 'public');

	// 			$smallOther = $this->makeSmallImage($otherImage);
	// 			$smallOtherName = 's_other_'.md5($otherName . time());
	// 			$s3->put($product->id.'/'.$smallOtherName, $smallOther->__toString(), 'public');

	// 			$mediumOther = $this->makeMediumImage($otherImage);
	// 			$mediumOtherName = 'm_other_'.md5($otherName . time());
	// 			$s3->put($product->id.'/'.$mediumOtherName, $mediumOther->__toString(), 'public');

	// 			$largeOther = $this->makeLargeImage($otherImage);
	// 			$largeOtherName = 'l_other_'.md5($otherName . time());
	// 			$s3->put($product->id.'/'.$largeOtherName, $largeOther->__toString(), 'public');

	// 			$product->otherImages()->create([
	// 				'product_id' => $product->id,
	// 				'small_path' => env('AWS_URL').$product->id.'/'.$smallOtherName,
	// 				'medium_path' => env('AWS_URL').$product->id.'/'.$mediumOtherName,
	// 				'large_path' => env('AWS_URL').$product->id.'/'.$largeOtherName,
	// 				'thumbnail_path' => env('AWS_URL').$product->id.'/'.$thumbnailOtherName,
	// 			]);
	// 		}
	// 	}
	// 	return $product;
	// }

	public function makeThumbnailImage($image){
		return Image::make($image)
		->fit(100, 100)
		->encode('jpg', 50)
		->stream();
	}

	public function makeSmallImage($image){
		$width = 240;
		$height = $width * Image::make($image)->height() / Image::make($image)->width();
		return Image::make($image)
		->fit($width, intval($height))
		->encode('jpg', 70)
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
		->encode('jpg', 100)
		->stream();
	}

}
