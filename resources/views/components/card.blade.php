@props(['label', 'value', 'icon', 'subtitle' => 'Activos'])
<div class="col-lg-3 col-sm-12">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between p-md-1">
                <div class="d-flex flex-row">
                    <div class="align-self-center">
                        <h2 class="h2 mb-0 me-4 fw-bolder">{{ $value }}</h2>
                    </div>
                    <div>
                        <h4 class="fw-bolder">{{ $label }}</h4>
                        <p class="mb-0">{{ $subtitle }}</p>
                    </div>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-{{ $icon }} text-black-50 fa-2x opacity-10"></i>
                </div>
            </div>
        </div>
    </div>
</div>
