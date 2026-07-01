@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center">
    <div
        class="inline-flex items-center p-1.5 rounded-2xl bg-slate-900/40 backdrop-blur-2xl border border-white/10 shadow-2xl">

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <span class="flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 cursor-not-allowed">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
            class="flex items-center justify-center w-10 h-10 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="flex items-center px-2 gap-1">
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <span class="px-2 text-slate-600">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <span aria-current="page"
                class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-500 text-slate-950 font-bold text-sm shadow-[0_0_15px_rgba(16,185,129,0.4)]">
                {{ $page }}
            </span>
            @else
            <a href="{{ $url }}"
                class="flex items-center justify-center w-10 h-10 rounded-xl text-slate-400 font-medium text-sm hover:bg-white/5 hover:text-white transition-all">
                {{ $page }}
            </a>
            @endif
            @endforeach
            @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" rel="next"
            class="flex items-center justify-center w-10 h-10 rounded-xl text-slate-400 hover:bg-white/5 hover:text-white transition-all duration-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
        @else
        <span class="flex items-center justify-center w-10 h-10 rounded-xl text-slate-600 cursor-not-allowed">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </span>
        @endif
    </div>
</nav>
@endif
