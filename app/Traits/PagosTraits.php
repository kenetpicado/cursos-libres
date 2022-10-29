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
}
