@extends('layouts.app')

@section('content')
<x-back-page :path="\Src\Resources\Constants\Routes::USERS_INDEX" />
<div class="py-8 px-4 animate-in fade-in duration-500" x-data="{ activeTab: 'roles', saving: false }">
    <div class="max-w-5xl mx-auto">
        
        <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 px-2">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-blue-500/20 border border-white/10 flex items-center justify-center text-white text-xl font-bold shadow-inner">
                    {{ substr($user->name, 0, 1) }}
                </div>
                <div>
                    <div class="flex items-center gap-2 mb-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                        <h2 class="text-2xl font-bold text-white tracking-tight">{{ $user->name }}</h2>
                    </div>
                    <p class="text-xs text-slate-400">Gestionar accesos, roles y sedes asignadas corporativas</p>
                </div>
            </div>

            <div class="flex p-1 rounded-xl bg-slate-950/60 border border-white/5 backdrop-blur-md">
                <button @click="activeTab = 'roles'" 
                        :class="activeTab === 'roles' ? 'bg-white/10 text-white font-semibold' : 'text-slate-400 hover:text-white'"
                        class="px-4 py-2 rounded-lg text-xs transition-all duration-150">
                    Roles del Sistema
                </button>
                <button @click="activeTab = 'centers'" 
                        :class="activeTab === 'centers' ? 'bg-white/10 text-white font-semibold' : 'text-slate-400 hover:text-white'"
                        class="px-4 py-2 rounded-lg text-xs transition-all duration-150">
                    Centros Deportivos
                </button>
            </div>
        </header>

        <form action="{{ route(\Src\Resources\Constants\Routes::USERS_UPDATE, $user->id) }}" 
              method="POST" 
              @submit="saving = true"
              class="rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 overflow-hidden shadow-2xl p-8 md:p-10 relative">
            
            @csrf
            @method('PUT')

            <div x-show="activeTab === 'roles'" x-transition:enter="transition ease-out duration-200" class="space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-2">Roles Disponibles</h3>
                    <p class="text-xs text-slate-500 mb-6">Selecciona los roles que determinarán los permisos de ejecución del usuario en la plataforma.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($roles ?? [] as $role)
                    <label class="relative flex items-start p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-white/10 cursor-pointer transition-all select-none group">
                        <div class="flex items-center h-5 mt-0.5">
                            <input type="checkbox" 
                                   name="roles[]" 
                                   value="{{ $role->id }}"
                                   {{ in_array($role->id , $roles_by_user??[]) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-white/10 bg-slate-950 text-emerald-500 focus:ring-emerald-500/30 focus:ring-offset-slate-900 transition-colors">
                        </div>
                        <div class="ml-4 text-xs">
                            <span class="font-semibold text-white block group-hover:text-emerald-400 transition-colors">{{ $role->name }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div x-show="activeTab === 'centers'" x-transition:enter="transition ease-out duration-200" class="space-y-6">
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-2">Sedes Vinculadas</h3>
                    <p class="text-xs text-slate-500 mb-6">Marca los complejos deportivos que este usuario tendrá permitido administrar, supervisar o agendar.</p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 max-h-96 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-white/10">
                    @foreach($sport_centers ?? [] as $center)
                    <label class="flex items-center gap-3 p-3.5 rounded-xl bg-white/[0.03] border border-white/5 hover:bg-white/5 cursor-pointer transition-all">
                        <input type="checkbox" 
                               name="sport_centers[]" 
                               value="{{ $center->get_id() }}"
                               {{ in_array($center->get_id(), $user_centers_ids ?? []) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-white/10 bg-slate-950 text-emerald-500 focus:ring-emerald-500/30 transition-colors">
                        <div class="truncate text-xs">
                            <span class="font-medium text-white block truncate">{{ $center->get_name() }}</span>
                            <span class="font-medium text-white block truncate">{{ $center->get_address() }}</span>
                            <span class="text-[10px] text-slate-500 font-mono block truncate">{{ $center->get_city() }}</span>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-white/5 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-xs text-slate-500">
                    * Los cambios aplicarán inmediatamente tras guardar la configuración.
                </div>
                
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <button type="submit" 
                            :disabled="saving"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl text-xs font-bold bg-emerald-500 text-slate-950 hover:bg-emerald-400 focus:outline-none disabled:opacity-50 transition-all duration-150">
                        <svg x-show="saving" class="animate-spin h-3.5 w-3.5 text-slate-950" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span x-text="saving ? 'Guardando cambios...' : 'Guardar Configuración'">Guardar Configuración</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection