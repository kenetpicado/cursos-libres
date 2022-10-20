<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $ambiente = "hola";

    public function render()
    {
        return view('livewire.home');
    }
}
