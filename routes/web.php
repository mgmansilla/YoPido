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
    return view('auth/login');
});
Route::middleware(['auth'])->group(function () {
    //Route::get('pedidos/descargar', 'PedidoController@descargar');
 //descargar los datos
 
 
 
 
 // vistas de almacen para categorias
 Route::get('yopido/categoria/index/', 'LineaController@indexWeb');
 Route::get('yopido/categoria/create/', 'LineaController@create');
 Route::post('yopido/categoria/', 'LineaController@store');
 Route::get('yopido/categoria/edit/{id}', 'LineaController@edit');
 Route::post('yopido/categoria/edit/{id}', 'LineaController@update');
 Route::delete('yopido/categoria/{id}', 'LineaController@delete');
 
 
 
 // Vista de producto
 Route::get('yopido/producto/index/', 'ProductoController@indexWeb');
 Route::get('yopido/producto/create/', 'ProductoController@create');
 Route::post('yopido/producto/', 'ProductoController@store');
 Route::delete('yopido/producto/{id}', 'ProductoController@delete');
 Route::get('yopido/producto/edit/{id}', 'ProductoController@edit');
 Route::post('yopido/producto/edit/{id}', 'ProductoController@update');
 
 
 // Vista de usuarios
 Route::get('yopido/usuario/index/', 'LoginController@index');
 Route::get('yopido/usuario/create', 'LoginController@create');
 Route::post('yopido/usuario/', 'LoginController@storeWeb');
 Route::delete('yopido/usuario/{id}', 'LoginController@delete');
 
 // Vista de los pedidos
 Route::get('yopido/pedido/index', 'PedidoController@index');
 Route::get('yopido/pedido/edit/{id}', 'PedidoController@edit');
 
 
 
 
 
 
 });
 
 
 Route::get('/logout','Auth\LoginController@logout');
 Auth::routes();