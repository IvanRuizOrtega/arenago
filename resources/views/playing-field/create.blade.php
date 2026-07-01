@extends('layouts.app') 
@section('content')
    <x-back-page :path="\Src\Resources\Constants\Routes::MY_SPORT_CENTER_SHOW" :_id="$_id??NULL"> </x-back-page>
    <div class="view py-8 px-4 animate-in fade-in duration-500">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
                @php
                    $isEdit = (bool) ($item ?? false);
                    $route = $isEdit 
                        ? route(\Src\Resources\Constants\Routes::MY_SPORT_CENTER_EDIT_FORM, [ $_id??NULL , $item->_id??NULL]) 
                        : route(\Src\Resources\Constants\Routes::MY_SPORT_CENTER_CREATE, $_id??NULL);
                @endphp 
            <div class="lg:col-span-12 p-8 md:p-12 rounded-[2rem] bg-slate-900/40 relative overflow-hidden border border-white/10">
                <div class="absolute top-0 right-0 p-8 opacity-5 text-6xl italic font-black">{{ \Src\Resources\Constants\Headers::getKeys()[1]??'' }}</div>
                
                <header class="mb-6">
                    <h2 class="text-3xl font-bold text-white">{{ $isEdit ? 'Editar' : 'Creacion'}}</h2>
                    <p class="text-slate-400 mt-2">{{ $isEdit ? 'Edita un campo' : 'Crea un campo nuevo'}}</p>
                </header>

                <form class="space-y-6" action="{{ $route }}" method="POST">
                    @csrf
                    @if($isEdit) @method('PUT') @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-2">
                            <x-label label="Nombre"/>
                            <x-input name="name" 
                                placeholder="Ej: Nombre de tu campo / cancha" 
                                :value="old('name', $isEdit ? $item->name : NULL)"/>
                            <x-error-message name="name"/>
                        </div>

                        <div class="space-y-2">
                            <x-label label="Tipo"/>
                            <x-select name="type" 
                                placeholder="Selecciona una opción" 
                                :options="\Src\Resources\Constants\Options::SPORT_CENTERS" 
                                :value="old('type', $isEdit ? $item->type : NULL)" />
                            <x-error-message name="type"/>
                        </div>

                        <div class="space-y-2">
                            <x-label label="Precio"/>
                            <x-input name="price_hour" 
                                placeholder="Ej: 120000 / horas" 
                                :value="old('price_hour', $isEdit ? $item->price_hour : NULL)" type="number"/>
                            <x-error-message name="price_hour"/>
                        </div>
                        
                        <div class="space-y-2">
                            <x-label label="Es cubierto?"/>
                             <x-select name="covered" 
                                placeholder="Selecciona una opción" 
                                :options="\Src\Resources\Constants\Options::YES_OR_NOT" 
                                :value="old('type', $isEdit ? $item->covered : NULL)" />
                            <x-error-message name="covered"/>
                        </div>
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
