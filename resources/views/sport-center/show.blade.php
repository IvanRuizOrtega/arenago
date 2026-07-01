@extends('layouts.app')
@section('content')
<x-back-page />

<main class="max-w-7xl mx-auto px-4 py-8 relative z-10 text-white animate-fade-in" 
      x-data="{ openModal: false, selectedField: null }">
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        @foreach($data as $field)
            <div class="lg:col-span-7 space-y-4" x-data="{ activeImage: 0 }">
                <div class="relative h-[450px] w-full rounded-[2.5rem] overflow-hidden border border-white/10 bg-slate-900/40 backdrop-blur-md shadow-2xl">
                    <div class="absolute top-6 left-6 z-20">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase backdrop-blur-md {{ $field->covered ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-amber-500/20 text-amber-400 border border-amber-500/30' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $field->covered ? 'bg-emerald-400' : 'bg-amber-400' }}"></span>
                            {{ $field->covered ? 'Techada' : 'Al Aire Libre' }}
                        </span>
                    </div>

                    @php
                        $gallery = $field->images ?? [
                            'https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=1200&auto=format&fit=crop'
                        ];
                    @endphp

                    @foreach($gallery as $index => $image)
                        <img src="{{ $image }}" 
                            x-show="activeImage === {{ $index }}"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 scale-105"
                            x-transition:enter-end="opacity-100 scale-100"
                            class="absolute inset-0 w-full h-full object-cover" 
                            alt="Cancha {{ $field->name }}">
                    @endforeach
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent pointer-events-none"></div>
                </div>

                <div class="flex gap-4 px-2 overflow-x-auto pb-2">
                    @foreach($gallery as $index => $image)
                        <button @click="activeImage = {{ $index }}" 
                                class="relative h-20 w-28 rounded-2xl overflow-hidden border transition-all duration-300 shrink-0"
                                :class="activeImage === {{ $index }} ? 'border-emerald-500 ring-2 ring-emerald-500/20 scale-95' : 'border-white/10 opacity-60 hover:opacity-100'">
                            <img src="{{ $image }}" class="w-full h-full object-cover" alt="Miniatura">
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="lg:col-span-5 space-y-6">
                <div class="bg-slate-900/40 backdrop-blur-3xl border border-white/10 rounded-[2.5rem] p-8 shadow-xl flex flex-col justify-between relative overflow-hidden">
                    
                    <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 blur-[80px] pointer-events-none"></div>

                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-emerald-400 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full">
                            {{ \Src\Resources\Constants\Options::SPORT_CENTERS[$field->type] ?? $field->type }}
                        </span>

                        <h1 class="text-3xl font-extrabold text-white mt-4 tracking-tight">
                            {{ $field->name ?? 'Cancha Sin Nombre' }}
                        </h1>

                        <hr class="border-white/5 my-6">

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 border border-white/5 rounded-2xl p-4">
                                <p class="text-xs text-white/40 font-medium">Formato de Juego</p>
                                <p class="text-base font-bold text-white/90 mt-1">
                                    {{ str_contains($field->type, 'fl-') ? 'Fútbol ' . str_replace('fl-', '', $field->type) : 'Estándar' }}
                                </p>
                            </div>
                            <div class="bg-white/5 border border-white/5 rounded-2xl p-4">
                                <p class="text-xs text-white/40 font-medium">Estructura</p>
                                <p class="text-base font-bold text-white/90 mt-1">
                                    {{ $field->covered ? 'Cubierta (Techo)' : 'Descubierta' }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-6 bg-emerald-500/5 border border-emerald-500/10 rounded-3xl p-6 flex items-center justify-between">
                            <div>
                                <p class="text-xs text-emerald-400/70 font-semibold uppercase tracking-wider">Precio por Hora</p>
                                <p class="text-sm text-white/50 font-medium mt-0.5">Tarifa estándar de alquiler</p>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-black text-emerald-400 tracking-tight">
                                    ${{ number_format($field->price_hour, 0, ',', '.') }}
                                </span>
                                <span class="text-xs text-white/60 block font-medium">COP / hora</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8">
                        <button @click="openModal = true; $dispatch('set-booking-field', { 
                            id: {{ $field->_id??0 }}, 
                            price: {{ $field->price_hour }},
                            workingDays: {{ json_encode($field->working_days) }}
                        })" 
                                class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold py-4 px-6 rounded-2xl transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-[0_0_30px_rgba(16,185,129,0.3)] active:translate-y-0 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                            <span>Reservar Turno Ahora</span>
                        </button>
                    </div>

                </div>
            </div>
        @endforeach
    </div>

    <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm"
         x-show="openModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;"
         @keydown.escape.window="openModal = false">
        
        <div class="bg-slate-900/80 border border-white/10 backdrop-blur-2xl rounded-[2.5rem] p-8 shadow-2xl relative w-full max-w-lg overflow-hidden transform transition-all"
             x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             x-data="bookingSystem()"
             @set-booking-field.window="setFieldData($event.detail)"
             @click.away="openModal = false">

            <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 blur-[80px] pointer-events-none"></div>

            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold tracking-tight text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-emerald-400">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg>
                    Agendar Turno
                </h3>
                <button @click="openModal = false" class="text-white/40 hover:text-white transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="space-y-5">
                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-white/50 block mb-2">1. Selecciona el Día</label>
                    <input type="date" 
                           x-model="date" 
                           :min="minDate" 
                           :max="maxDate"
                           @change="handleDateChange"
                           class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 text-sm text-white focus:outline-none focus:border-emerald-500/50 transition-all">
                    <p class="text-[11px] text-white/30 mt-1">Permitido reservar hasta con 3 días de anticipación.</p>
                </div>

                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-white/50 block mb-2">2. Hora de Inicio</label>
                    <select x-model="time" 
                            @change="validateSchedule"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-4 py-3 text-sm text-white/80 focus:outline-none focus:border-emerald-500/50 transition-all [&>option]:bg-slate-900 [&>option]:text-white">
                        <option value="">Selecciona una hora...</option>
                        <template x-for="hour in availableHours">
                            <option :value="hour.value" x-text="hour.label"></option>
                        </template>
                    </select>
                </div>

                <div>
                    <label class="text-xs font-bold uppercase tracking-wider text-white/50 block mb-2">3. Duración del Turno</label>
                    <div class="grid grid-cols-2 gap-3 bg-white/5 p-1 rounded-2xl border border-white/5">
                        <button type="button" @click="duration = 1; validateSchedule()" :class="duration === 1 ? 'bg-emerald-500 text-slate-950 font-bold' : 'text-white/60'" class="py-2 rounded-xl text-xs transition-all duration-300">1 Hora</button>
                        <button type="button" @click="duration = 2; validateSchedule()" :class="duration === 2 ? 'bg-emerald-500 text-slate-950 font-bold' : 'text-white/60'" class="py-2 rounded-xl text-xs transition-all duration-300">2 Horas (Máx)</button>
                    </div>
                </div>

                <div x-show="errorMessage" x-text="errorMessage" x-transition class="p-3.5 bg-rose-500/10 border border-rose-500/20 text-rose-400 rounded-2xl text-xs font-semibold"></div>

                <div class="pt-4 border-t border-white/5 flex items-center justify-between" x-show="date && time && !errorMessage">
                    <div>
                        <span class="text-xs text-white/40 block">Total a pagar:</span>
                        <span class="text-2xl font-black text-emerald-400" x-text="'$' + (priceHour * duration).toLocaleString('es-CO')"></span>
                    </div>
                    <div class="text-right text-xs text-white/50">
                        <span x-text="duration + ' hora(s) reservada(s)'"></span>
                    </div>
                </div>

                <button @click="submitBooking"
                        :disabled="!isValid || loading"
                        :class="isValid && !loading ? 'bg-emerald-500 hover:bg-emerald-400 text-slate-950' : 'bg-white/5 text-white/20 cursor-not-allowed'"
                        class="w-full font-bold py-4 px-6 rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 text-sm shadow-lg">
                    <span x-show="!loading">Confirmar Reserva</span>
                    <span x-show="loading" class="animate-pulse">Procesando pago seguro...</span>
                </button>
            </div>

        </div>
    </div>
</main>
@endsection
@push('scripts')
  @vite(['resources/js/booking-system.js'])
@endpush