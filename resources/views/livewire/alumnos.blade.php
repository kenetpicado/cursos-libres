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

        <div class="row">
            <div class="col">
                <x-select name="ciudad">
                    <option value="">Seleccionar</option>
                    <option value="LEON">LEON</option>
                    <option value="CHINANDEGA">CHINANDEGA</option>
                </x-select>
            </div>
            <div class="col">
                <x-input name="comunidad"></x-input>
            </div>
        </div>
        <x-input name="direccion"></x-input>

        @if (!$sub_id)
            <x-select name="grupo_id" label="Inscribir a">
                <option value="">Seleccionar Curso</option>
                @foreach ($this->grupos as $grupo)
                    <option value="{{ $grupo->id }}">{{ $grupo->curso }} | {{ $grupo->docente }} |
                        {{ $grupo->horario }}
                    </option>
                @endforeach
            </x-select>
        @endif

    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <x-table>
            @slot('header')
                <th>#</th>
                <th>Carnet</th>
                <th>Fecha matricula</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Acciones</th>
            @endslot
            @forelse ($alumnos as $alumno)
                <tr>
                    <td data-title="#">{{ $alumno->id }}</td>
                    <td data-title="Carnet">{{ $alumno->carnet }}</td>
                    <td data-title="Fecha matricula">{{ $alumno->created_at }}</td>
                    <td data-title="Nombre">{{ $alumno->nombre }}</td>
                    <td data-title="Celular">{{ $alumno->celular }}</td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><button class="dropdown-item" wire:click="edit({{ $alumno->id }})">Editar</button>
                                </li>
                                <li><button class="dropdown-item"
                                        onclick="delete_element('{{ $alumno->id }}', '{{ $alumno->nombre }}')">Eliminar</button>
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
        {{ $alumnos->links() }}
    </div>
</div>
