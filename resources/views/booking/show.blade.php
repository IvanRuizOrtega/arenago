@extends('layouts.app') 
@section('content')
<div class="py-8 px-4 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto">
        <!-- HEADER DE GESTIÓN (Compacto y alineado) -->
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 px-2">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    @if($include_options ? FALSE : TRUE)
                        <x-back-page :path="\Src\Resources\Constants\Routes::MY_SPORT_CENTER_SHOW" :_id="$sport_center??NULL"> </x-back-page>
                    @endif
                </div>
            </div>
        </header>

        <!-- CONTENEDOR DE TABLA GLASSMORFISM -->
        <div class="rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 overflow-hidden shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5"></th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Hora Inicial</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Hora Final</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Estado</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Atendio</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Pago</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Ranking</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Mensaje</th>
                            @if($include_options ?? FALSE)
                                <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5 text-right">Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($data as $item)
                        <tr class="hover:bg-white/[0.03] transition-colors group">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500/20 to-blue-500/20 border border-white/10 flex items-center justify-center text-white font-bold shadow-inner">
                                        {{ substr($item->get_user_name(), 0, 1) }}
                                    </div>
                                    <div>
                                        <span class="block text-sm font-semibold text-white"> {{ $item->get_user_name() }} </span>
                                        <span class="text-[10px] text-slate-500">Fecha: {{ $item->get_date() }} </span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <span class="text-sm font-mono text-blue-400 font-bold ">
                                    {{ $item->get_start_time() }} 
                                </span>
                            </td>
                            <td class="p-6">
                                <span class="text-sm font-mono text-emerald-400 font-bold"> {{ $item->get_end_time() }} </span>
                            </td>
                            <td class="p-6 text-slate-500 font-medium">
                                {{ $item->get_status_trans() }}
                            </td>
                            <td class="p-6 text-slate-500 font-medium">
                                {{ $item->get_attendant_name() }}
                            </td>
                            <td class="p-6 text-slate-500 font-medium">
                                ${{ number_format($item->get_total_price(), 0, ',', '.') }}
                            </td>
                            <td class="p-6 text-slate-500 font-medium">
                                {{ $item->get_ranking() }}
                            </td>
                            <td class="p-6 text-slate-500 font-medium">
                                {{ $item->get_message() }}
                            </td>
                            @if($include_options ?? FALSE)
                                <td class="p-6">
                                    <div class="flex justify-end gap-3">
                                        @if($item->get_status() ? (bool) ($item->get_status() == array_keys(\Src\Resources\Constants\Options::STATUS)[0]??""): FALSE)
                                        <form action="{{ route(\Src\Resources\Constants\Routes::BOOKING_EDIT, $item->get_id()??NULL) }}" 
                                            method="POST" 
                                            onsubmit="return confirm('¿Estás seguro de que deseas CONFIRMAR?');" 
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button 
                                                type="submit" 
                                                name="action_type"
                                                value="yes"
                                                class="p-2.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 hover:bg-emerald-600 hover:text-white transition-all shadow-[0_0_15px_rgba(16,185,129,0.05)] hover:shadow-[0_0_25px_rgba(16,185,129,0.2)]">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form action="{{ route(\Src\Resources\Constants\Routes::BOOKING_EDIT, $item->get_id()??NULL) }}" 
                                            method="POST" 
                                            onsubmit="return confirm('¿Estás seguro de que deseas CANCELAR?');" 
                                            class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button 
                                                type="submit" 
                                                name="action_type"
                                                value="not"
                                                class="p-2.5 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-600 hover:text-white transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Footer con Paginación -->
            <div class="p-6 border-t border-white/5 bg-white/[0.01] flex justify-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
