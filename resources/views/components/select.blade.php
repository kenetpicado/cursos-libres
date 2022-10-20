@props(['label' => $name, 'name', 'type' => 'text', 'val' => ''])

<div class="mb-3">
    <label class="form-label">{{ ucfirst($label) }}</label>

    <select wire:model.defer="{{ $name }}" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror">
        {{$slot}}
    </select>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
