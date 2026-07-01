@extends('layouts.app')

@section('content')
@php
    // Capturamos los estados actuales de los filtros desde la URL
    $currentResponsableId = request()->query('responsable_id');
    $currentDate = request()->query('fecha', now()->toDateString());
    
    $currentResponsableName = 'Todos los Responsables';
    if ($currentResponsableId && isset($responsables)) {
        $selectedUser = collect($responsables)->firstWhere('id', $currentResponsableId);
        if ($selectedUser) {
            $currentResponsableName = is_array($selectedUser) ? $selectedUser['name'] : $selectedUser->name;
        }
    }
@endphp

<div class="py-8 px-4 animate-in fade-in duration-500" 
     x-data="{ 
        fecha: '{{ $currentDate }}',
        responsable: '{{ $currentResponsableId }}',
        triggerFilter() {
            window.location.href = `{{ request()->url() }}?fecha=${this.fecha}&responsable_id=${this.responsable}`;
        }
     }">
    <div class="max-w-7xl mx-auto">
        
        <!-- HEADER DE CONTROL Y FILTROS -->
        <header class="flex flex-col lg:flex-row lg:items-end justify-between gap-4 mb-8 px-2">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                    <h2 class="text-3xl font-bold text-white tracking-tight">{{ \Src\Resources\Constants\Headers::getKeys()[2] ?? 'Panel de Control' }}</h2>
                </div>
                <p class="text-xs text-slate-400">Monitoreo de canchas operadas, estados y recaudo de caja en tiempo real.</p>
            </div>
            
            <!-- BARRA DE FILTROS BIFUNCIONAL -->
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full sm:w-auto self-start lg:self-auto">
                
                <!-- 1. Filtro de Fecha Nativo Estilizado -->
                <div class="relative w-full sm:w-44">
                    <input type="date" 
                           x-model="fecha" 
                           @change="triggerFilter()"
                           class="w-full px-4 py-2 rounded-xl text-xs font-bold bg-white/5 border border-white/10 text-white focus:outline-none focus:border-emerald-500/50 transition-all font-mono appearance-none"
                           style="color-scheme: dark;">
                </div>

                <!-- 2. Filtro Dropdown de Responsables -->
                <div class="relative inline-block text-left w-full sm:w-56" x-data="{ open: false }">
                    <button @click="open = !open" 
                            @click.away="open = false"
                            type="button"
                            class="inline-flex items-center justify-between w-full px-4 py-2 rounded-xl text-xs font-bold bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-all duration-200">
                        <span class="flex items-center gap-2 truncate">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-400 shrink-0">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <span class="truncate">{{ $currentResponsableName }}</span>
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 text-white/50 transition-transform duration-200 shrink-0" :class="open ? 'rotate-180' : ''">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-full sm:w-56 max-h-60 overflow-y-auto rounded-xl bg-slate-950 border border-white/10 shadow-2xl z-50 p-1.5 scrollbar-thin scrollbar-thumb-white/10"
                         style="display: none;">
                        
                        <!-- Opción "Todos" -->
                        <button @click="responsable = ''; triggerFilter(); open = false"
                                class="w-full text-left px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center justify-between {{ !$currentResponsableId ? 'bg-emerald-500 text-slate-950 font-bold' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                            <span>Todos los Responsables</span>
                            @if(!$currentResponsableId) <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span> @endif
                        </button>

                        <div class="h-px bg-white/5 my-1"></div>

                        <!-- Lista Dinámica de Usuarios -->
                        @foreach($users ?? [] as $user)
                            <button @click="responsable = '{{ $user['username'] }}'; triggerFilter(); open = false"
                                    class="w-full text-left px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center justify-between {{ $currentResponsableId == $user['username'] ? 'bg-emerald-500 text-slate-950 font-bold' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                                <span class="truncate">{{ $user['name'] }}</span>
                                @if($currentResponsableId == $user['username']) <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span> @endif
                            </button>
                        @endforeach
                    </div>
                </div>

            </div>
        </header>

        <!-- INDICADORES CLAVE (KPI CARDS) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="rounded-[2rem] bg-gradient-to-br from-slate-900/50 to-slate-900/30 backdrop-blur-3xl border border-white/10 p-6 flex items-center justify-between shadow-xl group hover:border-white/10 transition-all duration-300">
                <div class="space-y-2">
                    <span class="text-[10px] font-bold uppercase text-slate-500 tracking-widest block">Canchas Atendidas</span>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-black text-white tracking-tight">{{ $completed_matches_count }}</span>
                        <span class="text-xs font-semibold text-slate-400">/ {{ $total_matches_count }} asignadas</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-white/80 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </div>
            </div>

            <div class="rounded-[2rem] bg-gradient-to-br from-slate-900/50 to-slate-900/30 backdrop-blur-3xl border border-white/10 p-6 flex items-center justify-between shadow-xl group hover:border-emerald-500/20 transition-all duration-300">
                <div class="space-y-2">
                    <span class="text-[10px] font-bold uppercase text-slate-500 tracking-widest block">Total Recaudado (Caja)</span>
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl font-black text-emerald-400 tracking-tight">
                            ${{ number_format($total_revenue, 0, ',', '.') }}
                        </span>
                        <span class="text-xs font-bold text-emerald-500/70 font-mono">COP</span>
                    </div>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center text-emerald-300 shadow-inner group-hover:scale-105 transition-transform duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5h16.5M5.25 7.5h13.5m-12 9h12m-9.75 0H18a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 18 4.5H5.25a2.25 2.25 0 0 0-2.25 2.25v7.5a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- DETALLE DE RESERVAS (TABLA) -->
        <div class="rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 overflow-hidden shadow-2xl">
            <div class="p-6 bg-white/5 border-b border-white/5 flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase text-slate-400 tracking-wider">Cronograma de Partidos</h3>
                <span class="text-[10px] bg-white/5 border border-white/10 text-emerald-400 px-2.5 py-1 rounded-md font-mono font-bold">
                    {{ \Carbon\Carbon::parse($currentDate)->translatedFormat('d M, Y') }}
                </span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/[0.02]">
                            <th class="p-5 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Horario / Cancha</th>
                            <th class="p-5 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Centro Deportivo</th>
                            <th class="p-5 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Pago Recibido</th>
                            <th class="p-5 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Estado</th>
                            <th class="p-5 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5 text-right">Responsable</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($today_bookings as $booking)
                        <tr class="hover:bg-white/[0.02] transition-colors group">
                            <td class="p-5">
                                <div class="flex items-center gap-3">
                                    <div class="px-2.5 py-1.5 rounded-lg bg-slate-950/80 border border-white/10 text-xs font-mono font-bold text-emerald-400">
                                        {{ $booking->get_date() }}
                                    </div>
                                    <div>
                                        <span class="block text-sm font-semibold text-white">{{ $booking->get_playing_field_name() }}</span>
                                        <span class="text-[10px] text-slate-500">#{{ $booking->get_playing_field_id() }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-5 text-xs text-slate-300 font-medium">
                                {{ $booking->get_sport_center_address() }}
                            </td>
                            <td class="p-5">
                                <span class="text-sm font-mono font-bold text-white">
                                    ${{ number_format($booking->get_total_price(), 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="p-5">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-white/10 text-white border border-white/20 text-[10px] font-bold uppercase tracking-tight">
                                    <span class="w-1 h-1 rounded-full bg-white"></span> {{ $booking->get_status_trans() }}
                                </span>
                            </td>
                            <td class="p-5 text-xs text-slate-400 text-right font-medium">
                                {{ $booking->get_attendant_name() }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-12 text-center text-xs text-slate-500 font-medium">
                                No se encontraron turnos o reservas registradas para los criterios seleccionados.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection