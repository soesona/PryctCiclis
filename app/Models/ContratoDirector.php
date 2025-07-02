<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContratoDirector extends Model
{
    //
    protected $table = 'contrato_directors';
protected $primaryKey = 'idContrato';

protected $fillable = ['fechaInicio', 'fechaFin', 'codigoEquipo', 'codigoDirector'];

public function director()
{
    return $this->belongsTo(Directores::class, 'codigoDirector');
}

public function equipo()
{
    return $this->belongsTo(Equipo::class, 'codigoEquipo');
}

}
