<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //Señalo la tabla con la que va a interactuar
    protected $table = 'likes';

    //Relacion de muchos a uno (Un usuario tiene muchis likes)

     //Relacion de muchos a uno
     public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function image(){
        return $this->belongsTo('App\Image', 'image_id');
    }
}

