@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-1 pt-1 border-bottom-2 border-primary text-sm font-medium text-dark focus:outline-none focus:border-primary transition duration-150 ease-in-out'
                : 'inline-flex items-center px-1 pt-1 border-bottom-2 border-transparent text-sm font-medium text-muted hover:text-dark hover:border-muted focus:outline-none focus:text-dark focus:border-muted transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
