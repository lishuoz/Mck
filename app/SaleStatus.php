<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleStatus extends Model
{
	protected $fillable = [
		'forSale', 'tradeMethod', 'quotedMethod', 'price', 'status'
	];

	public function product(){
		return $this->belongsTo('App\Product');
	}
}
