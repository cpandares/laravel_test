<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    // INDICAR LA TABLA DE DB
    protected $table = 'images';

    //Relaciones onetoamany

    public function comments(){
        return $this->hasMany('App\Comment')->orderBy('id','desc');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    //Relacion de muchos a uno (Muchas imagennes tienen un solo usuario)
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
