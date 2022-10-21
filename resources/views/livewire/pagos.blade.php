<div class="card">
    <x-header-modal label="Pagos"></x-header-modal>

    <x-modal label="Crear un pago">
        <x-select name="alumno_id" label="Alumno">
            <option value="">Seleccionar Alumno</option>
            @foreach ($this->Alumno as $alumno)
                <option value="{{ $alumno->id }}">{{ $alumno->nombre }}</option>
            @endforeach
        </x-select>
        <x-input name="concepto"></x-input>
        <x-input name="Monto" type="number"></x-input>   
        <x-input name="Recibi de"></x-input>
    

    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <x-table>
            @slot('header')
                <th>#</th>
                <th>alumno</th>
                <th>carnet</th>
                <th>concepto</th>
                <th>monto</th>
                <th>recibi de</th>
                <th>fecha de pago</th>
                <th>Acciones</th>
            @endslot
            @forelse ($pagos as $pago)
                <tr>
                    <td data-title="#">{{ $pago->id }}</td>
                    <td data-title="Alumno">{{ $pago->alumno }}</td>
                    <td data-title="Carnet">{{ $pago->carnet }}</td>
                    <td data-title="Concepto">{{ $pago->concepto}}</td>
                    <td data-title="Monto">{{ $pago->monto }}</td>
                    <td data-title="Recibi de">{{ $pago->recibi_de }}</td>
                    <td data-title="Fecha de pago">{{ $pago->created_at }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" wire:click="edit({{ $pago->id }})">Editar</button>
                                </li>
                                <li><button class="dropdown-item"
                                        onclick="delete_element('{{ $pago->id }}', '{{ $pago->nombre }}')">Eliminar</button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $pagos->links() }}
    </div>
</div>