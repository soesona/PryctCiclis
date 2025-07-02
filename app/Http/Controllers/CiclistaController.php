<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclista;
use App\Models\Nacionalidad;

class CiclistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
    $listaCiclistas = Ciclista::with('nacionalidad')->get();
    $nacionalidades = Nacionalidad::all();
    return view('ciclista.index', compact('listaCiclistas', 'nacionalidades'));
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
    $datosCiclista = new Ciclista();
    $datosCiclista->codigoCiclista = $request->get('codigoCiclista');
    $datosCiclista->nombre = $request->get('nombre');
    $datosCiclista->apellido = $request->get('apellido');
    $datosCiclista->fechaNacimiento = $request->get('fechaNacimiento');
    $datosCiclista->codigoNacionalidad = $request->get('codigoNacionalidad');

    if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {

    if ($datosCiclista->imagen && \Storage::disk('public')->exists($datosCiclista->imagen)) {
        \Storage::disk('public')->delete($datosCiclista->imagen);
    }


    $rutaImagen = $request->file('imagen')->store('ciclistas', 'public');
    $datosCiclista->imagen = $rutaImagen;
}
    $datosCiclista->save();
    return redirect('/ciclista');
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
    $datosCiclista = Ciclista::find($id);

    $datosCiclista->nombre = $request->get('nombre');
    $datosCiclista->apellido = $request->get('apellido');
    $datosCiclista->fechaNacimiento = $request->get('fechaNacimiento');
    $datosCiclista->codigoNacionalidad = $request->get('codigoNacionalidad');


    if ($request->hasFile('imagen') && $request->file('imagen')->isValid()) {
    if ($datosCiclista->imagen && \Storage::disk('public')->exists($datosCiclista->imagen)) {
        \Storage::disk('public')->delete($datosCiclista->imagen);
    }

    $rutaImagen = $request->file('imagen')->store('ciclistas', 'public');
    $datosCiclista->imagen = $rutaImagen;
}
    $datosCiclista->save();

    return redirect('/ciclista');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $ciclista = Ciclista::find($id);
    $ciclista->delete(); 

    return redirect('/ciclista'); 
    }
}
