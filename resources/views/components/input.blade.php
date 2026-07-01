@props([
    'name' => '',
    'type' => 'text',
    'placeholder' => '',
    'value' => null
])

@php
    $currentValue = old($name, $value);
    $errorClass = $errors->has($name) ? 'border-red-500' : 'border-white/10';
@endphp

<input {{ $attributes->merge([
            'class' => "w-full bg-white/5 border $errorClass rounded-xl px-4 py-3 text-white outline-none focus:border-emerald-500/50"
        ]) }}
    type="{{ $type }}" 
    name="{{ $name }}"
    value="{{ $currentValue }}"
    placeholder="{{ $placeholder }}" />
