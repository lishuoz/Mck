<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function productImages(){
        return $this->hasManyThrough('App\ProductImage', 'App\Product', 'user_id', 'product_id', 'id');
    }

    public function profile(){
        return $this->hasOne('App\Profile');
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
}
