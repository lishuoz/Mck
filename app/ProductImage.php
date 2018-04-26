<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	protected $fillable = [
		'cover_path', 'front_path', 'thumbnail_front_path', 'back_path', 'thumbnail_back_path'
	];
}
