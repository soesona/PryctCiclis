<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NombresPruebas extends Model
{
      protected $table = 'nombrespruebas';
    protected $primaryKey = 'codigoNombrePrueba';
    public $incrementing = true; 
    protected $keyType = 'int';  
}
