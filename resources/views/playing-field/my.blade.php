@extends('layouts.app') 
@section('content')
<div class="py-8 px-4 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto">
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 px-2">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <x-back-page :path="\Src\Resources\Constants\Routes::MY_SPORT_CENTER_INDEX"> </x-back-page>
                </div>
            </div>
            <a href="{{ route(\Src\Resources\Constants\Routes::MY_SPORT_CENTER_CREATE_FORM, $_id??NULL) }}" 
               class="flex items-center justify-center gap-2 px-6 py-3.5 bg-emerald-500 text-slate-950 font-black rounded-2xl hover:bg-emerald-400 hover:scale-[1.02] transition-all shadow-[0_0_20px_rgba(16,185,129,0.3)] group">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Registrar Nuevo
            </a>
        </header>

        <!-- CONTENEDOR DE TABLA GLASSMORFISM -->
        <div class="rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Ítem / Recurso</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Tipo</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Precio</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Es cubierto?</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($data as $item)
                        <tr class="hover:bg-white/[0.03] transition-colors group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500/20 to-blue-500/20 border border-white/10 flex items-center justify-center text-white font-bold shadow-inner">
                                        {{ substr($item->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="block text-sm font-semibold text-white">{{ $item->name }}</span>
                                        <span class="text-[10px] text-slate-500">ID: #{{ $item->_id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <span class="px-3 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20 text-[10px] font-bold uppercase tracking-tight">
                                    {{ \Src\Resources\Constants\Options::SPORT_CENTERS[$item->type] ?? $item->type }}
                                </span>
                            </td>
                            <td class="p-6">
                                <span class="text-sm font-mono text-emerald-400 font-bold"> 
                                    ${{ number_format($item->price_hour, 0, ',', '.') }} 
                                </span>
                                <span class="text-xs text-white/60 block font-medium">COP / hora</span>
                            </td>
                            <td class="p-6 text-xs text-slate-500 font-medium">
                                {{ $item->covered ? 'Cubierta (Techo)' : 'Descubierta' }} 
                            </td>
                            <td class="p-6">
                                <div class="flex justify-end gap-3">
                                    <!-- Ver -->
                                    <a href="{{ route(\Src\Resources\Constants\Routes::MY_SPORT_CENTER_PLAYING_FIELD_SHOW, [$_id??NULL, $item->_id??NULL]) }}" class="p-2.5 rounded-xl bg-white/5 border border-white/10 text-slate-400 hover:text-white hover:bg-white/10 transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <!-- Editar -->
                                    <a href="{{ route(\Src\Resources\Constants\Routes::MY_SPORT_CENTER_EDIT_FORM, [$_id??NULL, $item->_id??NULL]) }}" class="p-2.5 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 hover:bg-blue-600 hover:text-white transition-all">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <!-- Eliminar -->
                                    <form action="{{ route(\Src\Resources\Constants\Routes::MY_SPORT_CENTER_EDIT_FORGET, [$_id??NULL, $item->_id??NULL]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este elemento?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-600 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
