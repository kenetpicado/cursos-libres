<div class="card">
    <x-header-modal label="Grupos"></x-header-modal>

    <x-modal label="Agregar Grupo">
        <x-select name="curso_id" label="Curso">
            <option value="">Seleccionar Curso</option>
            @foreach ($this->cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
            @endforeach
        </x-select>
        <x-select name="docente_id" label="Docente">
            <option value="">Seleccionar Docente</option>
            @foreach ($this->docentes as $docente)
                <option value="{{ $docente->id }}">{{ $docente->nombre }}</option>
            @endforeach
        </x-select>
        <div class="row">
            <div class="col"><x-input name="anyo" label="Año"></x-input></div>
            <div class="col"> <x-input name="horario"></x-input></div>
        </div>
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
                <th>Alumnos</th>
                <th>Acción</th>
            @endslot
            @forelse ($grupos as $grupo)
                <tr>
                    <td data-title="Curso">{{ $grupo->curso }}</td>
                    <td data-title="Docente">{{ $grupo->docente }}</td>
                    <td data-title="Año">{{ $grupo->anyo }}</td>
                    <td data-title="Horario">{{ $grupo->horario }}</td>
                    <td data-title="Alumnos">
                        <a href="{{route('grupos.show', $grupo->id)}}" class="btn btn-sm btn-primary">{{ $grupo->inscripciones_count }}</a>
                    </td>
                    <td data-title="Acción">
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" wire:click="edit({{ $grupo->id }})">Editar</button>
                                </li>
                                <li><button class="dropdown-item"
                                        onclick="delete_element('{{ $grupo->id }}', '{{ $grupo->curso }} {{$grupo->horario }}')">Eliminar</button>
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
        {{ $grupos->links() }}
    </div>
</div>
