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
    Route::get('/{id?}/{showForm?}', 'ClienteController@index')->name('cliente');
    Route::post('/cadastrar', 'ClienteController@cadastrar')->name('cliente_cadastrar');
    Route::get('/delete/cliente/{id}', 'ClienteController@delete')->name('delete');
});

Route::group([
    'prefix' => 'area',
], function(){
    Route::get('/{id?}/{showForm?}', 'AreaController@index')->name('area');
    Route::post('/cadastrar', 'AreaController@cadastrar')->name('area_cadastrar');
    Route::get('/delete/area/{id}', 'AreaController@delete')->name('delete');
});

Route::group([
    'prefix' => 'processo',
], function(){
    Route::get('/{id?}/{showForm?}', 'ProcessoController@index')->name('processo');
    Route::post('/cadastrar', 'ProcessoController@cadastrar')->name('processo_cadastrar');
    Route::get('/delete/processo/{id}', 'ProcessoController@delete')->name('delete');
});
