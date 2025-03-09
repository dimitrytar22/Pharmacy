<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn btn-outline-secondary text-xs font-semibold uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
