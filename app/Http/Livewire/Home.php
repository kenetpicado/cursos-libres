<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $ambiente = "hola";

    public function render()
    {
        return view('livewire.home');
    }
}
