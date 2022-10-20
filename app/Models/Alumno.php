<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'edad', 'celular', 'ciudad', 'comunidad', 'direccion'];

    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = trim(strtoupper($value));
    }

    public function setCiudadAttribute($value)
    {
        $this->attributes['ciudad'] = trim(strtoupper($value));
    }

    public function setComunidadAttribute($value)
    {
        $this->attributes['comunidad'] = trim(strtoupper($value));
    }

    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = trim(strtoupper($value));
    }
}
