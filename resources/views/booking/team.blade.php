@extends('layouts.app') 
<script>
    window.bookingId = {{ $booking_id ?? null }};
    window.currentUserId = {{ auth()->id() ?? null }};
</script>
@section('content')
<div class="view py-8 px-4 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto">
        
        <div x-data="matchMaker()" class="p-8 rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 relative overflow-hidden shadow-2xl">
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 blur-[80px] pointer-events-none"></div>

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 relative z-10">
                <div>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Creador de Equipos Balanceado
                    </span>
                    <p class="text-white/40 text-xs mt-0.5">Asigna a los jugadores convocados a su respectivo equipo antes de iniciar el partido.</p>
                </div>

                <form action="{{ route(\Src\Resources\Constants\Routes::BOOKING_TEAM_UPDATE, $booking_id??NULL) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="team_a" :value="JSON.stringify(teamA.map(p => p.id))">
                    <input type="hidden" name="team_b" :value="JSON.stringify(teamB.map(p => p.id))">
                    <button type="submit" 
                            :disabled="players.length > 0 || (teamA.length < 2 || teamB.length < 2)"
                            class="bg-emerald-500 hover:bg-emerald-400 disabled:opacity-30 disabled:cursor-not-allowed disabled:hover:bg-emerald-500 text-slate-950 font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-[0_0_25px_rgba(16,185,129,0.1)] hover:shadow-[0_0_35px_rgba(16,185,129,0.3)] transform hover:-translate-y-0.5 disabled:transform-none active:translate-y-0 text-sm tracking-tight">
                        Confirmar Alineaciones
                    </button>
                </form>
                
            </div>
            @if ($errors->any())
                <div class="mb-4 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 relative z-10">
                
                
                <div class="lg:col-span-4 bg-slate-950/40 border border-white/5 rounded-3xl p-5 flex flex-col min-h-[520px]">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-white/5">
                        <h4 class="text-xs font-black text-white/50 uppercase tracking-wider">Buscar Convocados</h4>
                        <span x-text="players.length" class="text-xs bg-white/10 text-white/80 px-2 py-0.5 rounded-md font-black"></span>
                    </div>

                    <div class="relative mb-4">
                        <input type="text" 
                            x-model="searchQuery" 
                            @input.debounce.2000ms="fetchPlayers()"
                            placeholder="Buscar por codigo del jugador..." 
                            class="w-full bg-white/5 border border-white/10 rounded-xl py-2.5 pl-10 pr-4 text-sm text-white placeholder-white/30 focus:outline-none focus:border-emerald-500/50 focus:ring-1 focus:ring-emerald-500/50 transition-all">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-white/30">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                    </div>
                    
                    <div class="space-y-2 flex-grow overflow-y-auto max-h-[350px] pr-1">
                        <div x-show="loading" class="text-center py-12 text-xs text-emerald-400 font-medium animate-pulse">
                            Buscando jugadores...
                        </div>

                        <template x-for="player in players" :key="player.id" x-show="!loading">
                            <div class="bg-white/5 border border-white/5 p-3 rounded-xl flex items-center justify-between group hover:border-white/20 transition-all duration-200">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-800 to-slate-900 border border-white/10 flex items-center justify-center font-bold text-xs text-white/60" x-text="player.name.substring(0, 2).toUpperCase()"></div>
                                    <div>
                                        <span class="text-sm font-semibold text-white/90 block">
                                            <span x-text="player.name"></span>
                                            <template x-if="player.id === currentUserId">
                                                <span class="text-[9px] bg-emerald-500/20 text-emerald-300 px-1 rounded-sm ml-1 font-black">TÚ</span>
                                            </template>
                                        </span>
                                        <span class="block text-[10px] text-white/40 font-mono" x-text="player.email"></span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button @click="toggleCircle(player)" 
                                            type="button"
                                            class="p-1.5 rounded-lg transition-colors"
                                            :class="player.is_friend ? 'text-amber-400 bg-amber-500/10 hover:bg-amber-500/20' : 'text-white/20 hover:bg-white/5 hover:text-white/60'"
                                            :title="player.is_friend ? 'Quitar de mi círculo' : 'Añadir a mi círculo'">
                                        <svg class="w-4 h-4" :class="player.is_friend ? 'fill-current' : 'fill-none'" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.252.582 1.833l-3.978 2.892a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.978-2.892a1 1 0 00-1.176 0l-3.978 2.892c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 10.124c-.778-.58-.378-1.833.582-1.833h4.907a1 1 0 00.95-.69l1.519-4.674z"/>
                                        </svg>
                                    </button>

                                    <div class="flex gap-1 opacity-60 group-hover:opacity-100 transition-opacity">
                                        <button @click="moveToTeam(player, 'A')" class="px-2.5 py-1.5 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white transition-colors text-xs font-black">A</button>
                                        <button @click="moveToTeam(player, 'B')" class="px-2.5 py-1.5 rounded-lg bg-rose-500/10 text-rose-400 hover:bg-rose-500 hover:text-white transition-colors text-xs font-black">B</button>
                                    </div>
                                </div>
                            </div>
                        </template>
                        
                        <div x-show="players.length === 0 && !loading" class="text-center py-12 text-white/20 text-xs font-medium">
                            No se encontraron jugadores disponibles
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-4 bg-blue-500/5 border border-blue-500/10 rounded-3xl p-5 flex flex-col min-h-[480px]">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-blue-500/10">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                            <h4 class="text-xs font-black text-blue-400 uppercase tracking-wider">Equipo A (Local)</h4>
                        </div>
                        <span x-text="teamA.length + ' Jugadores'" class="text-xs text-blue-300/60 font-semibold"></span>
                    </div>

                    <div class="space-y-2 flex-grow overflow-y-auto max-h-[400px]">
                        <template x-for="player in teamA" :key="player.id">
                            <div class="bg-blue-500/10 border border-blue-500/20 p-3 rounded-xl flex items-center justify-between group animate-in zoom-in-95 duration-150">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-blue-950 border border-blue-500/30 flex items-center justify-center font-bold text-xs text-blue-300" x-text="player.name.substring(0, 2).toUpperCase()"></div>
                                    <span class="text-sm font-medium text-white/90" x-text="player.name"></span>
                                    <template x-if="player.id === currentUserId">
                                        <span class="text-[9px] bg-emerald-500/20 text-emerald-300 px-1 rounded-sm ml-1 font-black">TÚ</span>
                                    </template>
                                </div>
                                <button @click="removeFromTeam(player, 'A')" class="p-1.5 rounded-lg text-white/40 hover:bg-white/5 hover:text-rose-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>
                        
                        <div x-show="teamA.length === 0" class="text-center py-20 text-blue-300/20 text-xs font-medium border-2 border-dashed border-blue-500/10 rounded-xl">
                            Selecciona jugadores
                        </div>
                    </div>
                    
                    <div class="mt-4 pt-3 border-t border-blue-500/10 flex justify-between text-[11px] text-blue-300/60 font-bold uppercase tracking-wider">
                        <span>Nivel del Equipo:</span>
                        <span class="text-white font-black" x-text="getTeamRatingAvg(teamA)"></span>
                    </div>
                </div>

                <div class="lg:col-span-4 bg-rose-500/5 border border-rose-500/10 rounded-3xl p-5 flex flex-col min-h-[480px]">
                    <div class="flex items-center justify-between mb-4 pb-2 border-b border-rose-500/10">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-rose-400 animate-pulse"></span>
                            <h4 class="text-xs font-black text-rose-400 uppercase tracking-wider">Equipo B (Visitante)</h4>
                        </div>
                        <span x-text="teamB.length + ' Jugadores'" class="text-xs text-rose-300/60 font-semibold"></span>
                    </div>

                    <div class="space-y-2 flex-grow overflow-y-auto max-h-[400px]">
                        <template x-for="player in teamB" :key="player.id">
                            <div class="bg-rose-500/10 border border-rose-500/20 p-3 rounded-xl flex items-center justify-between group animate-in zoom-in-95 duration-150">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-rose-950 border border-rose-500/30 flex items-center justify-center font-bold text-xs text-rose-300" x-text="player.name.substring(0, 2).toUpperCase()"></div>
                                    <span class="text-sm font-medium text-white/90" x-text="player.name"></span>
                                    <template x-if="player.id === currentUserId">
                                        <span class="text-[9px] bg-emerald-500/20 text-emerald-300 px-1 rounded-sm ml-1 font-black">TÚ</span>
                                    </template>
                                </div>
                                <button @click="removeFromTeam(player, 'B')" class="p-1.5 rounded-lg text-white/40 hover:bg-white/5 hover:text-rose-400 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                        </template>
                        
                        <div x-show="teamB.length === 0" class="text-center py-20 text-rose-300/20 text-xs font-medium border-2 border-dashed border-rose-500/10 rounded-xl">
                            Selecciona jugadores
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-t border-rose-500/10 flex justify-between text-[11px] text-rose-300/60 font-bold uppercase tracking-wider">
                        <span>Nivel del Equipo:</span>
                        <span class="text-white font-black" x-text="getTeamRatingAvg(teamB)"></span>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
@push('scripts')
  @vite(['resources/js/team.js'])
@endpush