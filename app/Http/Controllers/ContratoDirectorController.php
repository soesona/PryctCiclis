<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContratoDirector;
use App\Models\Directores;
use App\Models\Equipo;

class ContratoDirectorController extends Controller
{
    //
    // Muestra los contratos de un director específico
    public function showContratoDirector($codigoDirector)
    {
        $director = Directores::where('codigoDirector', $codigoDirector)->firstOrFail();

        $contratos = ContratoDirector::where('codigoDirector', $codigoDirector)
            ->with('equipo')
            ->get();

        $equipos = Equipo::all();

        return view('contratoDirector.index', compact('director', 'contratos', 'equipos'));
    }

    // Guardar nuevo contrato
    public function store(Request $request)
    {
        $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'codigoEquipo' => 'required|exists:equipos,codigoEquipo',
            'codigoDirector' => 'required|exists:directores,codigoDirector',
        ]);

        ContratoDirector::create([
            'fechaInicio' => $request->fechaInicio,
            'fechaFin' => $request->fechaFin,
            'codigoEquipo' => $request->codigoEquipo,
            'codigoDirector' => $request->codigoDirector,
        ]);

        return redirect()->route('directorContrato', $request->codigoDirector)
            ->with('success', 'Contrato creado exitosamente.');
    }

    // Actualizar contrato
    public function update(Request $request, $idContrato)
    {
        $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'codigoEquipo' => 'required|exists:equipos,codigoEquipo',
            'codigoDirector' => 'required|exists:directores,codigoDirector',
        ]);

        $contrato = ContratoDirector::findOrFail($idContrato);
        $contrato->fechaInicio = $request->fechaInicio;
        $contrato->fechaFin = $request->fechaFin;
        $contrato->codigoEquipo = $request->codigoEquipo;
        $contrato->codigoDirector = $request->codigoDirector;
        $contrato->save();

        return redirect()->route('directorContrato', $request->codigoDirector)
            ->with('success', 'Contrato actualizado correctamente.');
    }

    // Eliminar contrato
    public function destroy($idContrato)
    {
        $contrato = ContratoDirector::findOrFail($idContrato);
        $codigoDirector = $contrato->codigoDirector;
        $contrato->delete();

        return redirect()->route('directorContrato', $codigoDirector)
            ->with('success', 'Contrato eliminado correctamente.');
    }
}

