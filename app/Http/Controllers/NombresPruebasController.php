<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NombresPruebas; 

class NombresPruebasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nombresPruebas=NombresPruebas::all();
       return view('nombreprueba.index')->with('listaNombresPruebas', $nombresPruebas);
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
        $nombre = new NombresPruebas();
        $nombre->nombrePrueba = $request->get('nombrePrueba');
        $nombre->save();

        return redirect('/nombrepruebas');
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
       $nombre = NombresPruebas::find($id);
        $nombre->nombrePrueba = $request->get('nombrePrueba');
        $nombre->save();

        return redirect('/nombrepruebas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $nombre = NombresPruebas::find($id);
        $nombre->delete();

        return redirect('/nombrepruebas');
    }
}
