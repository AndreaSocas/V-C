<div>
  <div class="HomeA">
    <img src="{{ asset('/imagenes/VC.01.webp') }}" alt="">
  </div>

  <div class="HomeB">
    <h2>Nuestro mejor recuerdo serán las miradas, las sonrisas y los instantes compartidos.</h2>
    <h2>Esta página es nuestro álbum, creado entre todos, para que cada foto que guardes sea parte de la historia de
      nuestro gran día.</h2>
  </div>
  <div class="HomeC">
    <div class="HomeC0">
      <div class="HomeC9">
        <div class="HomeC1">
          <label for="">Nombre</label>
          <input type="text" wire:model='nombre'>
        </div>

        <div class="HomeC1">
          <label for="">Mensaje (solo lo verán los novios)</label>
          <textarea name="" id="" cols="30" rows="5" wire:model='mensaje'></textarea>
        </div>

        <div class="HomeC2">
          <label for="fotos" class="btn-fotos">Seleccionar fotos</label>
          <input type="file" id="fotos" class="input-fotos" multiple accept="image/*" wire:model='imagenes'>
        </div>
      </div>

      <div class="HomeC3">
        @foreach ($imagenes as $i => $imagen)
          <div class="HomeC4" wire:key='{{ $imagen->temporaryUrl() }}'>
            <img src="{{ $imagen->temporaryUrl() }}" alt="">
            <button wire:click="eliminarImagen('{{ $i }}')">Borrar imagen</button>
          </div>
        @endforeach
      </div>

      <div class="HomeC2">
        <button wire:click='guardar()' class="btn-enviar">Enviar</button>
      </div>
    </div>
  </div>
  <div class="HomeDivisor">
    <img src="{{ asset('imagenes/VC.03.webp') }}" alt="">
  </div>

  <div class="HomeD">
    @foreach ($imagenesGaleria as $imagen)
      <div x-data="{ showModal{{ $imagen->id }}: false, imageSrc: '' }">
        <img src="{{ asset('storage/' . $imagen->url) }}" alt="" alt="Imagen ampliable" x-on:click="imageSrc = $el.src; showModal{{ $imagen->id }} = true" class="cursor-pointer">

        <template x-if="showModal{{ $imagen->id }}">
          <div x-show="showModal{{ $imagen->id }}" @click.self="showModal{{ $imagen->id }} = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80" x-transition>
            <div class="relative">

              <button x-on:click="showModal{{ $imagen->id }} = false" class="absolute right-3 top-3 text-3xl font-bold text-white transition hover:scale-110">
                &times;
              </button>

              <img :src="imageSrc" class="max-h-[90vh] max-w-[90vw] rounded-lg shadow-lg">
            </div>
          </div>
        </template>
      </div>
    @endforeach
  </div>
</div>
