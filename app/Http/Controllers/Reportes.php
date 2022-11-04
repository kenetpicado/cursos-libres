<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Reportes extends Controller
{
    public function hoja_matricula($alumno_id)
    {
        return view('reportes.hoja_matricula');
    }

    public function recibo_oficial($pago_id)
    {
        return view('reportes.recibo_oficial');
    }

    public function recibo_no_oficial($pago_id)
    {
        return view('reportes.recibo_no_oficial');
    }
}
