@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos') }}">Grupos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
@endsection

<div class="card">
    <x-header-modal label="Grupo" btn="Agregar Alumno" modal="modal2"></x-header-modal>

    <x-modal2 label="Agregar Alumno al Grupo">
        @if (session()->has('added'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('added') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('exist'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('exist') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <input class="form-control mb-4" type="search" placeholder="Buscar alumno" wire:model="search">
        <x-table>
            @slot('header')
                <th>Carnet</th>
                <th>Nombre</th>
                <th class="text-end">Acción</th>
            @endslot
            @forelse ($this->results as $result)
                <tr>
                    <td class="small-font" data-title="Carnet">{{ $result->carnet }}</td>
                    <td class="small-font" data-title="Nombre">{{ $result->nombre }}</td>
                    <td class="text-end" data-title="Acción"><button class="btn btn-sm btn-primary"
                            wire:click="$emit('inscribir', {{ $result->id }})">Agregar</button></td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center small-font">No hay coincidencias</td>
                </tr>
            @endforelse
        </x-table>
    </x-modal2>

    <button type="button" id="btn-open-modal-pagar" class="d-none" data-bs-toggle="modal" data-bs-target="#createModal"></button>

    <x-modal label="Pagar">
        <div class="mb-2">Registrar nuevo pago del alumno:</div>
        <h6 class="mb-3">{{ $this->alumno->nombre ?? '' }}</h6>
        <x-input name="concepto"></x-input>
        <div class="row">
            <div class="col">
                <x-input name="monto" type="number"></x-input>
            </div>
            <div class="col">
                <x-input name="recibi_de" label="Recibi de"></x-input>
            </div>
        </div>
        
    </x-modal>

    <div class="card-body">
        <x-message></x-message>

        <div class="my-3">
            <div class="text-secondary mb-2">Mostrando todos los alumnos del curso: </div>
            <h6 class="fw-bolder">{{ $this->grupo->curso }}</h6>
            <h6>Horario: {{ $this->grupo->horario }}</h6>
            <h6>Docente: {{ $this->grupo->docente }}</h6>
        </div>

        <x-table>
            @slot('header')
                <th>Carnet</th>
                <th>Nombre</th>
                <th>Acción</th>
                <th>Acciones</th>
            @endslot
            @forelse ($this->alumnos as $alumno)
                <tr>
                    <td data-title="Carnet">{{ $alumno->carnet }}</td>
                    <td data-title="Nombre">{{ $alumno->nombre }}</td>
                    <td>
                        <button wire:click="pagar({{ $alumno->alumno_id }})" class="btn btn-sm btn-primary">
                            Pagar
                        </button>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('pagos.show', $alumno->id) }}">
                                        Ver pagos
                                    </a>
                                </li>
                                {{-- <li><button class="dropdown-item" wire:click="edit({{ $alumno->id }})">Editar</button></li> --}}
                                <li>
                                    <button class="dropdown-item"
                                        onclick="delete_element('{{ $alumno->id }}', '{{ $alumno->nombre }}')">Eliminar
                                        del grupo</button>
                                </li>
                               
                            </ul>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $this->alumnos->links() }}
    </div>
</div>
