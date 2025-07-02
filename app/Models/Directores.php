<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directores extends Model
{
    //
    protected $table = 'directores';
    protected $primaryKey = 'codigoDirector';
    public $incrementing = false; 
    protected $keyType = 'string';

    public function nacionalidad()
    {
        return $this->belongsTo(Nacionalidad::class, 'codigoNacionalidad', 'codigoNacionalidad');
    }
}