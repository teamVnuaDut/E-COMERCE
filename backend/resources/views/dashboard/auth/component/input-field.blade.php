@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'icon' => '',
    'required' => false,
    'value' => null
])

<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <div class="input-group">
        @if($icon)
            <span class="input-group-text">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <input type="{{ $type }}" 
               class="form-control @error($name) is-invalid @enderror" 
               id="{{ $name }}" 
               name="{{ $name }}" 
               value="{{ $value ?? old($name) }}" 
               placeholder="{{ $placeholder }}"
               {{ $required ? 'required' : '' }}
               {{ $attributes }}>
        @if($type === 'password')
            <button class="btn btn-outline-secondary password-toggle" type="button" onclick="togglePassword('{{ $name }}')">
                <i class="fas fa-eye"></i>
            </button>
        @endif
    </div>
    @error($name)
        <div class="invalid-feedback d-block">
            {{ $message }}
        </div>
    @enderror
</div> 