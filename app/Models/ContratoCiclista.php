<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratoCiclista extends Model
{
    //
protected $table = 'contrato_ciclistas';
    protected $primaryKey = 'idContrato';

    protected $fillable = ['fechaInicio', 'fechaFin', 'codigoEquipo', 'codigoCiclista'];

    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'codigoCiclista');
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'codigoEquipo');
    }
};
