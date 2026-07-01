 <div x-data="{ open: false, activeRole: '{{ authCurrentRole() }}'  }" 
    class="fixed z-50 
        bottom-6 right-6 
        md:top-1/2 md:-translate-y-1/2 md:bottom-auto"> <div class="relative flex items-center justify-end">
    
    <div x-show="open" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4 md:translate-y-0 md:translate-x-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0 md:translate-x-0"
            x-transition:leave="transition ease-in duration-200"
            @click.away="open = false"
            class="absolute bottom-16 right-0 md:bottom-auto md:right-16 
                w-60 p-3 rounded-2xl
                bg-slate-900/40 backdrop-blur-2xl 
                border border-white/10 shadow-2xl shadow-black/50">
        
        <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-3 px-2">
            Modo de vista <span class="text-emerald-400/60 text-xs font-bold">{{ getPropertyAuth(property: 'username')}}</span>
        </p>
        
        <nav class="space-y-1.5">
            @foreach(authRole() as $role)
                @php
                    $keyRole = $role['key'] ?? NULL; 
                    $isClient = (\Src\Resources\Constants\Roles::CLIENT == $keyRole);
                    $activeClasses = $isClient ? 'bg-blue-500/10 border-blue-500/40 text-blue-400' : 'bg-emerald-500/10 border-emerald-500/40 text-emerald-400';
                    $dotClasses = $isClient ? 'bg-blue-400' : 'bg-emerald-400';
                @endphp
            <button @click="
                    activeRole = '{{ $keyRole }}'; 
                    open = false; 
                    changeRole('{{ route(\Src\Resources\Constants\Routes::CHANGE_ROLE) }}', '{{ $keyRole }}')
                "
                :class="activeRole === '{{ $keyRole }}' ? '{{ $activeClasses }}' : 'text-slate-400 border-transparent hover:bg-white/5'"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl border transition-all duration-200">
                <div :class="activeRole === '{{ $keyRole }}' ? '{{ $dotClasses }} animate-pulse' : 'bg-slate-600'" class="w-1.5 h-1.5 rounded-full"></div>
                <span class="text-sm font-medium">{{ $role['name'] ?? '' }}</span>
            </button>
            @endforeach
        </nav>
    </div>

    <button @click="open = !open" 
            :class="open ? 'ring-4 ring-emerald-500/20' : ''"
            class="relative w-14 h-14 rounded-2xl bg-slate-900 border border-white/10 
                    flex items-center justify-center transition-all duration-300 
                    hover:border-emerald-500/50 group shadow-xl">
        
        <div class="relative w-6 h-6">
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="absolute inset-0 w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="absolute inset-0 w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </div>

        <div class="absolute inset-0 rounded-2xl bg-emerald-500/10 blur-xl group-hover:bg-emerald-500/20 transition-all"></div>
    </button>
</div>

@push('scripts')
  @vite(['resources/js/change-role.js'])
@endpush