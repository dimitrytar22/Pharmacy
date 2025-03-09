@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-danger list-unstyled ps-0']) }}>
        @foreach ((array) $messages as $message)
            <li class="text-danger">{{ $message }}</li>
        @endforeach
    </ul>
@endif
