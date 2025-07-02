<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prueba;
use App\Models\NombresPruebas;
use App\Models\Ciclista;

class PruebaController extends Controller
{
    public function index()
    {
        $listaPruebas = Prueba::with('nombrePrueba', 'ciclista')->get();
        $nombresPruebas = NombresPruebas::all();
        $ciclistas = Ciclista::all();
        return view('prueba.index', compact('listaPruebas', 'nombresPruebas', 'ciclistas'));
    }

    public function create()
    {
        // No utilizado
    }

    public function store(Request $request)
    {
        $datosPrueba = new Prueba();
        $datosPrueba->codigoNombrePrueba = $request->get('codigoNombrePrueba');
        $datosPrueba->anioEdicion = $request->get('anioEdicion');
        $datosPrueba->numEtapas = $request->get('numEtapas');
        $datosPrueba->kilometrosTotales = $request->get('kilometrosTotales');
        $datosPrueba->idCiclista = $request->get('idCiclista');
        $datosPrueba->save();

        return redirect('/prueba');
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request, string $id)
    {
        $datosPrueba = Prueba::find($id);
        $datosPrueba->codigoNombrePrueba = $request->get('codigoNombrePrueba');
        $datosPrueba->anioEdicion = $request->get('anioEdicion');
        $datosPrueba->numEtapas = $request->get('numEtapas');
        $datosPrueba->kilometrosTotales = $request->get('kilometrosTotales');
        $datosPrueba->idCiclista = $request->get('idCiclista');
        $datosPrueba->save();

        return redirect('/prueba');
    }

    public function destroy(string $id)
    {
        $prueba = Prueba::find($id);
        $prueba->delete();

        return redirect('/prueba');
    }
}
