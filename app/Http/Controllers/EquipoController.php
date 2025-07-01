<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Nacionalidad;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $listaEquipos = Equipo::with('nacionalidad')->get();
       $nacionalidades = Nacionalidad::all();
     return view('equipo.index', compact('listaEquipos', 'nacionalidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $datosEquipo = new Equipo();

    $datosEquipo->nombreEquipo = $request->get('nombreEquipo');
    $datosEquipo->fechaCreacion = $request->get('fechaCreacion');
    $datosEquipo->codigoNacionalidad = $request->get('codigoNacionalidad');
    $datosEquipo->save();

    return redirect('/equipo');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $equipo = Equipo::find($id);
     $equipo->nombreEquipo = $request->get('nombreEquipoU');
      $equipo->fechaCreacion = $request->get('fechaCreacionU');
    $equipo->codigoNacionalidad = $request->get('codigoNacionalidadU');
     $equipo->save();

    return redirect('/equipo');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $equipo=Equipo::find($id);
    $equipo->delete();
    return redirect('/equipo');
    }
}
