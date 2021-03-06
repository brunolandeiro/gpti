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
Route::get('/perfil', 'HomeController@perfil')->name('perfil');
Route::get('/help', 'HomeController@help')->name('help');
Route::get('/backup', 'HomeController@backup')->name('backup');
Route::get('/auditoria', 'HomeController@auditoria')->name('auditoria');

Route::group([
    'prefix' => 'cliente',
], function(){
    Route::get('/{id?}/{showForm?}', 'ClienteController@index')->name('cliente');
    Route::post('/cadastrar', 'ClienteController@cadastrar')->name('cliente_cadastrar');
    Route::get('/delete/cliente/{id}', 'ClienteController@delete')->name('cliente_delete');
});

Route::group([
    'prefix' => 'area',
], function(){
    Route::get('/{id?}/{showForm?}', 'AreaController@index')->name('area');
    Route::post('/cadastrar', 'AreaController@cadastrar')->name('area_cadastrar');
    Route::get('/delete/area/{id}', 'AreaController@delete')->name('area_delete');
});

Route::group([
    'prefix' => 'processo',
], function(){
    Route::get('/{id?}/{showForm?}', 'ProcessoController@index')->name('processo');
    Route::post('/cadastrar', 'ProcessoController@cadastrar')->name('processo_cadastrar');
    Route::get('/delete/processo/{id}', 'ProcessoController@delete')->name('processo_delete');
});

Route::group([
    'prefix' => 'etapa',
], function(){
    Route::get('/{id?}/{showForm?}', 'EtapaController@index')->name('etapa');
    Route::post('/cadastrar', 'EtapaController@cadastrar')->name('etapa_cadastrar');
    Route::get('/delete/etapa/{id}', 'EtapaController@delete')->name('etapa_delete');
});

Route::group([
    'prefix' => 'efs',
], function(){
    Route::get('/{id?}/{showForm?}', 'EfsController@index')->name('efs');
    Route::post('/cadastrar', 'EfsController@cadastrar')->name('efs_cadastrar');
    Route::get('/delete/efs/{id}', 'EfsController@delete')->name('efs_delete');
});

Route::group([
    'prefix' => 'efs_etapa',
], function(){
    Route::get('/{cod_efs?}/{cod_etapa?}/{showForm?}', 'EfsEtapaController@index')->name('efs_etapa');
    Route::post('/cadastrar', 'EfsEtapaController@cadastrar')->name('efs_etapa_cadastrar');
    Route::get('/delete/efs_etapa/{cod_efs}/{cod_etapa}', 'EfsEtapaController@delete')->name('efs_etapa_delete');
});

Route::group([
    'prefix' => 'projeto',
], function(){
    Route::get('/{id?}/{showForm?}', 'ProjetoController@index')->name('projeto');
    Route::post('/cadastrar', 'ProjetoController@cadastrar')->name('projeto_cadastrar');
    Route::get('/delete/projeto/{id}', 'ProjetoController@delete')->name('projeto_delete');
});

Route::group([
    'prefix' => 'fase',
], function(){
    Route::get('/{id?}/{showForm?}', 'FaseController@index')->name('fase');
    Route::post('/cadastrar', 'FaseController@cadastrar')->name('fase_cadastrar');
    Route::get('/delete/fase/{id}', 'FaseController@delete')->name('fase_delete');
});

Route::group([
    'prefix' => 'relatorio',
], function(){
    Route::get('/area_etapa_processo', 'RelatorioController@areaEtapaProcesso')->name('area_etapa_processo');
    Route::get('/efs_etapa', 'RelatorioController@etapaEfs')->name('ralatorio_efs_etapa');
    Route::get('/area_etapa_processo_efs', 'RelatorioController@areaEtapaProcessoEfs')->name('area_etapa_processo_efs');

});
