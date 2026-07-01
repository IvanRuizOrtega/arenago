@extends('layouts.app') 
@section('content')
<div id="view-pqrs" class="view py-8 px-4 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-5 gap-8">
        
        <div class="lg:col-span-3 p-8 md:p-12 rounded-[2rem] bg-slate-900/40 relative overflow-hidden border border-white/10">
            <div class="absolute top-0 right-0 p-8 opacity-5 text-6xl italic font-black">{{ \Src\Resources\Constants\Headers::getKeys()[5]??'' }}</div>
            
            <header class="mb-6">
                <h2 class="text-3xl font-bold text-white">Centro de Atención</h2>
                <p class="text-slate-400 mt-2">¿Tienes una duda, queja o sugerencia? Queremos escucharte.</p>
            </header>

            <form class="space-y-6" action="{{ route(\Src\Resources\Constants\Routes::PQRS_CREATE) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="space-y-2">
                        <x-label label="Tipo de Solicitud"/>
                        <x-select name="type" placeholder="Selecciona una opción" :options="\Src\Resources\Constants\Options::PQRS" value="1"/>
                        <x-error-message name="type"/>
                    </div>
                    <div class="space-y-2">
                        <x-label label="Asunto"/>
                        <x-input name="subject" placeholder="Ej: Problema con reserva"/>
                        <x-error-message name="subject"/>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-label label="Mensaje Detallado" rows="4"/>
                    <x-text-area name="message"/>
                    <x-error-message name="message"/>
                </div>

                <x-btn type="submit"
                    class="w-full md:w-auto px-10 py-4 bg-emerald-500 rounded-2xl font-bold text-white shadow-lg shadow-emerald-500/30 hover:scale-105 transition-all"> 
                    Enviar Solicitud
                </x-btn>
            </form>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="p-8 rounded-[2rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10">
                <h3 class="text-xl font-bold mb-4 italic text-blue-400">"Mejora Continua"</h3>
                <p class="text-sm text-slate-400 mb-6">Tu feedback directo ayuda a que **Arena.go** sea el mejor lugar para jugar.</p>
                
                <div class="space-y-4">
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">¿Cómo calificarías la plataforma?</p>
                    <form action="{{ route(\Src\Resources\Constants\Routes::PQRS_CREATE) }}" method="POST" id="ranking-form" class="space-y-6">
                        @csrf

                        <x-input type="hidden" name="type" value="ranking"/>
                        
                        <x-input type="hidden" name="ranking" id="ranking-input"/>
                            
                        <div class="flex justify-between items-center gap-2">
                            <x-btn type="button" onclick="submitRanking(1)" 
                                class="flex-1 bg-white/5 border border-white/5 p-3 rounded-xl hover:bg-white/10 transition-all text-xl">😞</x-btn>
                            
                            <x-btn type="button" onclick="submitRanking(2)" 
                                class="flex-1 bg-white/5 border border-white/5 p-3 rounded-xl hover:bg-white/10 transition-all text-xl">😐</x-btn>
                            
                            <x-btn type="button" onclick="submitRanking(3)" 
                                class="flex-1 bg-white/5 border border-white/5 p-3 rounded-xl transition-all text-xl">😊</x-btn>
                            
                            <x-btn type="button" onclick="submitRanking(4)" 
                                class="flex-1 bg-white/5 border border-white/5 p-3 rounded-xl hover:bg-white/10 transition-all text-xl">🤩</x-btn>
                            
                            <x-btn type="button" onclick="submitRanking(5)" 
                                class="flex-1 bg-white/5 border border-white/5 p-3 rounded-xl hover:bg-white/10 transition-all text-xl">🔥</x-btn>
                        </div>
                        
                        <x-error-message name="ranking"/>
                        
                    </form>
                </div>

                <div class="mt-8 pt-6 border-t border-white/5">
                    <p class="text-[10px] font-bold text-slate-500 uppercase mb-3 tracking-widest">Tu idea de mejora:</p>
                    <form action="{{ route(\Src\Resources\Constants\Routes::PQRS_CREATE) }}" method="POST">
                        @csrf
                        <x-input type="hidden" name="type" value="improvement_idea"/>
                        <x-input name="improvement_idea" placeholder="¿Qué añadirías?"/>
                        <x-error-message name="improvement_idea"/>
                    </form>
                </div>
            </div>

            <div class="p-6 rounded-[2rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 flex items-center gap-4">
                <div class="h-12 w-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-400 text-2xl">⚡</div>
                <div>
                    <h4 class="font-bold text-white">Respuesta Rápida</h4>
                    <p class="text-xs text-slate-500">Promedio de respuesta: < 24h</p>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
@push('scripts')
  @vite(['resources/js/form-ranking.js'])
@endpush
