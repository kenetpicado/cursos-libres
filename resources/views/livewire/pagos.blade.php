<div class="card">
    <x-header label="Pagos"></x-header>

    <button id="btn-open-modal" class="d-none" data-bs-toggle="modal" data-bs-target="#createModal"></button>

    <x-modal label="Pagar">
        <div class="mb-2">Registrar nuevo pago del alumno:</div>
        <h6 class="mb-3">{{ $alumno->nombre ?? '' }}</h6>
        <x-input name="concepto"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="monto" type="number"></x-input>
            </div>
            <div class="col">
                <x-input name="recibi_de"></x-input>
            </div>
        </div>
    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <x-table>
            @slot('header')
                <th>#</th>
                <th>carnet</th>
                <th>alumno</th>
                <th colspan="2">Acciones</th>
            @endslot
            @forelse ($this->alumnos as $alumno)
                <tr>
                    <td data-title="#">{{ $alumno->id }}</td>
                    <td data-title="Carnet">{{ $alumno->carnet }}</td>
                    <td data-title="Alumno">{{ $alumno->nombre }}</td>
                    <td data-title="Accion">
                        <button wire:click="pagar({{ $alumno->id }})" class="btn btn-sm btn-success">
                            Pagar <i class="fas fa-dollar-sign"></i>
                        </button>
                    </td>
                    <td data-title="Accion">
                        <button class="btn btn-sm btn-primary">
                            Ver pagos
                        </button>
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
