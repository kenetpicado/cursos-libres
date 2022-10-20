@props(['label' => $name, 'name', 'type' => 'text'])

<div class="mb-3">
    <label class="form-label">{{ ucfirst($label) }}</label>
    <input type={{ $type }} class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" autofocus
        wire:model.defer="{{ $name }}">

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
