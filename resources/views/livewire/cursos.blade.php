<div class="card">
    <x-header-modal label="Cursos"></x-header-modal>

    <x-modal label="Agregar Curso">
        <x-input name="nombre"></x-input>

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
                <th>Estado</th>
                <th>Acción</th>
                <th>Acción</th>
            @endslot
            @forelse ($cursos as $curso)
                <tr>
                    <td data-title="ID">{{ $curso->id }}</td>
                    <td data-title="Nombre">{{ $curso->nombre }}</td>
                    <td data-title="Estado">{{ $curso->estado ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <button wire:click="edit({{ $curso->id }})" class="btn btn-sm btn-primary">Editar</button>
                    </td>
                    <td> <button
                            onclick="delete_element('{{ $curso->id }}', '{{ $curso->nombre }}')" type="button"
                            class="btn btn-sm btn-secondary">Eliminar</button></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $cursos->links() }}
    </div>
</div>
