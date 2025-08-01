@props([
    'href' => '#',
    'text' => 'Back',
    'icon' => 'fas fa-arrow-left'
])

<div class="text-center">
    <p class="mb-0">
        <a href="{{ $href }}" class="text-decoration-none">
            <i class="{{ $icon }} me-1"></i>{{ $text }}
        </a>
    </p>
</div> 