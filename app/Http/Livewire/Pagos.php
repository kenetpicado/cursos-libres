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
    public $concepto = null;
    public $monto = null;
    public $recibi_de = null;

    public $alumno = null;

    protected $rules = [
        'alumno_id' => 'required|integer',
        'concepto' => 'required|max:100',
        'monto' => 'required|numeric',
        'recibi_de' => 'required|max:50',
    ];

    public function resetFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    public function getAlumnosProperty()
    {
        return DB::table('alumnos')
            ->select(['id', 'nombre', 'carnet'])
            ->latest('id')
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.pagos');
    }

    public function pagar($alumno_id)
    {
        $this->alumno_id = $alumno_id;
        $this->alumno = Alumno::find($alumno_id, ['nombre']);
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
