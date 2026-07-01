<!-- LOGIN -->
<div class="view py-12">
  <div class="max-w-md mx-auto glass p-8 md:p-12 rounded-[2.5rem]">
      <div class="text-center space-y-2 mb-10">
          <h2 class="text-3xl font-bold">¡Hola de nuevo!</h2>
          <p class="text-slate-500">¿Listo para el próximo partido?</p>
      </div>
      <div class="space-y-3">
        <x-btn onclick="window.location='{{ route('google.auth') }}'">
            <x-image path="svg/google-icon.svg" width="8" height="8" />  Continuar con Google
        </x-btn>
      </div>
  </div>
</div>