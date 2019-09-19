<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('articles/{nombre?}',function($nombre='no se coloco nada'){
	echo 'El nombre que has colocado es '.$nombre;
});

Route::group(['prefix' => 'grupoderutas'], function(){
	Route::get('articles/{algo?}', function($algo='Vacio'){
		echo $algo;
	});
});