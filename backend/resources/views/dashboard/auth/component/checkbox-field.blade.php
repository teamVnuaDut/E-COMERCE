@props([
    'name',
    'label',
    'required' => false,
    'checked' => false
])

<div class="mb-3 form-check">
    <input type="checkbox" 
           class="form-check-input @error($name) is-invalid @enderror" 
           id="{{ $name }}" 
           name="{{ $name }}" 
           {{ $required ? 'required' : '' }}
           {{ $checked ? 'checked' : '' }}
           {{ $attributes }}>
    <label class="form-check-label" for="{{ $name }}">
        {!! $label !!}
    </label>
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div> 