<!-- Galería de Imágenes-->
 @props([
    'images' => [],
])
@foreach ($images as $image)
    <div class="group relative h-64 overflow-hidden rounded-3xl border border-white/10">
        <img src="https://images.unsplash.com/photo-1574629810360-7efbbe195018?q=80&w=800&auto=format&fit=crop" 
            class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-110" />
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex flex-col justify-end p-4">
        <span class="text-white font-bold text-sm">{{ $image->city }}</span>
        <span class="text-emerald-400 text-xs">{{ $image->address }}</span>
        </div>
    </div>
@endforeach