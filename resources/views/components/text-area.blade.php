@props([
    'name' => '',
    'value' => null,
    'rows' => '4',
    'placeholder' => 'Cuéntanos más...'
])

@php
    $currentValue = old($name, $value);
    $errorClass = $errors->has($name) ? 'border-red-500' : 'border-white/10';
@endphp

<textarea name="{{ $name }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge([
        'class' => "w-full bg-white/5 border $errorClass rounded-xl px-4 py-3 text-white outline-none focus:border-emerald-500/50"
    ]) }}>{{ $currentValue }}
</textarea>