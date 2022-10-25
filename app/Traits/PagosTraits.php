<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait PagosTraits
{
    /* Obtener nombre de un alumno */
    public function getAlumnoProperty()
    {
        return DB::table('alumnos')->find($this->alumno_id, ['id', 'nombre']);
    }

    /* Obtener inscripciones de un alumno */
    public function getInscripcionesProperty()
    {
        return DB::table('inscripcions')
            ->where('alumno_id', $this->alumno_id)
            ->join('grupos', 'grupos.id', '=', 'inscripcions.grupo_id')
            ->join('cursos', 'cursos.id', '=', 'grupos.curso_id')
            ->get([
                'inscripcions.*',
                'cursos.nombre'
            ]);
    }
}
