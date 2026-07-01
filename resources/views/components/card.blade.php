@props([
    'titleSpan' => FALSE,
    'titleBr' => FALSE,  
    'subTitleSpan' => FALSE,
    'description' => FALSE,
    'iconDown' => '📈',
    'titleSpanColor' => 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20',
    'subTitleSpanColor' => 'text-emerald-400',
])
<div {{ $attributes }} class="group relative overflow-hidden rounded-[2.5rem] p-8 backdrop-blur-2xl transition-all">
    <div class="relative z-10">
        @if($titleSpan)
        <span class="inline-block px-4 py-1 rounded-full text-xs font-bold uppercase mb-4 {{ $titleSpanColor }}">
            {{ $titleSpan }}
        </span>
        @endif
        <h2 class="text-3xl font-bold text-white mb-4 italic leading-tight">
            @if($titleBr)
                {{ $titleBr }} <br/> 
            @endif

            @if($subTitleSpan)
                <span class="{{ $subTitleSpanColor }}">{{ $subTitleSpan }}</span>"
            @endif
        </h2>
        @if($description)
            <p class="text-slate-400 mb-6">{{ $description }}</p>
        @endif
        {{ $text ?? $slot?? '' }}
    </div>
    <!-- Decoración visual de fondo -->
    <div class="absolute -bottom-10 -right-10 text-9xl opacity-5 grayscale group-hover:grayscale-0 transition-all duration-700">{{ $iconDown }}</div>
</div>