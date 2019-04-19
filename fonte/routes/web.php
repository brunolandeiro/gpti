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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'prefix' => 'cliente',
], function(){
    Route::get('/', 'ClienteController@index')->name('cliente');
    Route::get('/{id}', 'ClienteController@get')->name('get_cliente');
    Route::post('/cadastrar', 'ClienteController@cadastrar')->name('cliente_cadastrar');
});
