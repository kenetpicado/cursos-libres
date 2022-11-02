@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos') }}">Pagos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Efectuados</li>
@endsection
<div class="card">
    <x-header label="Pagos"></x-header>

    <div class="card-body">
        <div class="mb-3">
            <div class="text-secondary mb-2">Mostrando todos los pagos del alumno: </div>
            <h6 class="fw-bolder">{{ $alumno->nombre }}</h6>
        </div>
        <x-table>
            @slot('header')
                <th>concepto</th>
                <th>Curso</th>
                <th>monto</th>
                <th>fecha</th>
                <th>recibo</th>
            @endslot
            @forelse ($pagos as $pago)
                <tr>
                    <td data-title="Concepto">{{ $pago->concepto }}</td>
                    <td data-title="Curso">{{ $pago->curso }}</td>
                    <td data-title="Monto">C$ {{ $pago->monto }}</td>
                    <td data-title="Fecha">{{ $pago->created_at }}</td>
                    <td>
                        <a href="http://" target="_blank">Oficial</a> -
                        <a href="http://" target="_blank">No Oficial</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $pagos->links() }}
    </div>
</div>
