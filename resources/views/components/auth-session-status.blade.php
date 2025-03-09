@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-success small']) }}>
        {{ $status }}
    </div>
@endif
