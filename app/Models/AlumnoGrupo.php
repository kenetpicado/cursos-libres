<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlumnoGrupo extends Model
{
    use HasFactory;

    protected $table = "alumno_grupo";

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
