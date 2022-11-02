<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\AlumnoGrupo;
use App\Models\Grupo;
use App\Models\Pago;
use App\Traits\MyAlerts;
use App\Traits\PagosTraits;
use Livewire\Component;

class GrupoShow extends Component
{
    use PagosTraits;
    use MyAlerts;

    public $grupo_id = null;
    public $alumno_id = null;
    public $alumno_grupo_id = null;

    public $search = null;
    public $search_alumno = null;

    public $concepto = null;
    public $monto = null;
    public $recibi_de = null;
    public $created_at = null;

    protected $listeners = ['delete_element', 'inscribir'];

    public function resetFields()
    {
        $this->resetExcept(['grupo_id', 'created_at', 'recibi_de']);
        $this->resetErrorBag();
    }

    protected $rules = [
        'alumno_grupo_id' => 'required|integer',
        'concepto'       => 'required|max:100',
        'monto'          => 'required|numeric',
        'recibi_de'      => 'required|max:50',
        'created_at'     => 'required|date'
    ];

    public function mount($id)
    {
        $this->grupo_id = $id;
        $this->recibi_de = auth()->user()->name;
        $this->created_at = date('Y-m-d');
    }

    public function getResultsProperty()
    {
        return $this->search
            ? Alumno::select(['id', 'nombre', 'carnet'])
            ->latest('id')
            ->where(function ($q) {
                $q->doesntHave('grupos')->orWhereHas('grupos', function ($q) {
                    $q->where('grupo_id', '!=', $this->grupo_id);
                });
            })
            ->where(function ($q) {
                $q->where('carnet', 'like', '%' . $this->search . '%')
                    ->orWhere('nombre', 'like', '%' . $this->search . '%');
            })
            ->limit(4)
            ->get()
            : [];
    }

    public function render()
    {
        $grupo = Grupo::with([
            'alumnos' => function ($q) {
                $q->orderBy('nombre')
                    ->select(['alumnos.id', 'carnet', 'nombre'])
                    ->search($this->search_alumno);
            }
        ])
            ->liteInfo()
            ->find($this->grupo_id);

        return view('livewire.grupo-show', compact('grupo'));
    }

    public function inscribir($alumno_id)
    {
        $alumno = Alumno::find($alumno_id, ['id']);
        $alumno->grupos()->attach($this->grupo_id);

        $this->added($alumno->nombre);
    }

    /* Open Modal: Pagar */
    public function pagar($alumno_id, $alumno_grupo_id)
    {
        $this->alumno_id = $alumno_id;
        $this->alumno_grupo_id = $alumno_grupo_id;
        $this->emit('open-modal-pagar');
    }

    /* Guardar Pago */
    public function store()
    {
        $data = $this->validate();

        Pago::create($data);

        $this->success();

        $this->resetFields();
        $this->emit('close-modal');
    }

    public function delete_element($alumno_grupo_id)
    {
        $alumno_grupo = AlumnoGrupo::find($alumno_grupo_id);

        if ($alumno_grupo->pagos->count() > 0)
            $this->delete(false);
        else {
            $alumno_grupo->delete();
            $this->delete();
        }
    }
}
