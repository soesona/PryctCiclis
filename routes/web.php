<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

  Route::resource('/nacionalidad','App\Http\Controllers\NacionalidadController');
  Route::resource('/ciclista','App\Http\Controllers\CiclistaController');
  Route::resource('/equipo','App\Http\Controllers\EquipoController');
  Route::resource('/nombrepruebas','App\Http\Controllers\NombresPruebasController');

  Route::get('/ciclistaContrato/{codigoCiclista}', 'App\Http\Controllers\ContratoCiclistasController@showContratoCiclista')->name('ciclistaContrato');
  Route::resource('/contratoCiclistas', 'App\Http\Controllers\ContratoCiclistasController');
  Route::resource('/director','App\Http\Controllers\DirectoresControlller');
  Route::resource('/prueba','App\Http\Controllers\PruebaController');
