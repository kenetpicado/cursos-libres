<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Traits\MyAlerts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Grupos extends Component
{
    use WithPagination;
    use MyAlerts;
    protected $paginationTheme = 'bootstrap';

    public $sub_id = null;
    public $anyo = null;
    public $estado = 1;
    public $horario = null;
    public $duracion = null;
    public $curso_id = null;
    public $docente_id = null;

    public $search = null;
    public $estado_search = 1;

    protected $listeners = ['delete_element'];

    public function resetFields()
    {
        $this->resetExcept(['anyo']);
        $this->resetErrorBag();
    }

    protected $rules = [
        'anyo'      => 'required|digits:4',
        'horario'   => 'required|max:50',
        'duracion'  => 'required|max:50',
        'curso_id'  => 'required|integer',
        'docente_id' => 'required|integer',
        'estado'    => 'required|in:1,0'
    ];

    public function mount()
    {
        $this->anyo = date('Y');
    }

    public function getCursosProperty()
    {
        return DB::table('cursos')->where('estado', '1')->get(['id', 'nombre']);
    }

    public function getDocentesProperty()
    {
        return DB::table('docentes')->where('estado', '1')->get(['id', 'nombre']);
    }

    public function getGruposProperty()
    {
        return Grupo::join('cursos', 'cursos.id', '=', 'grupos.curso_id')
            ->join('docentes', 'docentes.id', '=', 'grupos.docente_id')
            ->select([
                'grupos.*',
                'cursos.nombre as curso',
                'docentes.nombre as docente'
            ])
            ->with('alumnos:id')
            ->when($this->estado_search, function ($q) {
                $q->where('grupos.estado', $this->estado_search);
            })
            ->orderBy('estado', 'desc')
            ->latest('id')
            ->when($this->search, function ($q) {
                $q->where('cursos.nombre', 'like', '%' . $this->search . '%')
                    ->orWhere('docentes.nombre', 'like', '%' . $this->search . '%');
            })
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.grupos');
    }

    public function store()
    {
        $data = $this->validate();
        Grupo::updateOrCreate(['id' => $this->sub_id], $data);

        $this->success($this->sub_id);

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
        $this->estado = $grupo->estado;
        $this->emit('open-modal');
    }

    public function delete_element($grupo_id)
    {
        $grupo = Grupo::find($grupo_id, ['id']);

        if ($grupo->alumnos->count() > 0)
            $this->delete(false);
        else {
            $grupo->delete();
            $this->delete();
        }
    }
}
