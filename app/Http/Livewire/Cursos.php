<?php

namespace App\Http\Livewire;

use App\Models\Curso;
use App\Traits\MyAlerts;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Cursos extends Component
{
    use WithPagination;
    use MyAlerts;
    protected $paginationTheme = 'bootstrap';

    public $sub_id;
    public $nombre = null;
    public $estado = 1;

    protected $listeners = ['delete_element'];

    public function resetFields()
    {
        $this->reset();
        $this->resetErrorBag();
    }

    /* Validations */
    protected function rules()
    {
        return [
            'nombre' => ['required', 'max:50', Rule::unique('cursos')->ignore($this->sub_id)],
            'estado' => ['required']
        ];
    }

    /* Show View */
    public function render()
    {
        $cursos = DB::table('cursos')
            ->orderBy('estado', 'desc')
            ->orderBy('nombre')
            ->paginate(20);

        return view('livewire.cursos', compact('cursos'));
    }

    /* Update or Create */
    public function store()
    {
        $data = $this->validate();

        Curso::updateOrCreate(['id' => $this->sub_id], $data);

        $this->success($this->sub_id);

        $this->resetFields();
        $this->emit('close-modal');
    }

    /* Load Modal for Edit */
    public function edit($curso_id)
    {
        $curso = Curso::find($curso_id);
        $this->sub_id = $curso->id;
        $this->nombre = $curso->nombre;
        $this->estado = $curso->estado;
        $this->emit('open-modal');
    }

    public function delete_element($curso_id)
    {
        $curso = Curso::find($curso_id);

        if ($curso->grupos()->count() > 0)
            $this->delete(false);
        else {
            $curso->delete();
            $this->delete();
        }
    }
}
