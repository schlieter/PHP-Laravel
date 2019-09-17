<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = "articles";
    protected $fillable = ['title','content','category_id','user_id'];

    public function category(){//SINGULAR PORQUE UN ARTICULO SOLO PUEDE TENER UNA CATEGORIA, SOLO EN ESTA LOGICA DE NEGOCIO
    	return $this->belongsTo('App\Category');
    }
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function images(){
    	return $this->hasMany('App\Image');	
    }
    public function tags(){
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
