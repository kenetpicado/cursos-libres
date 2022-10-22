<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Pago;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pagos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $sub_id = null;
    public $alumno_id = null;
    public $grupo_id = null;
    public $concepto = null;
    public $monto = null;
    public $recibi_de = null;

    public $search = null;

    protected $rules = [
        'alumno_id' => 'required|integer',
        'grupo_id' => 'required|integer',
        'concepto' => 'required|max:100',
        'monto' => 'required|numeric',
        'recibi_de' => 'required|max:50',
    ];

    public function resetFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

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

    /* Un alumno */
    public function getAlumnoProperty()
    {
        return DB::table('alumnos')->find($this->alumno_id, ['id', 'nombre']);
    }

    public function getInscripcionesProperty()
    {
        return DB::table('inscripcions')
            ->where('alumno_id', $this->alumno_id)
            ->join('grupos', 'grupos.id', '=', 'inscripcions.grupo_id')
            ->join('cursos', 'cursos.id', '=', 'grupos.curso_id')
            ->get([
                'inscripcions.*',
                'cursos.nombre'
            ]);
    }

    public function render()
    {
        return view('livewire.pagos');
    }

    public function pagar($alumno_id)
    {
        $this->alumno_id = $alumno_id;
        $this->emit('open-modal');
    }

    public function store()
    {
        $data = $this->validate();
        Pago::updateOrCreate(['id' => $this->sub_id], $data);

        session()->flash('message', $this->sub_id ? config('app.updated') : config('app.created'));

        $this->resetFields();
        $this->emit('close-modal');
    }
}
