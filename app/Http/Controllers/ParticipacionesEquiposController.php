<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParticipacionesEquipos;
use App\Models\Equipo;
use App\Models\Prueba;

class ParticipacionesEquiposController extends Controller
{
    public function index($codigoEquipo)
    {
        $equipo = Equipo::find($codigoEquipo);
        $listaParticipaciones = ParticipacionesEquipos::where('codigoEquipo', $codigoEquipo)->get();
        $pruebasDisponibles = Prueba::all();

        return view('participacionesequipos.index', compact('equipo', 'listaParticipaciones', 'pruebasDisponibles'));
    }

    public function store(Request $request)
    {
        $participacion = new ParticipacionesEquipos();
        $participacion->codigoEquipo = $request->codigoEquipo;
        $participacion->idPrueba = $request->codigoPrueba;
        $participacion->posicionFinal = $request->posicionFinal;
        $participacion->save();

        return redirect('/participacionesequipos/' . $request->codigoEquipo);
    }

    public function update(Request $request, $id)
    {
        $participacion = ParticipacionesEquipos::find($id);
        $participacion->idPrueba = $request->codigoPrueba; // También se corrige aquí
        $participacion->posicionFinal = $request->posicionFinal;
        $participacion->save();

        return redirect('/participacionesequipos/' . $participacion->codigoEquipo);
    }

    public function destroy($id)
    {
        $participacion = ParticipacionesEquipos::find($id);
        $codigoEquipo = $participacion->codigoEquipo;
        $participacion->delete();

        return redirect('/participacionesequipos/' . $codigoEquipo);
    }
}
