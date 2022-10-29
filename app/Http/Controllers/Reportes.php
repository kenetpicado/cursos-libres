<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Reportes extends Controller
{
    public function hoja_matricula($alumno_id)
    {
        return view('reportes.hoja_matricula');
    }
}
