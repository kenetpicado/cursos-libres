<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Pago;
use App\Traits\MyAlerts;
use App\Traits\PagosTraits;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class GrupoShow extends Component
{
    use PagosTraits;
    use MyAlerts;
    public $grupo_id = null;
    public $temp = null;
    public $search = null;

    public $concepto = null;
    public $monto = null;
    public $recibi_de = null;

    public $alumno_id = null;

    protected $listeners = ['delete_element', 'inscribir'];

    public function resetFields()
    {
        $this->reset(['search']);
        $this->resetErrorBag();
    }

    protected $rules = [
        'alumno_id' => 'required|integer',
        'grupo_id' => 'nullable|integer',
        'concepto' => 'required|max:100',
        'monto' => 'required|numeric',
        'recibi_de' => 'required|max:50',
        'created_at' => 'required|date'
    ];

    public function mount($id)
    {
        $this->grupo_id = $id;
        $this->recibi_de = auth()->user()->name;
        $this->created_at = date('Y-m-d');
    }

    /* Obtener los alumnos de un grupo */
    public function getAlumnosProperty()
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
            $this->no_added();
        else {
            Inscripcion::create([
                'grupo_id' => $this->grupo_id,
                'alumno_id' => $id
            ]);

            $alumno = Alumno::find($id, ['nombre']);
            $this->added($alumno->nombre);
        }
    }

    public function pagar($alumno_id)
    {
        $this->alumno_id = $alumno_id;
        $this->emit('open-modal-pagar');
    }

    public function store()
    {
        $data = $this->validate();
        Pago::create($data);

        $this->success();

        $this->resetFields();
        $this->emit('close-modal');
    }

    public function delete_element($inscripcion_id)
    {
        Inscripcion::find($inscripcion_id)->delete();
        $this->delete();
    }
}
