<?php

namespace App\Http\Livewire;

use App\Models\Grupo;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GrupoShow extends Component
{
    public $grupo_id = null;
    public $temp = null;
    public $search = null;

    protected $listeners = ['delete_element', 'inscribir'];

    public function resetFields()
    {
        $this->reset(['search']);
        $this->resetErrorBag();
    }

    public function mount($id)
    {
        $this->grupo_id = $id;
    }

    public function getInscripcionesProperty()
    {
        return DB::table('inscripcions')
            ->where('grupo_id', $this->grupo_id)
            ->join('alumnos', 'alumnos.id', '=', 'inscripcions.alumno_id')
            ->select([
                'inscripcions.id',
                'alumnos.id as alumno_id',
                'alumnos.carnet',
                'alumnos.nombre'
            ])
            ->orderBy('alumnos.nombre')
            ->paginate(20);
    }

    public function getGrupoProperty()
    {
        return Grupo::where('grupos.id', $this->grupo_id)
            ->join('cursos', 'cursos.id', '=', 'grupos.curso_id')
            ->join('docentes', 'docentes.id', '=', 'grupos.docente_id')
            ->select([
                'grupos.horario',
                'cursos.nombre as curso',
                'docentes.nombre as docente'
            ])
            ->first();
    }

    public function getResultsProperty()
    {
        return $this->search
            ? DB::table('alumnos')
            ->select(['id', 'nombre', 'carnet'])
            ->latest('id')
            ->where('carnet', 'like', '%' . $this->search . '%')
            ->orWhere('nombre', 'like', '%' . $this->search . '%')
            ->limit(4)
            ->get()
            : [];
    }

    public function render()
    {
        return view('livewire.grupo-show');
    }

    public function inscribir($id)
    {
        $exist = Inscripcion::where('grupo_id', $this->grupo_id)
            ->where('alumno_id', $id)
            ->count();

        if ($exist > 0)
            session()->flash('exist', config('app.exist'));
        else {
            Inscripcion::create([
                'grupo_id' => $this->grupo_id,
                'alumno_id' => $id
            ]);
            session()->flash('added', config('app.added'));
        }
    }

    public function delete_element($inscripcion_id)
    {
        Inscripcion::find($inscripcion_id)->delete();
        session()->flash('message', config('app.deleted'));
    }
}
