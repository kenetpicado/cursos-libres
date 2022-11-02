<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Pago;
use App\Traits\MyAlerts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pagos extends Component
{
    use WithPagination;
    use MyAlerts;
    protected $paginationTheme = 'bootstrap';

    public $alumno_id = null;
    public $concepto = null;
    public $monto = null;
    public $recibi_de = null;
    public $created_at = null;

    public $alumno_grupo_id = null;

    public $search = null;

    protected $rules = [
        'alumno_grupo_id' => 'required|integer',
        'concepto'      => 'required|max:100',
        'created_at'    => 'required|date',
        'monto'         => 'required|numeric',
        'recibi_de'     => 'required|max:50',
    ];

    public function mount()
    {
        $this->recibi_de = auth()->user()->name;
        $this->created_at = now()->format('Y-m-d');
    }

    public function resetFields()
    {
        $this->resetExcept(['recibi_de', 'created_at']);
        $this->resetErrorBag();
    }

    public function render()
    {
        $alumno = Alumno::when($this->alumno_id, function ($q) {
            $q->with(['grupos' => function ($q) {
                $q->allInfo();
            }]);
        })
            ->find($this->alumno_id, ['id', 'nombre']);

        $alumnos = Alumno::select(['id', 'nombre', 'carnet'])
            ->latest('id')
            ->search($this->search)
            ->paginate(20);

        return view('livewire.pagos', compact('alumno', 'alumnos'));
    }

    public function pagar($alumno_id)
    {
        $this->alumno_id = $alumno_id;
        $this->emit('open-modal');
    }

    public function store()
    {
        $data = $this->validate();

        Pago::create($data);

        $this->success();

        $this->resetFields();
        $this->emit('close-modal');
    }
}
