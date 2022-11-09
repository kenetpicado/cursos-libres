@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Docentes</li>
@endsection
<div class="card">
    <x-header-modal label="Docentes"></x-header-modal>

    <x-modal label="Agregar Docente">
        <x-input name="nombre"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="celular" type="number"></x-input>
            </div>
            <div class="col">
                <x-select name="tipo_pago" label="Tipo de pago">
                    <option value="PORCENTAJE">PORCENTAJE</option>
                    <option value="FIJO">FIJO</option>
                </x-select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <x-input name="viatico"></x-input>
            </div>
            <div class="col-lg-6">
                <x-select name="estado">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </x-select>
            </div>
        </div>
    </x-modal>

    <div class="card-body">
        <div class="row gy-3 mb-3">
            <div class="col-lg-3">
                <input class="form-control" type="search" placeholder="Buscar" wire:model="search">
            </div>
            <div class="col-lg-3">
                <select class="form-control" wire:model="estado_search">
                    <option value="1">Activos</option>
                    <option value="false">Inactivos</option>
                </select>
            </div>
        </div>

        <x-table>
            @slot('header')
                <th>Nombre</th>
                <th>Celular</th>
                <th>Acción</th>
                <th>Acción</th>
            @endslot
            @forelse ($docentes as $docente)
                <tr>
                    <td data-title="Nombre">
                        @if ($docente->estado == 1)
                            <i class="fas fa-circle fa-xs text-primary"></i>
                        @else
                            <i class="fas fa-circle fa-xs text-danger"></i>
                        @endif
                        {{ $docente->nombre }}
                    </td>
                    <td data-title="Celular">{{ $docente->celular }}</td>
                    <td>
                        <button wire:click="edit({{ $docente->id }})" class="btn btn-sm btn-primary">Editar</button>
                    </td>
                    <td> <button onclick="delete_element('{{ $docente->id }}', '{{ $docente->nombre }}')"
                            type="button" class="btn btn-sm btn-secondary">Eliminar</button></td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $docentes->links() }}
    </div>
</div>
