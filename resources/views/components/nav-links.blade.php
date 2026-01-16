@props(['active' => false])

<a class="{{ $active ? 'text-white bg-sky-500' : 'hover:bg-sky-400/90 hover:text-white' }} flex items-center rounded-radius gap-2 px-2 mx-2 py-1.5 text-sm font-medium underline-offset-2 focus-visible:underline focus:outline-hidden duration-200"
    aria-current="{{ $active ? 'current' : 'false' }}" {{ $attributes }}>
    <span class="flex items-center">
        {{ $slot }}
    </span>
</a>
