<?php

namespace App\Http\Livewire;

use App\Models\Pago;
use App\Traits\AlumnosTraits;
use App\Traits\MyAlerts;
use App\Traits\PagosTraits;
use Livewire\Component;
use Livewire\WithPagination;

class Pagos extends Component
{
    use WithPagination;
    use PagosTraits;
    use AlumnosTraits;
    use MyAlerts;
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
        'grupo_id' => 'nullable|integer',
        'concepto' => 'required|max:100',
        'monto' => 'required|numeric',
        'recibi_de' => 'required|max:50',
    ];

    public function mount()
    {
        $this->recibi_de = auth()->user()->name;
    }

    public function resetFields()
    {
        $this->resetExcept(['recibi_de']);
        $this->resetErrorBag();
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

        $this->success($this->sub_id);

        $this->resetFields();
        $this->emit('close-modal');
    }
}
