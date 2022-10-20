<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Grupos extends Component
{
    public $sub_id = null;
    public $anyo = null;
    public $estado = null;
    public $horario = null;
    public $duracion = null;
    public $curso_id = null;
    public $docente_id = null;

    public function resetFields()
    {
        $this->resetExcept(['anyo']);
        $this->resetErrorBag();
    }

    protected $rules = [
        'anyo' => 'required|digits:4',
        'horario' => 'required|max:50',
        'duracion' => 'required|max:50',
        'curso_id' => 'required|integer',
        'docente_id' => 'required|integer'
    ];

    public function mount()
    {
        $this->anyo = date('Y');
    }

    public function render()
    {
        $grupos = DB::table('grupos')
            ->join('cursos', 'cursos.id', '=', 'grupos.curso_id')
            ->join('docentes', 'docentes.id', '=', 'grupos.docente_id')
            ->select([
                'grupos.*',
                'cursos.nombre as curso',
                'docentes.nombre as docente'
            ])
            ->paginate(20);

        $cursos = DB::table('cursos')->where('estado', '1')->get();
        $docentes = DB::table('docentes')->where('estado', '1')->get();

        return view('livewire.grupos', compact('grupos', 'cursos', 'docentes'));
    }

    public function store()
    {
        $data = $this->validate();
        Grupo::updateOrCreate(['id' => $this->sub_id], $data);

        session()->flash('message', $this->sub_id ? config('app.updated') : config('app.created'));

        $this->resetFields();
        $this->emit('close-modal');
    }

    public function edit($grupo_id)
    {
        $grupo = Grupo::find($grupo_id);
        $this->sub_id = $grupo->id;
        $this->anyo = $grupo->anyo;
        $this->horario = $grupo->horario;
        $this->duracion = $grupo->duracion;
        $this->curso_id = $grupo->curso_id;
        $this->docente_id = $grupo->docente_id; 
        $this->emit('open-modal');
    }

    public function delete_element($grupo_id)
    {
        $grupo = Grupo::find($grupo_id);
    }
}