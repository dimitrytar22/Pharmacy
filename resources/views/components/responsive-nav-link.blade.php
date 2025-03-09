@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'nav-link active text-indigo-700 bg-indigo-50 border-start-4 border-indigo-400'
                : 'nav-link text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
