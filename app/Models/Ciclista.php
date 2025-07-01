<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciclista extends Model
{
    protected $table = 'ciclistas';
    protected $primaryKey = 'codigoCiclista';
    public $incrementing = false; 
    protected $keyType = 'string';

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'codigoNacionalidad', 'codigoNacionalidad');
    }
}
