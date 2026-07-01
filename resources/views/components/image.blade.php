@props([
    'path' => '',
    'width' => '9',  
    'height' => '9',
    'isAsset' => TRUE
])
<img {{ $attributes }} src="{{ $isAsset ? asset($path) : $path }}" class="w-{{ $width }} h-{{ $height }}">