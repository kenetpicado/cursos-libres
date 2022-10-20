<div class="card">
    <x-header-modal label="Docentes"></x-header-modal>

    <x-modal label="Agregar Docente">
        <x-input name="nombre"></x-input>
        <x-input name="celular" type="number"></x-input>

        <x-select name="tipo_pago" label="Tipo de pago">
            <option value="PORCENTAJE">PORCENTAJE</option>
            <option value="FIJO">FIJO</option>
        </x-select>

        <x-input name="viatico"></x-input>
        <x-select name="estado">
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </x-select>
    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <x-table>
            @slot('header')
                <th>ID</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Estado</th>
                <th>Acción</th>
                <th>Acción</th>
            @endslot
            @forelse ($docentes as $docente)
                <tr>
                    <td data-title="ID">{{ $docente->id }}</td>
                    <td data-title="Nombre">{{ $docente->nombre }}</td>
                    <td data-title="Celular">{{ $docente->celular }}</td>
                    <td data-title="Estado">{{ $docente->estado ? 'Activo' : 'Inactivo' }}</td>
                    <td data-title="Acción">
                        <button wire:click="edit({{ $docente->id }})" class="btn btn-sm btn-primary">Editar</button>
                    </td>
                    <td data-title="Acción"> <button
                        onclick="delete_element('{{ $docente->id }}', '{{ $docente->nombre }}')" type="button"
                        class="btn btn-sm btn-secondary">Eliminar</button></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $docentes->links() }}
    </div>
</div>
