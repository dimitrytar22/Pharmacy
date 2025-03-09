<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-secondary btn-sm text-uppercase px-4 py-2 w-auto']) }}>
    {{ $slot }}
</button>
