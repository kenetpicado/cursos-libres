<?php

namespace App\Http\Livewire;

use App\Models\Alumno;
use App\Models\Pago;
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

    public function render()
    {
        $alumno = Alumno::find($this->alumno_id, ['id', 'nombre']);

        $pagos = Pago::whereHas('alumno_grupo', function ($q) {
            $q->where('alumno_id', $this->alumno_id);
        })
            ->join('alumno_grupo', 'alumno_grupo.id', '=', 'pagos.alumno_grupo_id')
            ->join('grupos', 'grupos.id', '=', 'alumno_grupo.grupo_id')
            ->join('cursos', 'cursos.id', '=', 'grupos.curso_id')
            ->latest('pagos.id')
            ->select([
                'pagos.*',
                'cursos.nombre as curso'
            ])
            ->paginate(20);

        return view('livewire.pago-show', compact('alumno', 'pagos'));
    }
}
