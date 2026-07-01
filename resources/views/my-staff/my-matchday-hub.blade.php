@extends('layouts.app') 
@section('content')
<div class="view py-8 px-4 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">

        <div class="lg:col-span-12 p-8 rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 relative overflow-hidden shadow-2xl">
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 blur-[80px] pointer-events-none"></div>
            
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                <div>
                    @if($booking??FALSE)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Próximo Encuentro - {{ $booking->get_playing_field_type()}}
                    </span>
                        <h2 class="text-3xl font-black text-white tracking-tight">
                            {{ $booking->get_playing_field_name() }} 
                            <span class="text-white/20">•</span>
                            {{ $booking->get_sport_center_address() }} 
                            <span class="text-white/20">•</span>
                            {{ $booking->get_sport_center_city() }} 
                        </h2>
                        <p class="text-white/60 text-sm mt-1 flex items-center gap-2 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-slate-400">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Z" />
                            </svg>
                            <span> {{ $booking->get_date() }} </span>
                            <span class="text-white/20">•</span>
                            <span> {{ $booking->get_start_time() }}  -  {{ $booking->get_end_time() }} </span>
                        </p>
                    @else
                        <h2 class="text-2xl font-bold text-white/80">No tienes reservas activas</h2>
                        <p class="text-white/40 text-sm mt-1">Arma el partido agendando una cancha disponible.</p>
                    @endif
                </div>

                @if($booking??FALSE)
                @php
                    $url = $booking->get_status() == array_keys(\Src\Resources\Constants\Options::STATUS)[0] ? \Src\Resources\Constants\Routes::BOOKING_TEAM : ($booking->get_status() == array_keys(\Src\Resources\Constants\Options::STATUS)[2] ? \Src\Resources\Constants\Routes::BOOKING_TEAM_CLOSE_FORM : '');
                @endphp
                    <div>
                        <a href="{{ route($url, $booking->get_id()??NULL) }}" 
                           class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold py-3.5 px-6 rounded-2xl transition-all duration-300 shadow-[0_0_25px_rgba(16,185,129,0.2)] hover:shadow-[0_0_35px_rgba(16,185,129,0.4)] transform hover:-translate-y-0.5 active:translate-y-0 text-sm tracking-tight">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            <span>Gestionar reserva (Matchmaking)</span>
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-12 space-y-6">
            <div class="p-8 rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 relative overflow-hidden shadow-2xl">
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-500/5 blur-[80px] pointer-events-none"></div>

                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h3 class="text-xl font-extrabold text-white tracking-tight">Rendimiento Histórico</h3>
                        <p class="text-xs text-white/40 mt-0.5">Métricas obtenidas en base a tarjetas de juego confirmadas</p>
                    </div>
                    <div class="bg-gradient-to-br from-amber-500/20 to-orange-500/20 border border-amber-500/30 px-4 py-2 rounded-2xl text-center">
                        <span class="text-[10px] uppercase font-black tracking-wider text-amber-400 block">RATING</span>
                        @if($ranking)
                            <span class="text-2xl font-black text-amber-300 tracking-tight">
                                {{ number_format($ranking->get_rating() ?? 0.0, 1) }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <div class="bg-white/5 border border-white/5 rounded-2xl p-5 hover:border-white/10 transition-colors">
                        <span class="block text-white/40 text-xs font-bold uppercase tracking-wider">Partidos</span>
                        @if($ranking)
                            <span class="block text-3xl font-black text-white mt-2 tracking-tight">
                                {{ $ranking->get_matches_played() ?? 0 }}
                            </span>
                        @endif
                    </div>

                    <div class="bg-emerald-500/5 border border-emerald-500/10 rounded-2xl p-5">
                        <span class="block text-emerald-400/60 text-xs font-bold uppercase tracking-wider">Victorias</span>
                        @if($ranking)
                            <span class="block text-3xl font-black text-emerald-400 mt-2 tracking-tight">
                                {{ $ranking->get_wins() ?? 0 }}
                            </span>
                        @endif
                    </div>

                    <div class="bg-amber-500/5 border border-amber-500/10 rounded-2xl p-5">
                        <span class="block text-amber-400/60 text-xs font-bold uppercase tracking-wider">Empates</span>
                        @if($ranking)
                            <span class="block text-3xl font-black text-amber-400 mt-2 tracking-tight">
                                {{ $ranking->get_draws() ?? 0 }}
                            </span>
                        @endif
                    </div>

                    <div class="bg-rose-500/5 border border-rose-500/10 rounded-2xl p-5">
                        <span class="block text-rose-400/60 text-xs font-bold uppercase tracking-wider">Derrotas</span>
                        @if($ranking)
                            <span class="block text-3xl font-black text-rose-400 mt-2 tracking-tight">
                                {{ $ranking->get_losses() ?? 0 }}
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mt-6 pt-5 border-t border-white/5 flex items-center justify-between text-xs text-white/50 px-2">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4 text-amber-400">
                          <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.6 3.102-1.196 4.622c-.21.81.67 1.45 1.366 1.012L10 15.547l4.281 2.507c.696.438 1.575-.202 1.366-1.012l-1.196-4.622 3.6-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.83-4.401Z" clip-rule="evenodd" />
                        </svg>
                        Puntos de Competitividad Acumulados: 
                        @if($ranking)
                            <strong class="text-white font-bold text-sm ml-1"> {{ $ranking->get_points() ?? 0 }} pts</strong>
                        @endif
                    </span>
                </div>
            </div>
        </div>


        <div class="lg:col-span-12 space-y-6" x-data="{ activeCenter: 'all' }">
            <div class="p-8 rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 relative overflow-hidden shadow-2xl">
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h3 class="text-xl font-extrabold text-white tracking-tight">Compañeros y Rivales de Cancha</h3>
                        <p class="text-xs text-white/40 mt-0.5">Estadísticas acumuladas de los jugadores con los que has compartido la de fútbol</p>
                    </div>

                    <div class="relative inline-block text-left self-start" x-data="{ open: false }">
                        @php
                            // Detectamos la sede actual desde la URL (?sede=X) para dejarla seleccionada de forma estática
                            $currentSedeId = request()->query('sede');
                            $currentSedeName = 'Todas las Sedes';

                            if ($currentSedeId && isset($sportCenters)) {
                                $selectedCenter = collect($sportCenters)->firstWhere('id', $currentSedeId);
                                if ($selectedCenter) {
                                    $currentSedeName = is_array($selectedCenter) ? $selectedCenter['name'] : $selectedCenter->name;
                                }
                            }
                        @endphp
                        <div>
                            <button @click="open = !open" 
                                    @click.away="open = false"
                                    class="inline-flex items-center justify-between w-56 px-4 py-2.5 rounded-xl text-xs font-bold bg-white/5 border border-white/10 text-white hover:bg-white/10 transition-all duration-200">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-emerald-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    <span x-text="activeCenter === 'all' ? 'Todas las Sedes' : document.getElementById('label-' + activeCenter)?.innerText || 'Sede Seleccionada'">Todas las Sedes</span>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 text-white/50 transition-transform duration-200" :class="open ? 'rotate-180' : ''">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </div>

                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-56 max-h-60 overflow-y-auto rounded-xl bg-slate-950 border border-white/10 shadow-2xl z-50 p-1.5 scrollbar-thin scrollbar-thumb-white/10">
                            
                            <button @click="window.location.href = '{{ request()->url() }}'; open = false"
                                    class="w-full text-left px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center justify-between {{ !$currentSedeId ? 'bg-emerald-500 text-slate-950 font-bold' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                                <span>Todas las Sedes</span>
                                @if(!$currentSedeId)
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span>
                                @endif
                            </button>
                            <div class="h-px bg-white/5 my-1"></div>

                           @foreach($sportCenters ?? [] as $center)
                                <button @click="window.location.href = '{{ request()->url() }}?sede={{ $center->get_id() }}'; open = false"
                                        class="w-full text-left px-3 py-2 rounded-lg text-xs font-semibold transition-colors flex items-center justify-between {{ $currentSedeId == $center->get_id() ? 'bg-emerald-500 text-slate-950 font-bold' : 'text-white/70 hover:bg-white/5 hover:text-white' }}">
                                    <span>{{ $center->get_name() }}</span>
                                    @if($currentSedeId == $center->get_id())
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-950"></span>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-white/5 bg-slate-950/20">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-white/10 bg-white/5 text-xs font-bold uppercase tracking-wider text-white/40">
                                <th class="py-4 px-6 text-center">#</th>
                                <th class="py-4 px-6">Nombre del Jugador</th>
                                <th class="py-4 px-4 text-center">PJ</th>
                                <th class="py-4 px-4 text-center text-emerald-400">PG</th>
                                <th class="py-4 px-4 text-center text-amber-400">PE</th>
                                <th class="py-4 px-4 text-center text-rose-400">PP</th>
                                <th class="py-4 px-4 text-center">Puntos</th>
                                <th class="py-4 px-6 text-right">Rendimiento</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-white/5">
                            @php $visibleRank = 1; @endphp
                            @forelse($players_stats ?? [] as $player)

                                <tr x-show="activeCenter === 'all' || activeCenter === 'center-{{ $player->get_sport_center_id() }}'"
                                    x-transition:enter="transition ease-out duration-200"
                                    class="hover:bg-white/5 transition-colors group">
                                    
                                    <td class="py-4 px-4 text-center font-medium text-white/70">
                                        {{ $visibleRank++ }}
                                    </td>

                                    <td class="py-4 px-6 font-semibold text-white/90 group-hover:text-emerald-400 transition-colors">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-slate-800 to-slate-900 border border-white/10 flex items-center justify-center font-bold text-xs uppercase tracking-tight text-white/60">
                                                {{ substr($player->get_name(), 0, 2) }}
                                            </div>
                                            <div>
                                                <span class="{{ $player->get_me() ? 'text-emerald-400 font-bold' : '' }}">
                                                    {{ $player->get_name() }} {!! $player->get_me() ? '<span class="text-[10px] bg-emerald-500/20 text-emerald-300 px-1.5 py-0.5 rounded-md ml-1 font-black">TÚ</span>' : '' !!}
                                                </span>
                                                <span class="block text-[10px] text-white/30 font-medium normal-case mt-0.5">Sede: {{ $player->get_sport_center_name() }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="py-4 px-4 text-center font-medium text-white/70">{{ $player->get_matches_played() }}</td>
                                    <td class="py-4 px-4 text-center font-bold text-emerald-400/80 bg-emerald-500/[0.01]">{{ $player->get_wins() }}</td>
                                    <td class="py-4 px-4 text-center font-bold text-amber-400/80 bg-amber-500/[0.01]">{{ $player->get_draws() }}</td>
                                    <td class="py-4 px-4 text-center font-bold text-rose-400/80 bg-rose-500/[0.01]">{{ $player->get_losses() }}</td>
                                    <td class="py-4 px-4 text-center font-black text-white/90">{{ $player->get_points() }}</td>
                                    
                                    <td class="py-4 px-6 text-right">
                                        @php
                                            $performance = calculatePerformance($player->get_wins(), $player->get_draws(), $player->get_matches_played());
                                        @endphp
                                        <div class="inline-flex flex-col items-end">
                                            <span class="font-bold {{ $performance >= 60 ? 'text-emerald-400' : ($performance >= 40 ? 'text-amber-400' : 'text-rose-400') }}">
                                                {{ number_format($performance, 1) }}%
                                            </span>
                                            <div class="w-16 h-1 bg-white/10 rounded-full mt-1 overflow-hidden">
                                                <div class="h-full {{ $performance >= 60 ? 'bg-emerald-500' : ($performance >= 40 ? 'bg-amber-500' : 'bg-rose-500') }}" style="width: {{ $performance }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-12 text-center text-white/30 font-medium">
                                        Aún no has disputado partidos con otros jugadores en ninguna sede.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        
    </div>
</div>
@endsection