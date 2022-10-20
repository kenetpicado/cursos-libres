<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Alumnos extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete_element'];

    public $sub_id = null;
    public $nombre = null;
    public $edad = null;
    public $celular = null;
    public $ciudad = null;
    public $comunidad = null;
    public $direccion = null;

    protected $rules = [
        'nombre' => 'required',
        'edad' => 'required|integer',
        'celular' => 'required|numeric|digits:8',
        'ciudad' => 'required|max:50',
        'comunidad' => 'required|max:50',
        'direccion' => 'required|max:70',
    ];

    public function resetFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }


    public function render()
    {
        $alumnos = DB::table('alumnos')
            ->select([
                'id',
                'nombre',
                'celular',
                'created_at'
            ])
            ->latest('id')
            ->paginate(20);

        return view('livewire.alumnos', compact('alumnos'));
    }

    /* Update or Create */
    public function store()
    {
        $data = $this->validate();

        Alumno::updateOrCreate(['id' => $this->sub_id], $data);

        session()->flash('message', $this->sub_id ? config('app.updated') : config('app.created'));

        $this->resetFields();
        $this->emit('close-modal');
    }

    public function edit($alumno_id)
    {
        $alumno = Alumno::find($alumno_id);
        $this->sub_id = $alumno->id;
        $this->nombre = $alumno->nombre;
        $this->edad = $alumno->edad;
        $this->celular = $alumno->celular;
        $this->ciudad = $alumno->ciudad;
        $this->comunidad = $alumno->comunidad;
        $this->direccion = $alumno->direccion;
        $this->emit('open-modal');
    }

    public function delete_element($alumno_id)
    {
        Alumno::find($alumno_id)->delete();
        session()->flash('message', config('app.deleted'));
    }
}
