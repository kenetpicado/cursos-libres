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

    /* Relationships */
    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class)->withPivot('id');
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function docente()
    {
        return $this->belongsTo(Docente::class);
    }

    /* Local Scopes */
    public function scopeJoinCurso($q)
    {
        return $q->join('cursos', 'cursos.id', '=', 'grupos.curso_id');
    }

    public function scopeJoinDocente($q)
    {
        return $q->join('docentes', 'docentes.id', '=', 'grupos.docente_id');
    }

    public function scopeAnyo($q)
    {
        return $q->where('grupos.anyo', date('Y'));
    }

    public function scopeActivo($q, $value = 1)
    {
        return $q->where('grupos.estado', $value);
    }

    public function scopeSelectInfo($q)
    {
        return $q->select([
            'grupos.*',
            'cursos.nombre as curso',
            'docentes.nombre as docente'
        ]);
    }

    public function scopeSelectLiteInfo($q)
    {
        return $q->select([
            'grupos.id',
            'grupos.horario',
            'cursos.nombre as curso',
            'docentes.nombre as docente'
        ]);
    }

    public function scopeAllInfo($q)
    {
        return $q->joinCurso()
            ->joinDocente()
            ->selectInfo();
    }

    public function scopeLiteInfo($q)
    {
        return $q->joinCurso()
            ->joinDocente()
            ->selectLiteInfo();
    }

    /* Setters */
    public function setHorarioAttribute($value)
    {
        $this->attributes['horario'] = trim(strtoupper($value));
    }

    public function setDuracionAttribute($value)
    {
        $this->attributes['duracion'] = trim(strtoupper($value));
    }
}
