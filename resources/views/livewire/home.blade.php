<div class="card-body">

    <div class="row">
        <x-card>
            <div class="d-flex flex-row">
                <div class="align-self-center">
                    <h2 class="h2 mb-0 me-4 fw-bolder">1</h2>
                </div>
                <div>
                    <h4 class="fw-bolder">Productos</h4>
                    <p class="mb-0">Total</p>
                </div>
            </div>
            <div class="align-self-center">
                <i class="fas fa-dolly-flatbed text-primary fa-3x"></i>
            </div>
        </x-card>

        <x-card>
            <div class="d-flex flex-row">
                <div class="align-self-center">
                    <h2 class="h2 mb-0 me-4 fw-bolder">1</h2>
                </div>
                <div>
                    <h4 class="fw-bolder">Ingresos C$</h4>
                    <p class="mb-0">1</p>
                </div>
            </div>
            <div class="align-self-center">
                <i class="fas fa-dollar-sign text-success fa-3x"></i>
            </div>
        </x-card>

        <x-card>
            <div class="d-flex flex-row">
                <div class="align-self-center">
                    <h2 class="h2 mb-0 me-4 fw-bolder">1</h2>
                </div>
                <div>
                    <h4 class="fw-bolder">Egresos C$</h4>
                    <p class="mb-0">1</p>
                </div>
            </div>
            <div class="align-self-center">
                <i class="fas fa-dollar-sign text-success fa-3x"></i>
            </div>
        </x-card>

        <x-card>
            <div class="d-flex flex-row">
                <div class="align-self-center">
                    <h2 class="h2 mb-0 me-4 fw-bolder">1</h2>
                </div>
                <div>
                    <h4 class="fw-bolder">Ganacias C$</h4>
                    <p class="mb-0">1</p>
                </div>
            </div>
            <div class="align-self-center">
                <i class="fas fa-dollar-sign text-success fa-3x"></i>
            </div>
        </x-card>
    </div>

    {{-- <div class="row">
        <div class="col-lg-6 mb-2">
            <div class="card mb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bolder">Productos</h6>
                </div>
                <div class="card-body">
                    <h4 class="small fw-bolder">
                        DE: JOSIEL
                        <span class="float-end">{{ $owner['JOSIEL'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{ $owner['JOSIEL'] }}%"
                            aria-valuenow="{{ $owner['JOSIEL'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small fw-bolder">
                        DE: ROSA
                        <span class="float-end">{{ $owner['ROSA'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{ $owner['ROSA'] }}%"
                            aria-valuenow="{{ $owner['ROSA'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small fw-bolder">
                        CATEGORIA: ROPA
                        <span class="float-end">{{ $category['ROPA'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $category['ROPA'] }}%"
                            aria-valuenow="{{ $category['ROPA'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small fw-bolder">
                        CATEGORIA: ACCESORIOS
                        <span class="float-end">{{ $category['ACCESORIOS'] }}%</span>
                    </h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar"
                            style="width: {{ $category['ACCESORIOS'] }}%"
                            aria-valuenow="{{ $category['ACCESORIOS'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-2">
            <div class="card mb-2">
                <div class="card-header py-3">
                    <h6 class="m-0 fw-bolder">Propietarios</h6>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item fw-bolder">Josiel</li>
                            <li class="list-group-item">
                                Ingresos
                                <span class="float-end">C$ {{ $by_owner['IN_JOSIEL'] }}</span>
                            </li>
                            <li class="list-group-item">
                                Egresos
                                <span class="float-end">C$ {{ $by_owner['OUT_JOSIEL'] }}</span>
                            </li>
                            <li class="list-group-item">
                                Ganancias
                                <span class="float-end text-primary fw-bolder">C$
                                    {{ $by_owner['IN_JOSIEL'] - $by_owner['OUT_JOSIEL'] }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item fw-bolder">Rosa</li>
                            <li class="list-group-item">
                                Ingresos
                                <span class="float-end">C$ {{ $by_owner['IN_ROSA'] }}</span>
                            </li>
                            <li class="list-group-item">
                                Egresos
                                <span class="float-end">C$ {{ $by_owner['OUT_ROSA'] }}</span>
                            </li>
                            <li class="list-group-item">
                                Ganancias
                                <span class="float-end text-primary fw-bolder">C$
                                    {{ $by_owner['IN_ROSA'] - $by_owner['OUT_ROSA'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
