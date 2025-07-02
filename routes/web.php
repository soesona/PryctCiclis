<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('indexglobal');
});

  Route::resource('/nacionalidad','App\Http\Controllers\NacionalidadController');
  Route::resource('/ciclista','App\Http\Controllers\CiclistaController');
  Route::resource('/equipo','App\Http\Controllers\EquipoController');
  Route::resource('/nombrepruebas','App\Http\Controllers\NombresPruebasController');

  Route::get('/ciclistaContrato/{codigoCiclista}', 'App\Http\Controllers\ContratoCiclistasController@showContratoCiclista')->name('ciclistaContrato');
  Route::resource('/contratoCiclistas', 'App\Http\Controllers\ContratoCiclistasController');
  Route::resource('/director','App\Http\Controllers\DirectoresControlller');
  Route::resource('/prueba','App\Http\Controllers\PruebaController');
  Route::get('/directorContrato/{codigoDirector}', 'App\Http\Controllers\ContratoDirectorController@showContratoDirector')->name('directorContrato');
  Route::resource('/contratoDirectores', 'App\Http\Controllers\ContratoDirectorController');
  Route::get('/participacionesequipos/{codigoEquipo}', 'App\Http\Controllers\ParticipacionesEquiposController@index')->name('participaciones.index');
  Route::post('/participacionesequipos', 'App\Http\Controllers\ParticipacionesEquiposController@store')->name('participacionesequipos.store');
  Route::put('/participacionesequipos/{id}', 'App\Http\Controllers\ParticipacionesEquiposController@update')->name('participacionesequipos.update');
  Route::delete('/participacionesequipos/{id}', 'App\Http\Controllers\ParticipacionesEquiposController@destroy')->name('participacionesequipos.destroy');

