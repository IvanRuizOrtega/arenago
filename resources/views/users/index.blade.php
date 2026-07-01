@extends('layouts.app') 

@section('content')
<div class="py-8 px-4 animate-in fade-in duration-500" 
     x-data="{ 
        search: '', 
        loading: false,
        fetchRows() {
            this.loading = true;
            fetch(`{{ request()->url() }}?search=${this.search}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => {
                $refs.tableBody.innerHTML = html;
                this.loading = false;
            })
            .catch(() => this.loading = false);
        }
     }">
    <div class="max-w-7xl mx-auto">
        
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8 px-2">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_8px_rgba(16,185,129,0.8)]"></span>
                    <h2 class="text-3xl font-bold text-white tracking-tight">
                        {{ \Src\Resources\Constants\Headers::getKeys()[6] ?? 'Sedes Deportivas' }}
                    </h2>
                </div>
            </div>

            <div class="relative w-64">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <template x-if="!loading">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 text-white/40">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.602 10.602Z" />
                        </svg>
                    </template>
                    <template x-if="loading">
                        <svg class="animate-spin h-4 w-4 text-emerald-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </template>
                </div>

                <input 
                    type="text" 
                    x-model="search"
                    @input.debounce.2000ms="fetchRows()"
                    placeholder="Buscar en el sistema..." 
                    class="w-full pl-10 pr-9 py-2 rounded-xl text-xs bg-white/5 border border-white/10 text-white placeholder-white/40 focus:outline-none focus:border-emerald-500/50 focus:bg-white/10 transition-all duration-200"
                />

                <div class="absolute inset-y-0 right-0 flex items-center pr-2.5">
                    <button 
                        x-show="search.length > 0" 
                        @click="search = ''; fetchRows()"
                        x-transition
                        class="p-1 rounded-md text-white/40 hover:text-white hover:bg-white/5 transition-colors"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <div class="rounded-[2.5rem] bg-slate-900/40 backdrop-blur-3xl border border-white/10 overflow-hidden shadow-2xl" :class="loading ? 'opacity-60 transition-opacity' : ''">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white/5">
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Ítem / Recurso</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Correo</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5">Roles</th>
                            <th class="p-6 text-[10px] font-bold uppercase text-slate-500 tracking-widest border-b border-white/5 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5" x-ref="tableBody">
                        @include('users.partials.table-rows')
                    </tbody>
                </table>
            </div>

            
                <div class="p-6 border-t border-white/5 bg-white/[0.01]">
                    {{ $data->links() }} 
                </div>
            
        </div>
    </div>
</div>
@endsection