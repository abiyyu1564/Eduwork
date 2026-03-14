<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150']) }} style="background: linear-gradient(135deg, #6C5CE7, #5A4BD1); --tw-ring-color: #A29BFE;">
    {{ $slot }}
</button>
