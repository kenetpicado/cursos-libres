@section('bread')
    <li class="breadcrumb-item"><a href="{{ route('grupos') }}">Pagos</a></li>
    <li class="breadcrumb-item active" aria-current="page">Efectuados</li>
@endsection
<div class="card">
    <x-header label="Pagos"></x-header>

    <div class="card-body">
        <x-message></x-message>

        <div class="my-3">
            <div class="text-secondary mb-2">Mostrando todos los pagos del alumno: </div>
            <h6 class="fw-bolder">{{ $this->alumno->nombre }}</h6>
        </div>

        <x-table>
            @slot('header')
                <th>concepto</th>
                <th>monto</th>
                <th>fecha</th>
                <th>recibo</th>
            @endslot
            @forelse ($this->pagos as $pago)
                <tr>
                    <td data-title="Concepto">{{ $pago->concepto }}</td>
                    <td data-title="Monto">C$ {{ $pago->monto }}</td>
                    <td data-title="Fecha">{{ $pago->created_at }}</td>
                    <td>
                        <a href="http://" target="_blank">Recibo oficial</a> |
                        <a href="http://" target="_blank">Recibo no oficial</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">No hay registros</td>
                </tr>
            @endforelse
        </x-table>
        {{ $this->pagos->links() }}
    </div>
</div>
