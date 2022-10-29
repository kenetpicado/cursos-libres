<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Pago;
use App\Traits\AlumnosTraits;
use App\Traits\MyAlerts;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Alumnos extends Component
{
    use WithPagination;
    use AlumnosTraits;
    use MyAlerts;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['delete_element'];

    public $sub_id = null;
    public $carnet = null;
    public $nombre = null;
    public $edad = null;
    public $celular = null;
    public $ciudad = 'LEON';
    public $comunidad = null;
    public $direccion = null;
    public $created_at = null;
    public $grupo_id = null;

    /* Datos del pago */
    public $monto = null;
    public $concepto = "PAGO DE MATRICULA";

    public $search = null;

    protected $rules = [
        'nombre'    => 'required',
        'carnet'    => 'required|max:10|unique:alumnos',
        'edad'      => 'required|integer',
        'celular'   => 'required|numeric|digits:8',
        'ciudad'    => 'required|max:50',
        'comunidad' => 'required|max:50',
        'direccion' => 'required|max:70',
        'created_at' => 'required|date',
    ];
    
    public function getGruposProperty()
    {
        return Grupo::join('cursos', 'cursos.id', '=', 'grupos.curso_id')
            ->join('docentes', 'docentes.id', '=', 'grupos.docente_id')
            ->where('grupos.anyo', date('Y'))
            ->where('grupos.estado', '1')
            ->with('alumnos:id')
            ->get([
                'grupos.id',
                'grupos.horario',
                'cursos.nombre as curso',
                'docentes.nombre as docente'
            ]);
    }

    public function mount()
    {
        $this->created_at = now()->format('Y-m-d');
    }

    public function resetFields()
    {
        $this->resetExcept(['created_at']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.alumnos');
    }

    /* Update or Create */
    public function store()
    {
        $this->carnet = $this->generateCarnet($this->ciudad);

        $data = $this->validate();

        if ($this->sub_id) {
            unset($data['carnet'], $data['created_at']);
            Alumno::find($this->sub_id)->update($data);
        } else {
            /* Si es nuevo registro validar campos necesarios */
            $this->validate([
                'grupo_id' => 'required',
                'monto' => 'required|numeric'
            ]);

            $alumno = Alumno::create($data);

            /* Crear la inscripcion al grupo */
            $alumno->grupos()->attach($this->grupo_id);

            /* Generar el pago de matricula */
            Pago::create([
                'alumno_id' => $alumno->id,
                'grupo_id' => $this->grupo_id,
                'concepto' => "PAGO DE MATRICULA",
                'monto' => $this->monto,
                'recibi_de' => auth()->user()->name,
                'created_at' => $this->created_at
            ]); 
        }

        $this->success($this->sub_id);

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
        $alumno = Alumno::find($alumno_id, ['id']);

        if ($alumno->pagos()->count() > 0)
            $this->delete(false);
        else {
            $alumno->delete();
            $this->delete();
        }
    }

    public function generateCarnet($ciudad)
    {
        $comb = "0123456789";
        $shfl = str_shuffle($comb);
        return date('y') . "-" . substr($shfl, 0, 4) . '-' . substr($ciudad, 0, 2);
    }
}
