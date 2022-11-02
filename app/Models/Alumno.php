<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = ['carnet', 'nombre', 'edad', 'celular', 'ciudad', 'comunidad', 'direccion', 'created_at'];

    public $timestamps = false;

    public function scopeSearch($query, $value)
    {
        return $query->where(function ($q) use ($value) {
            $q->where('carnet', 'like', '%' . $value . '%')
                ->orWhere('nombre', 'like', '%' . $value . '%');
        });
    }

    public function grupos()
    {
        return $this->belongsToMany(Grupo::class)->withPivot('id');
    }

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

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-y', strtotime($value));
    }
}
