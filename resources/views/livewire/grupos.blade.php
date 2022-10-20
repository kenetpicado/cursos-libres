<div class="card">
    <x-header-modal label="Grupos"></x-header-modal>

    <x-modal label="Agregar Grupo">
        <x-select name="curso_id" label="Curso">
            <option value="">Seleccionar Curso</option>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
            @endforeach
        </x-select>
        <x-select name="docente_id" label="Docente">
            <option value="">Seleccionar Docente</option>
            @foreach ($docentes as $docente)
                <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
            @endforeach
        </x-select>
        <x-input name="anyo" label="Año"></x-input>
        <x-input name="horario"></x-input>
        <x-input name="duracion"></x-input>
    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <x-table>
            @slot('header')
                <th>Curso</th>
                <th>Docente</th>
                <th>Año</th>
                <th>Horario</th>
                <th>Acción</th>
            @endslot
            @forelse ($grupos as $grupo)
                <tr>
                    <td data-title="Curso">{{ $grupo->curso }}</td>
                    <td data-title="Docente">{{ $grupo->docente }}</td>
                    <td data-title="Año">{{ $grupo->anyo }}</td>
                    <td data-title="Horario">{{ $grupo->horario }}</td>
                    <td data-title="Acción">
                        <button wire:click="edit({{ $grupo->id }})" class="btn btn-sm btn-primary">Editar</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $grupos->links() }}
    </div>
</div>
