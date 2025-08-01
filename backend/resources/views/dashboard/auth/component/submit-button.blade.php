@props([
    'text' => 'Submit',
    'icon' => 'fas fa-check',
    'class' => 'btn-primary'
])

<div class="d-grid mb-3">
    <button type="submit" class="btn {{ $class }} btn-auth">
        <i class="{{ $icon }} me-2"></i>{{ $text }}
    </button>
</div> 