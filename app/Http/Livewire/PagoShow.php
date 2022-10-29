<?php

namespace App\Http\Livewire;

use App\Models\Pago;
use App\Traits\PagosTraits;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PagoShow extends Component
{
    use WithPagination;
    use PagosTraits;
    protected $paginationTheme = 'bootstrap';

    public $alumno_id;

    public function mount($id)
    {
        $this->alumno_id = $id;
    }

    public function getPagosProperty()
    {
        return Pago::where('alumno_id', $this->alumno_id)
            ->latest('id')
            ->paginate(20);
    }

    public function render()
    {
        return view('livewire.pago-show');
    }
}
