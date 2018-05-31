<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	public function user(){
		return $this->belongsTo('App\User');
	}
	
    public function players(){
		return $this->belongsToMany('App\Player');
    }

    public function team(){
    	return $this->belongsTo('App\Team');
    }

    public function seasons(){
        return $this->belongsToMany('App\Season');
    }

    public function edition(){
        return $this->belongsTo('App\Edition');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function sizes(){
        return $this->belongsToMany('App\Size');
    }

    public function items(){
    	return $this->belongsToMany('App\Item');
    }

    public function loas(){
        return $this->belongsToMany('App\Loa');
    }

    public function frontImage(){
        return $this->hasOne('App\FrontImage');
    }

    public function backImage(){
        return $this->hasOne('App\BackImage');
    }

    public function levelImages(){
        return $this->hasMany('App\LevelImage');        
    }

    public function loaImages(){
        return $this->hasMany('App\LoaImage');        
    }

    public function otherImages(){
        return $this->hasMany('App\OtherImage');        
    }

    public function saleStatus(){
        return $this->hasOne('App\SaleStatus');
    }
    
    public static function withAllRelations() {
        return static::with('frontImage', 'backImage', 'levelImages', 'loaImages', 'otherImages');
    }

}
