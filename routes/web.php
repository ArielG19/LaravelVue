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


Route::resource('/post','PostController');
Route::resource('/product','ProductController');

/*debemos agragar el parametro any para que al compartir nuestra rutas de vue-router carguen
 ya que si copiamos y pegamos en una nueva ventana no funcionan.
 tambien el where para comparar las rutas q tenemos con una q no exista y devolver error 404
*/
Route::get('/{any?}', function () {
    return view('welcome');
})->where('any','.*');