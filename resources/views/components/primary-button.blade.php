<button {{ $attributes->merge(['type' => 'submit', 'class' => 'custom-button']) }}>
    {{ $slot }}
</button>