<?php

namespace App\Http\Livewire;

use App\Models\Pago;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Pagos extends Component
{

    public $sub_id = null;
    public $alumno_id = null;
    public $concepto = null;
    public $monto = null;
    public $recibi_de = null;

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
        return DB::table('alumnos')->get(['id','nombre','carnet']);
    }

    public function render()
    {
        $pagos = DB::table('pagos')
            ->join('alumnos', 'alumnos.id', '=', 'pagos.alumno_id')
            ->select([
                'pagos.*',
                'alumnos.nombre as alumno',
                'alumnos.carnet as carnet'
            ])
        ->latest('id')
        ->paginate(20);
        return view('livewire.pagos', compact('pagos'));
    }

    public function store()
    {
        $data = $this->validate();
        Pago::updateOrCreate(['id' => $this->sub_id], $data);

        session()->flash('message', $this->sub_id ? config ('app.updated') : config('app.created'));

        $this->resetFields();
        $this->emit('close-modal');


    }
}
