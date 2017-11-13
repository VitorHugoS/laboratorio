<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::get('/', 'HomeController@index');

Route::get('/admin', 'HomeController@adminLogar');
Route::get('/admin/login', 'HomeController@adminLogar');
Route::get('/admin/pedidos', 'HomeController@pedidos');
Route::get('/admin/registrar', 'HomeController@novoCliente');
Route::post('/admin/novoCliente', 'HomeController@registrar');
Route::get('/admin/clientes', 'HomeController@clientes');

Route::get('/admin/download/{hash}', 'HomeController@downloadPedido');
Route::get('/admin/ordem/{hash}', 'HomeController@ordem');


Route::get('/home', 'HomeController@index');
Route::get('/criarprojeto', 'HomeController@novoprojeto');
Route::get('/buscaTamanhos/{id}', ['uses'=>'HomeController@buscaTamanhos']);
Route::get('/buscaCapas/{id}', ['uses'=>'HomeController@buscaCapas']);
Route::get('/criarLamina', 'HomeController@criarLamina');


Route::post('/criarProjeto', 'HomeController@criaProjeto');
Route::post('/deletarProjeto', 'HomeController@deletarProjeto');


Route::get('/projetos', 'HomeController@projetos');
Route::get('/projeto/{hash}/{lam}', 'HomeController@projetoContinuar');
Route::get('/projeto/{hash}/', 'HomeController@projetoContinuar');


Route::post('/novaLamina/{id}/{lamina}', 'HomeController@novaLamina');

Route::post('/uploadImagem', 'HomeController@uplodImagem');
Route::post('/atualizaLamina', 'HomeController@atualizaLamina');
Route::post('/atualizaBackgroundPosition', 'HomeController@atualizaBackgroundPosition');
Route::post('/atualizaZoom', 'HomeController@atualizaZoom');

Route::post('/atualizaLayout', 'HomeController@atualizaValor');


Route::any('/finalizarAlbum/{id}', 'HomeController@finalizarAlbum');
Route::any('/revisarPedido/{hash}', 'HomeController@revisarPedido');
