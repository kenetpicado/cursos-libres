@props(['label'])

<div wire:ignore.self class="modal" id="modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $label }}</h5>
                <button wire:click="resetFields()" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" wire:click="resetFields()" class="btn btn-primary">Cerrar</button>
                </div>
        </div>
    </div>
</div>
