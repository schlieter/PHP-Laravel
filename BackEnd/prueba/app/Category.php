<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";

    protected $fillable= ['name'];//DATOS QUE QUIERO QUE TRAIGA PARA MOSTRAR DE LOS OBJ 

    public function articles(){//PLURAL PORQUE VARIOS ARTICULOS PUEDEN PERTENECER A UNA CATEGORIA
    	return $this->hasMany('App\Article');

    }
}
