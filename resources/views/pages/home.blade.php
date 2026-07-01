<!-- Hero Section -->
<section class="relative px-6 pt-20 pb-32 overflow-hidden">
  <!-- Círculos de Luz Decorativos (Blobs) -->
  <div class="absolute top-0 -left-20 w-72 h-72 bg-emerald-500/10 rounded-full blur-[120px]"></div>
  <div class="absolute bottom-0 -right-20 w-96 h-96 bg-blue-500/10 rounded-full blur-[150px]"></div>

  <div class="mx-auto max-w-7xl">
    <div class="text-center mb-16">
      <h1 class="text-5xl md:text-7xl font-black tracking-tighter text-white mb-6">
        EL JUEGO <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400 text-glow">EVOLUCIONÓ</span>
      </h1>
      <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto">La plataforma definitiva para gestionar y reservar canchas con tecnología de cristal.</p>
    </div>

    <!-- Grid de Propuestas (Dueño vs Cliente) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-20">

      <!-- Tarjeta para el DUEÑO -->
      <x-card 
          class="group relative overflow-hidden rounded-[2.5rem] p-8 backdrop-blur-2xl transition-all hover:border-emerald-500/40 border border-white/10 bg-white/5"
          titleSpan="Para Propietarios"
          titleBr='"Toma el control total:'
          subTitleSpan="Tu negocio en una sola pantalla."
          description="Administra horarios, pagos y estadísticas en tiempo real con nuestra interfaz inteligente.">
        @if(!isAuth())
        <x-btn 
          onclick="registerOwner('{{ route(\Src\Resources\Constants\Routes::GOOGLE_LOGIN) }}')" 
          class="flex 
              cursor-pointer
              items-center 
              gap-2 
              font-bold 
              text-emerald-400 
              group-hover:gap-4 
              transition-all">
          Gestionar mi club <span>→</span>
        </x-btn>
        @endif
      </x-card>
      

      <!-- Tarjeta para el CLIENTE -->
      <x-card 
          class="group relative overflow-hidden rounded-[2.5rem] border border-white/10 bg-white/5 p-8 backdrop-blur-2xl transition-all hover:border-blue-500/40"
          titleSpan="Para Jugadores"
          titleBr='"Tu lugar garantizado:'
          subTitleSpan="Si la ves libre, es tuya. Sin vueltas."
          description="Busca, reserva en segundos. Sin llamadas, sin esperas, solo juega."
          titleSpanColor="bg-blue-500/10 text-blue-400 border border-blue-500/20"
          subTitleSpanColor="text-blue-400"
          iconDown="⚽">
        @if(!isAuth())
        <x-btn 
          onclick="registerClient('{{ route(\Src\Resources\Constants\Routes::GOOGLE_LOGIN) }}')" 
          class="flex 
              cursor-pointer
              items-center 
              gap-2 
              font-bold 
              text-blue-400 
              group-hover:gap-4 
              transition-all">
          Reservar cancha <span>→</span>
        </x-btn>
        @endif
      </x-card>

    </div>

    <!-- Galería de Imágenes (n cantidad) -->
    <div class="mt-20">
      <h3 class="text-white font-bold text-xl mb-8 flex items-center gap-3">
        <span class="h-px w-12 bg-emerald-500"></span> Explora las sedes
      </h3>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <x-galery :images=$data> </x-galery>
      </div>
    </div>
   
  </div>
</section>

<style>
  .text-glow {
    text-shadow: 0 0 20px rgba(52, 211, 153, 0.3);
  }
</style>

@push('scripts')
  @vite(['resources/js/login-users.js'])
@endpush

