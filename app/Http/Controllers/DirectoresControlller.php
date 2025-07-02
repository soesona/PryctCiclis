<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Directores;
use App\Models\Nacionalidad;

class DirectoresControlller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    $listaDirectores = Directores::with('nacionalidad')->get();
    $nacionalidades = Nacionalidad::all();
    return view('director.index', compact('listaDirectores', 'nacionalidades'));
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
        //
    $datosDirectores = new Directores();
    $datosDirectores->codigoDirector = $request->get('codigoDirector');
    $datosDirectores->nombre = $request->get('nombre');
    $datosDirectores->apellido = $request->get('apellido');
    $datosDirectores->fechaNacimiento = $request->get('fechaNacimiento');
    $datosDirectores->codigoNacionalidad = $request->get('codigoNacionalidad');

    if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {

    if ($datosDirectores->imagen && \Storage::disk('public')->exists($datosDirectores->imagen)) {
        \Storage::disk('public')->delete($datosDirectores->imagen);
    }


    $rutaImagen = $request->file('imagen')->store('directores', 'public');
    $datosDirectores->imagen = $rutaImagen;
}
    $datosDirectores->save();
    return redirect('/director');
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
        //
        $datosDirectores = Directores::find($id);

    $datosDirectores->nombre = $request->get('nombre');
    $datosDirectores->apellido = $request->get('apellido');
    $datosDirectores->fechaNacimiento = $request->get('fechaNacimiento');
    $datosDirectores->codigoNacionalidad = $request->get('codigoNacionalidad');


    if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
    if ($datosDirectores->imagen && \Storage::disk('public')->exists($datosDirectores->imagen)) {
        \Storage::disk('public')->delete($datosDirectores->imagen);
    }

    $rutaImagen = $request->file('imagen')->store('directores', 'public');
    $datosDirectores->imagen = $rutaImagen;
}
    $datosDirectores->save();

    return redirect('/director');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    $director = Directores::find($id);
    $director->delete(); 

    return redirect('/director');
    }
}