@props([
    'name' => '',
    'options' => [],
    'value' => null
])

@php
    $selectedValue = old($name, $value);
    $errorClass = $errors->has($name) ? 'border-red-500' : 'border-white/10';
@endphp

<select name="{{ $name }}" {{ $attributes->merge([
        'class' => 'w-full bg-white/5 border $errorClass rounded-xl px-4 py-3 text-white outline-none focus:border-emerald-500/50 appearance-none cursor-pointer'
    ])}}>
    @foreach($options as $optionValue => $label)
    <option value="{{ $optionValue }}" {{ $selectedValue==$optionValue ? 'selected' : '' }} class="bg-slate-900">
        {{ $label }}
    </option>
    @endforeach
</select>
