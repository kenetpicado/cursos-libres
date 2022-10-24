<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PagoShow extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $alumno_id;

    public function mount($id)
    {
        $this->alumno_id = $id;
    }

    public function getPagosProperty()
    {
        return DB::table('pagos')
            ->where('alumno_id', $this->alumno_id)
            ->latest('id')
            ->paginate(20);
    }

    public function getAlumnoProperty()
    {
        return DB::table('alumnos')->find($this->alumno_id, ['nombre']);
    }

    public function render()
    {
        return view('livewire.pago-show');
    }
}
