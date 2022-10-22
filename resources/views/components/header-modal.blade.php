@props(['label', 'btn' => 'Agregar', 'modal' => 'createModal'])

<div class="card-header d-flex justify-content-between align-items-center">
    <div class="fw-bolder"> {{ __($label) }}</div>
    <button type="button" id="btn-open-modal" class="btn btn-primary btn-sm" data-bs-toggle="modal"
        data-bs-target="#{{ $modal }}">
        {{ $btn }}
    </button>
</div>
