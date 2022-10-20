<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'celular',
        'tipo_pago',
        'viatico',
        'estado'
    ];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(strtoupper($value));
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
