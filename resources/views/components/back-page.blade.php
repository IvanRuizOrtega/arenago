@props([
    'path' => FALSE,
    '_id' => NULL
])

<div class="max-w-7xl mx-auto px-4 mt-8 relative z-10">
    <a href="{{ $path ? route($path, is_array($_id) ? $_id : $_id) : url()->previous() }}" 
        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full text-sm font-semibold text-white/70 bg-white/5 border border-white/10 backdrop-blur-md transition-all duration-300 hover:text-white hover:bg-white/10 hover:border-emerald-500/30 hover:shadow-[0_0_20px_rgba(16,185,129,0.15)] group/btn">
        
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" 
                class="w-4 h-4 transition-transform duration-300 group-hover/btn:-translate-x-1">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
        </svg>
        
        <span>Volver</span>
    </a>
</div>