<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';  
    protected $primaryKey = 'codigoEquipo';  
    public $incrementing = true; 
    protected $keyType = 'int';  

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'codigoNacionalidad', 'codigoNacionalidad');
    }
}
