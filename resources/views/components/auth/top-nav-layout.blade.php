@props(['active' => false])

<a class="{{ $active ? 'nav-link active' : 'nav-link' }} {{ $attributes->get('class', '') }}"
    aria-current="{{ $active ? 'current' : 'false' }}" {{ $attributes->except('class') }}>
    <span class="flex items-center">
        {{ $slot }}
    </span>
</a>
