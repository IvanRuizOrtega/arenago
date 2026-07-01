@props([
    'title' => '¿Eliminar Staff?',
    'description' => 'Esta acción es permanente. El acceso de <span class="text-white font-bold">Carlos Ruiz</span> al sistema será revocado de inmediato.',  
    'forget' => FALSE,
    'alertColor' => 'bg-slate-950/60'
])

<!-- Fondo del Modal (Overlay) -->
<div x-data="{ open: true }" x-show="open" class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6">
    
    <!-- Backdrop con desenfoque extra profundo -->
    <div x-show="open" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         class="fixed inset-0  {{ $alertColor }} backdrop-blur-2xl"></div>

    <!-- Contenedor del Modal -->
    <div x-show="open" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         class="relative w-full max-w-lg overflow-hidden glass rounded-[3rem] border border-white/20 bg-white/5 p-8 shadow-2xl">
        
        <!-- Icono de Advertencia Brillante -->
        <!-- <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-red-500/10 text-red-500 shadow-[0_0_20px_rgba(239,68,68,0.2)]">
            <svg xmlns="http://w3.org" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </div> -->

        <!-- Contenido -->
        <div class="mt-6 text-center">
            @if($title)
            <h3 class="text-2xl font-bold text-white italic">{{ $title }}</h3>
            @endif
            @if($description)
            <p class="mt-3 text-sm text-slate-400">
                {!! $description !!}
            </p>
            @endif
        </div>

        <!-- Acciones -->
        <div class="mt-10 flex flex-col sm:flex-row gap-3">
            <button @click="open = false" 
                    class="flex-1 rounded-2xl border border-white/10 bg-white/5 py-4 text-sm font-bold text-slate-300 transition-all hover:bg-white/10">
                Cerrar
            </button>
            @if($forget)
            <button class="flex-1 rounded-2xl bg-red-500 py-4 text-sm font-bold text-white shadow-lg shadow-red-500/30 transition-all hover:bg-red-400 hover:shadow-red-500/50">
                Sí, eliminar
            </button>
            @endif
        </div>
    </div>
</div>
