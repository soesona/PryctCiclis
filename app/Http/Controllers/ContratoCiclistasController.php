<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContratoCiclista;
use App\Models\Ciclista;
use App\Models\Equipo;

class ContratoCiclistasController extends Controller
{
    // Ya no se usa
    public function index()
    {
        //
    }

    // Muestra los contratos de un ciclista específico
    public function showContratoCiclista($codigoCiclista)
    {
        $ciclista = Ciclista::where('codigoCiclista', $codigoCiclista)->firstOrFail();

        $contratos = ContratoCiclista::where('codigoCiclista', $codigoCiclista)
            ->with('equipo')
            ->get();

        $equipos = Equipo::all();

        return view('contratoCiclista.index', compact('ciclista', 'contratos', 'equipos'));
    }

    // Guardar nuevo contrato
    public function store(Request $request)
    {
        $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'codigoEquipo' => 'required|exists:equipos,codigoEquipo',
            'codigoCiclista' => 'required|exists:ciclistas,codigoCiclista',
        ]);

        ContratoCiclista::create([
            'fechaInicio' => $request->fechaInicio,
            'fechaFin' => $request->fechaFin,
            'codigoEquipo' => $request->codigoEquipo,
            'codigoCiclista' => $request->codigoCiclista,
        ]);

        return redirect()->route('ciclistaContrato', $request->codigoCiclista)
            ->with('success', 'Contrato creado exitosamente.');
    }

    // Actualizar contrato
    public function update(Request $request, $idContrato)
    {
        $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'nullable|date|after_or_equal:fechaInicio',
            'codigoEquipo' => 'required|exists:equipos,codigoEquipo',
            'codigoCiclista' => 'required|exists:ciclistas,codigoCiclista',
        ]);

        $contrato = ContratoCiclista::findOrFail($idContrato);
        $contrato->fechaInicio = $request->fechaInicio;
        $contrato->fechaFin = $request->fechaFin;
        $contrato->codigoEquipo = $request->codigoEquipo;
        $contrato->codigoCiclista = $request->codigoCiclista;
        $contrato->save();

        return redirect()->route('ciclistaContrato', $request->codigoCiclista)
            ->with('success', 'Contrato actualizado correctamente.');
    }

    // Eliminar contrato
    public function destroy($idContrato)
    {
        $contrato = ContratoCiclista::findOrFail($idContrato);
        $codigoCiclista = $contrato->codigoCiclista;
        $contrato->delete();

        return redirect()->route('ciclistaContrato', $codigoCiclista)
            ->with('success', 'Contrato eliminado correctamente.');
    }
}
