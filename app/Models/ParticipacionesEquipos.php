<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParticipacionesEquipos extends Model
{
    protected $table = 'participaciones_equipos';
    protected $primaryKey = 'codigoParticipacionEquipo';
    public $incrementing = true;
    protected $keyType = 'int';

    public function prueba() 
    {
    return $this->belongsTo(Prueba::class, 'idPrueba');
    }


    

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'codigoEquipo', 'codigoEquipo');
    }
}
