<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $ambiente = "hola";

    public function render()
    {
        $cursos = DB::table('cursos')
            ->where('estado', 1)
            ->count();

        $docentes = DB::table('docentes')
            ->where('estado', 1)
            ->count();

        $alumnos = DB::table('alumnos')
            ->where('created_at', '>=', date('Y-m-d'))
            ->count();

        $grupos = DB::table('grupos')
            ->where('estado', 1)
            ->where('anyo', date('Y'))
            ->count();

        $info = (object) [
            'cursos' => $cursos,
            'docentes' => $docentes,
            'alumnos' => $alumnos,
            'grupos' => $grupos
        ];

        return view('livewire.home', compact('info'));
    }
}
