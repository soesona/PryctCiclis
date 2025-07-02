<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
    protected $table = 'pruebas';

    protected $primaryKey = 'id'; 

    public function nombrePrueba()
    {
        return $this->belongsTo(NombresPruebas::class, 'codigoNombrePrueba', 'codigoNombrePrueba');
    }


    public function ciclista()
    {
        return $this->belongsTo(Ciclista::class, 'idCiclista', 'codigoCiclista');
    }
}
