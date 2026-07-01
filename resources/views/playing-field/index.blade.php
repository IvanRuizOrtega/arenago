@extends('layouts.app') 
@section('content')
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8 relative z-10 max-w-7xl mx-auto px-4 pb-10">
        @foreach($data as $centro)
            <div class="group relative bg-slate-900/40 backdrop-blur-3xl border border-white/10 rounded-[2rem] overflow-hidden flex flex-col transition-all duration-500 hover:border-emerald-500/30 hover:shadow-[0_0_30px_rgba(16,185,129,0.1)]">
                <div class="relative h-52 w-full overflow-hidden">
                    <div class="absolute top-4 right-4 z-20">
                        <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider backdrop-blur-md border 
                            {{ $centro->is_open 
                                ? 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30' 
                                : 'bg-red-500/20 text-red-400 border-red-500/30' 
                            }}">
                            {{ $centro->is_open ? 'Abierto ahora' : 'Cerrado ahora' }}
                        </span>
                    </div>

                    <img src="{{ $centro->image_url ?? 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800&auto=format&fit=crop' }}" 
                        alt="{{ $centro->name }}" 
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                </div>

                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-white group-hover:text-emerald-400 transition-colors">
                        {{ $centro->name ?? 'Centro Deportivo' }}
                    </h3>
                    
                    <div class="flex items-center gap-2 mt-2 text-slate-400 text-sm">
                        <svg class="w-4 h-4 text-emerald-500/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $centro->address }}, {{ $centro->city }}</span>
                    </div>

                    <!-- SECCIÓN DE DEPORTES (NUEVO) -->
                    <!-- <div class="flex flex-wrap gap-2 mt-4">
                        @if(!empty($centro->sports))
                            @foreach($centro->sports as $deporte)
                                <span class="px-2 py-0.5 rounded-md  text-[10px] font-bold uppercase tracking-tight text-slate-300">
                                    {{ $deporte }}
                                </span>
                            @endforeach
                        @else
                            <span class="text-[10px] italic font-bold uppercase tracking-tight text-slate-300">Multideportivo</span>
                        @endif
                    </div> -->

                    <div class="flex flex-wrap gap-2 mt-4 mb-6">
                        @if($centro->is_public)
                        <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/5 text-[11px] font-medium text-slate-300">
                            Abierto 24/7 (Público)
                        </span>
                        @elseif(!empty($centro->working_days))
                            @foreach($centro->working_days as $dia => $horario)
                                <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/5 text-[11px] font-medium text-slate-300">
                                    {{ \Src\Resources\Constants\Options::DAYS[$dia] }}: {{ date('H:i', strtotime($horario->open)) }} - {{ date('H:i', strtotime($horario->close)) }}
                                </span>
                            @endforeach
                        @else
                            <span class="px-3 py-1 rounded-lg bg-white/5 border border-white/5 text-[11px] font-medium text-slate-300">
                                Horario no disponible
                            </span>
                        @endif
                    </div>

                    <a class="mt-auto w-full py-3.5 rounded-xl bg-slate-800/50 border border-white/10 text-white font-semibold text-sm transition-all duration-300 hover:bg-emerald-500 hover:text-slate-950 hover:border-emerald-400 hover:shadow-[0_0_20px_rgba(16,185,129,0.4)] flex items-center justify-center gap-2"
                        href="{{ route(\Src\Resources\Constants\Routes::SPORT_CENTER_SHOW, $centro->_id ??0) }}">
                        Ver Canchas
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        @endforeach
    </section>
    <div>
        {{ $data->links() }}
    </div>
@endsection
