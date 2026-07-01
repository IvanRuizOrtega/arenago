@props([
    'links' => [],
    'userAvatar' =>  getPropertyAuth(property: 'google_avatar') 
])

<nav x-data="{ open: false }" class="sticky top-0 z-50 w-full px-4 py-4 md:px-6">
  <div class="mx-auto max-w-7xl relative">
    
    <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-white/10 px-6 py-3 backdrop-blur-xl shadow-[0_8px_32px_0_rgba(0,0,0,0.37)]">
      
      <div class="flex items-center gap-2">
        <div class="h-8 w-8 rounded-lg bg-gradient-to-br from-emerald-400 to-cyan-500 shadow-lg shadow-emerald-500/20"></div>
        <a class="text-xl font-black tracking-tighter text-white uppercase italic" href="/">Arena<span class="text-emerald-400">.go</span></a>
      </div>

      <ul class="hidden items-center gap-8 md:flex">
        @foreach($links as $label => $url)
          @if(authCheckRole(...$url['roles']??[]))
            @php
              $path = $url['path']??'';
            @endphp
            <li>
                <a href="{{ route($path) }}" 
                  class="text-sm font-medium {{ Route::is($path . '*') ? 'text-emerald-400' : 'text-slate-300 hover:text-white' }} transition-colors">
                    {{ $label }}
                </a>
            </li>
          @endif
        @endforeach
      </ul>
      <div class="flex items-center gap-4">
        @if(isAuth())
        <form method="POST" action="{{ route(\Src\Resources\Constants\Routes::LOGOUT) }}" id="logout-form">
          @csrf
          <x-btn 
          type="submit"
          title="Cerrar Sesión" 
          class="cursor-pointer 
            relative 
            block 
            h-10 
            w-10 
            overflow-hidden 
            rounded-full 
            border-2 
            border-red-500/30 
            bg-white/10 
            p-0.5 
            transition-all 
            hover:scale-110 
            hover:border-red-500 
            active:scale-95 
            focus:outline-none
            group">
            <x-image 
                path="{{ $userAvatar }}" 
                isAsset="FALSE"
                alt="Avatar" 
                class="h-full w-full rounded-full object-cover transition-opacity group-hover:opacity-40" /> 
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
            </div>
          </x-btn>
        </form>
        @endif
        <x-btn @click="open = !open" class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/10 text-white md:hidden active:scale-90 transition-transform">
          <svg x-show="!open" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
          <svg x-show="open" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
        </x-btn>
      </div>
    </div>

    <div 
      x-show="open" 
      x-cloak
      @click.away="open = false"
      x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
      x-transition:enter-end="opacity-100 scale-100 translate-y-0"
      class="absolute left-0 right-0 top-full mt-3 z-50 overflow-hidden rounded-3xl border border-white/20 bg-white/5 backdrop-blur-3xl shadow-2xl md:hidden"
    >
      <ul class="flex flex-col p-3 gap-2">
        @foreach($links as $label => $url)
        @if(authCheckRole(...$url['roles']??[]))
            @php
              $path = $url['path']??'';
            @endphp
            <li>
                <a href="{{ route($path) }}"
                  class="flex items-center rounded-2xl px-4 py-4 transition-all {{ Route::is($path . '*') ? 'bg-emerald-500/20 text-emerald-400' : 'text-slate-200 hover:bg-white/10' }}">
                    <span class="text-lg font-semibold">{{ $label }}</span>
                </a>
            </li>
        @endif
        @endforeach
      </ul>
    </div>

  </div>
</nav>