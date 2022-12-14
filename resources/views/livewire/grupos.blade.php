@section('bread')
    <li class="breadcrumb-item active" aria-current="page">Grupos</li>
@endsection

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
            <div class="col">
                <x-input name="anyo" label="Año"></x-input>
            </div>
            <div class="col">
                <x-input name="horario"></x-input>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <x-input name="duracion"></x-input>
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
                <th>ID</th>
                <th>Curso</th>
                <th>Docente</th>
                <th>Año / Horario</th>
                <th>Alumnos</th>
                <th>Acción</th>
            @endslot

            @forelse ($this->grupos as $grupo)
                <tr>
                    <td data-title="ID">{{ $grupo->id }}</td>
                    <td data-title="Curso">
                        @if ($grupo->estado == 1)
                            <i class="fas fa-circle fa-xs text-primary"></i>
                        @else
                            <i class="fas fa-circle fa-xs text-danger"></i>
                        @endif

                        {{ $grupo->curso }}
                    </td>
                    <td data-title="Docente">{{ $grupo->docente }}</td>
                    <td data-title="Año / Horario">{{ $grupo->anyo }} / {{ $grupo->horario }}</td>
                    <td data-title="Alumnos">
                        <a href="{{ route('grupos.show', $grupo->id) }}"
                            class="btn btn-sm btn-primary"> {{ $grupo->alumnos_count }}</a>
                    </td>
                    <td>
                        <div class="m-0 p-0">
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Acciones
                                </button>
                                <ul class="dropdown-menu">
                                    <li><button class="dropdown-item"
                                            wire:click="edit({{ $grupo->id }})">Editar</button>
                                    </li>
                                    <li><button class="dropdown-item"
                                            onclick="delete_element('{{ $grupo->id }}', '{{ $grupo->curso }} {{ $grupo->horario }}')">Eliminar</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $this->grupos->links() }}
    </div>
</div>
