@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Pagos</li>
@endsection
<div class="card">
    <x-header label="Pagos"></x-header>

    <button id="btn-open-modal" class="d-none" data-bs-toggle="modal" data-bs-target="#createModal"></button>

    <x-modal label="Pagar">
        <div class="mb-2">Registrar nuevo pago del alumno:</div>
        <h6 class="mb-3">{{ $this->alumno->nombre ?? '' }}</h6>
        <x-input name="concepto"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="monto" type="number"></x-input>
            </div>
            <div class="col">
                <x-input name="recibi_de" label="Recibi de"></x-input>
            </div>
        </div>
        <x-select name="grupo_id" label="Grupo">
            <option value="">Seleccionar</option>
            @forelse ($this->inscripciones as $inscripcion)
                <option value="{{ $inscripcion->grupo_id }}">{{ $inscripcion->nombre }}</option>
            @empty
                <option value="">No hay inscripciones</option>
            @endforelse
        </x-select>
    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <div class="row mb-3">
            <div class="col-lg-3">
                <input class="form-control" type="search" placeholder="Buscar" wire:model="search">
            </div>
        </div>

        <x-table>
            @slot('header')
                <th>#</th>
                <th>carnet</th>
                <th>alumno</th>
                <th>Acción</th>
                <th>Acción</th>
            @endslot
            @forelse ($this->alumnos as $alumno)
                <tr>
                    <td data-title="#">{{ $alumno->id }}</td>
                    <td data-title="Carnet">{{ $alumno->carnet }}</td>
                    <td data-title="Alumno">{{ $alumno->nombre }}</td>
                    <td>
                        <button wire:click="pagar({{ $alumno->id }})" class="btn btn-sm btn-primary">
                            Pagar
                        </button>
                    </td>
                    <td>
                        <a href="{{ route('pagos.show', $alumno->id) }}">
                            Ver pagos
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $this->alumnos->links() }}
    </div>
</div>
