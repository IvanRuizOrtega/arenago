<button {{ $attributes }} type="{{ $type ?? 'button' }}" 
    class="cursor-pointer 
        w-full 
        glass 
        bg-emerald-500 
        py-4 
        rounded-2xl 
        flex 
        items-center 
        justify-center 
        gap-3 
        hover:brightness-110 
        transition-all 
        font-semibold 
        text-sm">
	{{ $text ?? $slot?? '' }}
</button>