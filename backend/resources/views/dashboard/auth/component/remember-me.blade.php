@props([
    'name' => 'remember',
    'label' => 'Nhớ tôi'
])

<div class="mb-3 form-check">
    <input type="checkbox" 
           class="form-check-input" 
           id="{{ $name }}" 
           name="{{ $name }}"
           {{ $attributes }}>
    <label class="form-check-label" for="{{ $name }}">
        {{ $label }}
    </label>
</div> 