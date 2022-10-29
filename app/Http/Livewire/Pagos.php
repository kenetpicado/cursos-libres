<?php

namespace App\Http\Livewire;

use App\Models\Pago;
use App\Traits\AlumnosTraits;
use App\Traits\PagosTraits;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pagos extends Component
{
    use WithPagination;
    use PagosTraits;
    use AlumnosTraits;
    protected $paginationTheme = 'bootstrap';

    public $sub_id = null;
    public $alumno_id = null;
    public $grupo_id = null;
    public $concepto = null;
    public $monto = null;
    public $recibi_de = null;
    public $created_at = null;

    public $search = null;

    protected $rules = [
        'alumno_id' => 'required|integer',
        'grupo_id' => 'nullable|integer',
        'concepto' => 'required|max:100',
        'monto' => 'required|numeric',
        'recibi_de' => 'required|max:50',
        'created_at' => 'required|date',
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

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-y', strtotime($value));
    }

}
