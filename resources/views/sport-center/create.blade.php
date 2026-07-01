@extends('layouts.app') 
@section('content')
    <x-back-page :path="\Src\Resources\Constants\Routes::MY_SPORT_CENTER_INDEX"> </x-back-page>
    <div class="view py-8 px-4 animate-in fade-in duration-500">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
                @php
                    $isEdit = (bool) ($item ?? false);
                    $route = $isEdit 
                        ? route(\Src\Resources\Constants\Routes::SPORT_CENTER_EDIT, $item->_id) 
                        : route(\Src\Resources\Constants\Routes::SPORT_CENTER_CREATE);
                @endphp 
            <div class="lg:col-span-12 p-8 md:p-12 rounded-[2rem] bg-slate-900/40 relative overflow-hidden border border-white/10">
                <div class="absolute top-0 right-0 p-8 opacity-5 text-6xl italic font-black">{{ \Src\Resources\Constants\Headers::getKeys()[1]??'' }}</div>
                
                <header class="mb-6">
                    <h2 class="text-3xl font-bold text-white">{{ $isEdit ? 'Editar' : 'Creacion'}}</h2>
                    <p class="text-slate-400 mt-2">{{ $isEdit ? 'Edita una sede' : 'Crea una nueva sede'}}</p>
                </header>

               

                <form class="space-y-6" action="{{ $route }}" method="POST">
                    @csrf
                    @if($isEdit) @method('PUT') @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-2">
                            <x-label label="Nombre"/>
                            <x-input name="name" 
                                placeholder="Ej: Nombre de tu centro deportivo" 
                                :value="old('name', $isEdit ? $item->name : NULL)"/>
                            <x-error-message name="name"/>
                        </div>

                        <div class="space-y-2">
                            <x-label label="Direccion"/>
                            <x-input name="address" 
                                placeholder="Ej: Calle 129..." 
                                :value="old('address', $isEdit ? $item->address : NULL)"/>
                            <x-error-message name="address"/>
                        </div>
                        
                        <div class="space-y-2">
                            <x-label label="Ciudad"/>
                            <x-select name="city" 
                                placeholder="Selecciona una opción" 
                                :options="\Src\Resources\Constants\Options::CITIES" 
                                :value="old('city', $isEdit ? $item->city : NULL)" />
                            <x-error-message name="city"/>
                        </div>

                        <div class="space-y-2">
                            <x-label label="Latitud"/>
                            <x-input name="lat" 
                                placeholder="Ej: 4.XXXX"
                                :value="old('lat', $isEdit ? $item->lat : NULL)" />
                            <x-error-message name="lat"/>
                        </div>

                        <div class="space-y-2">
                            <x-label label="longitud"/>
                            <x-input name="long" 
                                placeholder="Ej: -74.XXXX"
                                :value="old('long', $isEdit ? $item->long : NULL)" />
                            <x-error-message name="long"/>
                        </div>
                        
                    </div>

                    <div class="space-y-3">
                        @foreach(\Src\Resources\Constants\Options::DAYS as $key => $day)
                            @php
                                $existingDay = old("working_days.$key", $isEdit ? $item->working_days->$key ?? NULL : NULL);
                                $isActive = !empty($existingDay);
                                $openTime = $existingDay->open ?? '08:00:00';
                                $closeTime = $existingDay->close ?? '22:00:00';
                            @endphp
                            <div x-data="{ active: {{ $isActive ? 'true' : 'false' }} }" 
                                class="flex flex-wrap md:flex-nowrap items-center gap-4 bg-slate-800/50 p-4 rounded-2xl border border-white/5 transition-all" 
                                :class="active ? 'border-emerald-500/30 bg-emerald-500/5' : 'opacity-60'">
                                <div class="flex items-center space-x-3 w-28">
                                    <input type="checkbox" 
                                        x-model="active" 
                                        name="active_days[{{ $key }}]"
                                        {{ $isActive ? 'checked' : '' }}
                                        class="w-5 h-5 rounded border-white/10 bg-slate-700 text-emerald-500 focus:ring-emerald-500">
                                    <span class="text-white font-medium" :class="active ? 'text-emerald-400' : 'text-slate-400'">{{ $day }}</span>
                                </div>

                                <div class="flex-1 grid grid-cols-2 gap-4">
                                    <div class="space-y-1" x-show="active">
                                        <x-input 
                                            type="time" 
                                            name="working_days[{{ $key }}][open]" 
                                            step="1"
                                            value="{{ $openTime }}"
                                            ::disabled="!active" 
                                        />
                                    </div>
                                    <div class="space-y-1" x-show="active">
                                        <x-input 
                                            type="time" 
                                            name="working_days[{{ $key }}][close]" 
                                            step="1"
                                            value="{{ $closeTime }}" 
                                            ::disabled="!active" 
                                        />
                                    </div>
                                    <div class="col-span-2 text-slate-500 italic text-sm py-2" x-show="!active">
                                        Cerrado
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <x-btn type="submit"
                        class="w-full md:w-auto px-10 py-4 bg-emerald-500 rounded-2xl font-bold text-white shadow-lg shadow-emerald-500/30 hover:scale-105 transition-all"> 
                        Guardar
                    </x-btn>
                </form>
            </div>

        </div>
    </div>
@endsection
