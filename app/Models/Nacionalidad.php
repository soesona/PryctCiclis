<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
    protected $table = 'nacionalidads';
    protected $primaryKey = 'codigoNacionalidad';
    public $incrementing = true; 
    protected $keyType = 'int';  
}
