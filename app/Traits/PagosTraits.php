<?php

namespace App\Traits;

use App\Models\Alumno;
use Illuminate\Support\Facades\DB;

trait PagosTraits
{
    /* Obtener nombre de un alumno */
    public function getAlumnoProperty()
    {
        return Alumno::when($this->alumno_id, function ($q) {
            $q->with('grupos');
        })
            ->find($this->alumno_id, ['id', 'nombre']);
    }
}
