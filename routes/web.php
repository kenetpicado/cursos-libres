<?php

namespace App\Http\Livewire;

use App\Http\Controllers\Reportes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', Home::class)->name('index');
    Route::get('cursos', Cursos::class)->name('cursos');
    Route::get('docentes', Docentes::class)->name('docentes');
    Route::get('grupos', Grupos::class)->name('grupos');
    Route::get('grupo/{id}', GrupoShow::class)->name('grupos.show');
    Route::get('alumnos', Alumnos::class)->name('alumnos');
    Route::get('pagos', Pagos::class)->name('pagos');
    Route::get('pagos/{id}', PagoShow::class)->name('pagos.show');

    /* Hoja de Mamatricula */
    Route::get('hoja-de-matricula/{id}', [Reportes::class, 'hoja_matricula'])
        ->name('hoja_matricula');

    /* Recibo */
    Route::get('recibo-oficial/{id}', [Reportes::class, 'recibo_oficial'])
        ->name('recibo_oficial');

    Route::get('recibo-no-oficial/{id}', [Reportes::class, 'recibo_no_oficial'])
        ->name('recibo_no_oficial');
});

Auth::routes();
