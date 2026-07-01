@forelse($data as $item)
<tr class="hover:bg-white/[0.03] transition-colors group animate-in fade-in duration-200">
    <td class="p-6">
        <div class="flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-500/20 to-blue-500/20 border border-white/10 flex items-center justify-center text-white font-bold shadow-inner">
                {{ substr($item->get_name(), 0, 1) }}
            </div>
            <div>
                <span class="block text-sm font-semibold text-white">{{ $item->get_name() }}</span>
                <span class="text-[10px] text-slate-500">ID: #{{ $item->get_id() }}</span>
            </div>
        </div>
    </td>
    <td class="p-6">
        <span class="px-3 py-1 rounded-lg bg-blue-500/10 text-blue-400 border border-blue-500/20 text-[10px] font-bold uppercase tracking-tight">
            {{ $item->get_email() }}
        </span>
    </td>
    <td class="p-6">
        <span class="text-sm font-mono text-emerald-400 font-bold">{{ $item->get_roles() }}</span>
    </td>
    <td class="p-6">
        <div class="flex justify-end gap-3">
            <a href="{{ route(\Src\Resources\Constants\Routes::USERS_SHOW, $item->get_id()) }}" class="p-2.5 rounded-xl bg-blue-500/10 border border-blue-500/20 text-blue-400 hover:bg-blue-600 hover:text-white transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </a>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="5" class="p-12 text-center text-xs text-slate-500 font-medium">
        No se encontraron sedes que coincidan con la búsqueda.
    </td>
</tr>
@endforelse