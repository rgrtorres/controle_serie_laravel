<?php

use Illuminate\Support\Facades\Auth;

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

Route::get('/', function(){
    return "Página restrita!";
});

Route::get('/series', 'SeriesController@index')->name('listar_series');
Route::get('/series/adicionar', 'SeriesController@create')->name('form_add_serie')->middleware('autenticador');
Route::post('/series/adicionar', 'SeriesController@store')->middleware('autenticador');
Route::delete('/series/remover/{id}', 'SeriesController@destroy')->middleware('autenticador');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome')->middleware('autenticador');
Route::get('/series/{serieId}/temporadas', 'TemporadasController@index');

Route::get('/series/temporadas/{serieId}/{temporada}/episodios', 'EpisodiosController@index')->name('listar_epidosios');
Route::post('/series/temporadas/{serieId}/{temporada}/episodios/assistir', 'EpisodiosController@assistir')->middleware('autenticador');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/usuario/logar', 'EntrarController@index');
Route::post('/usuario/logar', 'EntrarController@entrar')->name('usuario_logar');
Route::get('/usuario/registre-se', 'RegistroController@create')->name('usuario_registrar');
Route::post('/usuario/registre-se', 'RegistroController@store');
Auth::routes();
Route::get('/usuario/sair', function(){
    Auth::logout();
    return redirect()->route('usuario_logar');
});


Route::get('/buscarSeriesEmJson', function(){
    return \App\Serie::all();
});
