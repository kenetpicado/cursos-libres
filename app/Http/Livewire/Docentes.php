<?php

namespace App\Http\Livewire;

use App\Models\Docente;
use App\Traits\MyAlerts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Docentes extends Component
{
    use WithPagination;
    use MyAlerts;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete_element'];

    public $sub_id = null;
    public $nombre = null;
    public $celular = null;
    public $tipo_pago = "PORCENTAJE";
    public $viatico = null;
    public $estado = 1;

    public function resetFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    protected $rules = [
        'nombre'    => 'required',
        'celular'   => 'required|numeric|digits:8',
        'tipo_pago' => 'required|max:50',
        'viatico'   => 'required|max:20',
        'estado'    => 'nullable'
    ];

    public function render()
    {
        $docentes = DB::table('docentes')
            ->orderBy('estado', 'desc')
            ->orderBy('nombre')
            ->paginate(20);

        return view('livewire.docentes', compact('docentes'));
    }

    public function store()
    {
        $data = $this->validate();
        Docente::updateOrCreate(['id' => $this->sub_id], $data);

        $this->success($this->sub_id);

        $this->resetFields();
        $this->emit('close-modal');
    }

    public function edit($docente_id)
    {
        $docente = Docente::find($docente_id);
        $this->sub_id = $docente->id;
        $this->nombre = $docente->nombre;
        $this->celular = $docente->celular;
        $this->tipo_pago = $docente->tipo_pago;
        $this->viatico = $docente->viatico;
        $this->estado = $docente->estado;
        $this->emit('open-modal');
    }

    public function delete_element($docente_id)
    {
        $docente = Docente::find($docente_id);

        if ($docente->grupos()->count() > 0)
            $this->delete(false);
        else {
            $docente->delete();
            $this->delete();
        }
    }
}
