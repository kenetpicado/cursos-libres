<div class="card">
    <x-header-modal label="Alumnos"></x-header-modal>

    <x-modal label="Agregar Alumno">
        <x-input name="nombre"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="edad" type="number"></x-input>
            </div>
            <div class="col">
                <x-input name="celular" type="number"></x-input>
            </div>
        </div>
        <x-input name="ciudad"></x-input>
        <x-input name="comunidad"></x-input>
        <x-input name="direccion"></x-input>
    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <x-table>
            @slot('header')
                <th>#</th>
                <th>Nombre</th>
                <th>Carnet</th>
                <th>Celular</th>
                <th>Fecha matricula</th>
                <th>Acción</th>
                <th>Acción</th>
            @endslot
            @forelse ($alumnos as $alumno)
                <tr>
                    <td data-title="ID">{{ $alumno->id }}</td>
                    <td data-title="Nombre">{{ $alumno->nombre }}</td>
                    <td data-title="Carnet">{{ $alumno->carnet }}</td>
                    <td data-title="Celular">{{ $alumno->celular }}</td>
                    <td data-title="Fecha matricula">{{ $alumno->created_at }}</td>
                    <td data-title="Acción">
                        <button wire:click="edit({{ $alumno->id }})" class="btn btn-sm btn-primary">Editar</button>
                    </td>
                    <td data-title="Acción"> <button
                        onclick="delete_element('{{ $alumno->id }}', '{{ $alumno->nombre }}')" type="button"
                        class="btn btn-sm btn-secondary">Eliminar</button></td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $alumnos->links() }}
    </div>
</div>
