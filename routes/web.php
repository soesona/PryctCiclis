<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

  Route::resource('/nacionalidad','App\Http\Controllers\NacionalidadController');
  Route::resource('/ciclista','App\Http\Controllers\CiclistaController');
  Route::resource('/equipo','App\Http\Controllers\EquipoController');
  Route::resource('/nombrepruebas','App\Http\Controllers\NombresPruebasController');