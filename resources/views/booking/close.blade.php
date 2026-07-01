@extends('layouts.app') 
@section('content')
<x-back-page :path="\Src\Resources\Constants\Routes::MY_MATCHDAY_HUB_INDEX"> </x-back-page>
<div class="view py-8 px-4 animate-in fade-in duration-500"
     x-data="{ 
        goalsA: 0, 
        goalsB: 0, 
        rating: 0,
        hoverRating: 0,
        loading: false,
        increment(team) { if(team === 'A') this.goalsA++; else this.goalsB++; },
        decrement(team) { 
            if(team === 'A' && this.goalsA > 0) this.goalsA--; 
            if(team === 'B' && this.goalsB > 0) this.goalsB--; 
        }
     }">
    
    <div class="max-w-7xl mx-auto">
        <div class="p-8 rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 relative overflow-hidden shadow-2xl">
            <div class="absolute -top-24 -left-24 w-48 h-48 bg-rose-500/10 blur-[80px] pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-blue-500/10 blur-[80px] pointer-events-none"></div>

            <div class="text-center mb-8 relative z-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-[10px] font-black tracking-widest uppercase bg-rose-500/10 text-rose-400 border border-rose-500/20 mb-3">
                    <span class="w-1.5 h-1.5 rounded-full bg-rose-400 animate-pulse"></span>
                    Finalizar Partido
                </span>
                <h2 class="text-2xl font-black text-white tracking-tight">Reportar Marcador Final</h2>
                <p class="text-white/40 text-xs mt-1">Ingresa el resultado final para cerrar el partido y registrar las estadísticas.</p>
            </div>

            <form action="{{ route(\Src\Resources\Constants\Routes::BOOKING_TEAM_CLOSE, $booking_id??NULL) }}" method="POST" @submit="loading = true">
                @csrf
                @method('PUT')

                <input type="hidden" name="goals_team_a" :value="goalsA">
                <input type="hidden" name="goals_team_b" :value="goalsB">

                <div class="grid grid-cols-1 md:grid-cols-7 items-center gap-6 bg-slate-950/40 border border-white/5 rounded-3xl p-6 mb-8 relative z-10 text-center">
                    
                    <div class="md:col-span-3 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-full bg-blue-500/10 border border-blue-500/20 flex items-center justify-center text-blue-400 font-black text-sm mb-2">A</div>
                        <h4 class="text-sm font-bold text-white/80 uppercase tracking-wide">Equipo Local</h4>
                        
                        <div class="flex items-center gap-4 mt-4">
                            <button type="button" @click="decrement('A')" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 text-white font-black transition border border-white/10 select-none">-</button>
                            <span x-text="goalsA" class="text-4xl font-black text-white font-mono w-12 text-center"></span>
                            <button type="button" @click="increment('A')" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 text-white font-black transition border border-white/10 select-none">+</button>
                        </div>
                    </div>

                    <div class="md:col-span-1 flex justify-center">
                        <span class="text-xs font-black text-white/20 uppercase tracking-widest bg-white/5 px-3 py-1.5 rounded-xl border border-white/5">VS</span>
                    </div>

                    <div class="md:col-span-3 flex flex-col items-center">
                        <div class="w-12 h-12 rounded-full bg-rose-500/10 border border-rose-500/20 flex items-center justify-center text-rose-400 font-black text-sm mb-2">B</div>
                        <h4 class="text-sm font-bold text-white/80 uppercase tracking-wide">Equipo Visitante</h4>
                        
                        <div class="flex items-center gap-4 mt-4">
                            <button type="button" @click="decrement('B')" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 text-white font-black transition border border-white/10 select-none">-</button>
                            <span x-text="goalsB" class="text-4xl font-black text-white font-mono w-12 text-center"></span>
                            <button type="button" @click="increment('B')" class="w-10 h-10 rounded-xl bg-white/5 hover:bg-white/10 text-white font-black transition border border-white/10 select-none">+</button>
                        </div>
                    </div>

                </div>

                <div class="bg-slate-950/40 border border-white/5 rounded-3xl p-6 mb-8 relative z-10">
        <div class="text-center mb-4">
            <h4 class="text-xs font-black text-white/50 uppercase tracking-wider">Calificación del Servicio</h4>
            <p class="text-[11px] text-white/40 mt-0.5">Califica la atención prestada por el colaborador/administrador de la cancha</p>
        </div>

        <input type="hidden" name="service_rating" :value="rating">

        <div class="flex items-center justify-center gap-2">
            <template x-for="star in 5">
                <button type="button" 
                        @click="rating = star"
                        @mouseover="hoverRating = star"
                        @mouseleave="hoverRating = 0"
                        class="p-1 transition-transform duration-150 hover:scale-125 focus:outline-none">
                    <svg class="w-8 h-8 transition-colors duration-150" 
                         :class="(hoverRating || rating) >= star ? 'text-amber-400 fill-amber-400' : 'text-white/20'"
                         fill="none" 
                         stroke="currentColor" 
                         viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.907c.961 0 1.36 1.252.582 1.833l-3.978 2.892a1 1 0 00-.364 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.978-2.892a1 1 0 00-1.176 0l-3.978 2.892c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.364-1.118L2.98 10.124c-.778-.58-.378-1.833.582-1.833h4.907a1 1 0 00.95-.69l1.519-4.674z"/>
                    </svg>
                </button>
            </template>
        </div>
        
        <div class="text-center mt-2 h-4">
            <span class="text-[10px] font-black tracking-wider uppercase text-amber-400 font-mono" 
                  x-show="rating > 0" 
                  x-text="rating + (rating === 1 ? ' Estrella' : ' Estrellas')">
            </span>
        </div>
    </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 rounded-2xl bg-rose-500/10 border border-rose-500/20 text-rose-400 text-xs animate-in shake duration-300">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-end gap-4 relative z-10 border-t border-white/5 pt-6">
                    <button type="submit"
                            :disabled="loading"
                            class="w-full sm:w-auto bg-rose-500 hover:bg-rose-400 disabled:opacity-50 text-slate-950 font-black py-3.5 px-8 rounded-2xl transition-all duration-300 shadow-[0_0_25px_rgba(244,63,94,0.1)] hover:shadow-[0_0_35px_rgba(244,63,94,0.3)] transform hover:-translate-y-0.5 disabled:transform-none text-sm tracking-tight flex items-center justify-center gap-2">
                        <span x-show="!loading">Finalizar y Cerrar Partido</span>
                        <span x-show="loading" class="animate-pulse">Procesando...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@push('scripts')
  @vite(['resources/js/team.js'])
@endpush