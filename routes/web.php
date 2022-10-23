<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('index');
Route::get('cursos', Cursos::class)->name('cursos');
Route::get('docentes', Docentes::class)->name('docentes');
Route::get('grupos', Grupos::class)->name('grupos');
Route::get('grupo/{id}', GrupoShow::class)->name('grupos.show');
Route::get('alumnos', Alumnos::class)->name('alumnos');
Route::get('pagos', Pagos::class)->name('pagos');
Route::get('pagos/{id}', PagoShow::class)->name('pagos.show');