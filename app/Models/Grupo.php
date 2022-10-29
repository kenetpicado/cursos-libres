<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $fillable = [
        'anyo',
        'horario',
        'duracion',
        'curso_id',
        'docente_id',
        'estado'
    ];

    public $timestamps = false;

    public function setHorarioAttribute($value)
    {
        $this->attributes['horario'] = trim(strtoupper($value));
    }

    public function setDuracionAttribute($value)
    {
        $this->attributes['duracion'] = trim(strtoupper($value));
    }

    public function inscripciones()
    {
        return $this->hasMany(Inscripcion::class);
    }
}
