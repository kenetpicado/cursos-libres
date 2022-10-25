<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait AlumnosTraits
{
    /* Todos los alumnos */
    public function getAlumnosProperty()
    {
        return DB::table('alumnos')
            ->select(['id', 'nombre', 'carnet'])
            ->latest('id')
            ->when($this->search, function ($q) {
                $q->where('carnet', 'like', '%' . $this->search . '%')
                    ->orWhere('nombre', 'like', '%' . $this->search . '%');
            })
            ->paginate(20);
    }
}
