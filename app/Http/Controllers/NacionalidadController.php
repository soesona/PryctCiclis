<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nacionalidad;

class NacionalidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $nacionalidades=Nacionalidad::all();
       return view('nacionalidad.index')->with('listaNacionalidades', $nacionalidades);

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
    $datosNacionalidad = new Nacionalidad();
    $datosNacionalidad->nombreNacionalidad = $request->get('nombreNacionalidad');
    $datosNacionalidad->save();

    return redirect('/nacionalidad');
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
    $nacionalidad= Nacionalidad::find($id);
    $nacionalidad->nombreNacionalidad = $request->get('nombreNacionalidadu');
    $nacionalidad->save();

    return redirect('/nacionalidad');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $nacionalidad = Nacionalidad::find($id);
    $nacionalidad->delete();
    return redirect('/nacionalidad');
    }
}
