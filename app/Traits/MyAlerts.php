<?php

namespace App\Traits;

use Jantinnerezo\LivewireAlert\LivewireAlert;

trait MyAlerts
{
    use LivewireAlert;

    public function success($is_update = false)
    {
        $this->alert('success',  $is_update ?  config('app.updated') : config('app.created'));
    }

    public function delete($deleted = true)
    {
        $this->alert('error',  $deleted ? config('app.deleted') : config('app.undeleted'));
    }

    public function added($nombre)
    {
        $this->alert('success', "Completado", [
            'text' => $nombre . ' agregado correctamente'
        ]);
    }

    public function no_added()
    {
        $this->alert('error', "Error", [
            'text' => 'EL alumno ya ha sido agregado.'
        ]);
    }
}
