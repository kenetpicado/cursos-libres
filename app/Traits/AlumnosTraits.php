<?php

namespace App\Traits;

use App\Models\Alumno;

trait AlumnosTraits
{
    /* Todos los alumnos */
    public function getAlumnosProperty()
    {
        return Alumno::select(['id', 'nombre', 'carnet'])
            ->latest('id')
            ->search($this->search)
            ->paginate(20);
    }
}
