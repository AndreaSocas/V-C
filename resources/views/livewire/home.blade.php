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
          <input type="text" wire:model='nombre' required>
          @error('nombre')
            <span class="text-lg font-semibold text-yellow-400">{{ $message }}</span>
          @enderror
        </div>

        <div class="HomeC1">
          <label for="">Mensaje (solo lo verán los novios)</label>
          <textarea name="" id="" cols="30" rows="5" wire:model='mensaje'></textarea>
          @error('mensaje')
            <span class="text-lg font-semibold text-yellow-400">{{ $message }}</span>
          @enderror
        </div>

        <div class="HomeC2"x-data="autoFilesToLivewire({ maxMb: 5 })" x-init>
          {{-- <label for="fotos" class="btn-fotos">Seleccionar fotos</label>
          <input type="file" id="fotos" class="input-fotos" multiple required accept="image/*" wire:model='imagenes'> --}}

          <!-- Input visible (solo UX) -->
          <label for="fotos_visible" class="btn-fotos">Seleccionar fotos</label>
          <input id="fotos_visible" type="file" multiple accept="image/*" class="input-fotos" @change="onFilesSelected($event)">

          <!-- Input hidden que sí tiene wire:model para Livewire -->
          <input id="fotos_livewire" type="file" multiple style="display:none" wire:model="imagenes">

          <!-- Mensaje de archivos rechazados -->
          <template x-if="rejected.length">
            <div class="text-lg font-semibold text-yellow-400">
              Archivos demasiado grandes:
              <span x-text="rejected.join(', ')"></span>
            </div>
          </template>

          <script>
            function autoFilesToLivewire({
              maxMb = 5
            } = {}) {
              return {
                maxMb,
                maxBytes: maxMb * 1024 * 1024,
                previews: [], // object URLs de las imágenes válidas
                files: [], // Files válidos (File objects)
                rejected: [], // nombres rechazados
                processing: false,
                // Handler principal, reemplaza cualquier selección anterior
                async onFilesSelected(e) {
                  if (this.processing) return;
                  this.processing = true;

                  // limpiar estado previo
                  this._clearAll();

                  const input = e.target;
                  const chosen = Array.from(input.files || []);

                  // filtrar (tipo y tamaño). Si quieres más validaciones añade aquí.
                  for (const f of chosen) {
                    if (!f.type || !f.type.startsWith('image/')) {
                      this.rejected.push(f.name + ' (no imagen)');
                      continue;
                    }
                    if (f.size > this.maxBytes) {
                      this.rejected.push(f.name + ` (>${this.maxMb}MB)`);
                      continue;
                    }

                    this.files.push(f);
                    this.previews.push(URL.createObjectURL(f));
                  }

                  // limpiar el input visible para permitir re-selecciones iguales
                  input.value = '';

                  // si no hay files válidos, vaciamos el input livewire y salimos
                  if (this.files.length === 0) {
                    // limpiamos livewire input asíncronamente (evita reentradas)
                    setTimeout(() => {
                      const live = document.getElementById('fotos_livewire');
                      try {
                        live.value = '';
                      } catch (err) {}
                      live.dispatchEvent(new Event('change', {
                        bubbles: true
                      }));
                      this.processing = false;
                    }, 50);
                    this.processing = false;
                    return;
                  }

                  // si hay files válidos, volcarlos al input hidden que tiene wire:model
                  // (reemplaza lo anterior, no append)
                  const dt = new DataTransfer();
                  this.files.forEach(f => dt.items.add(f));
                  const liveInput = document.getElementById('fotos_livewire');
                  liveInput.files = dt.files;

                  // dispatch asíncrono para evitar cualquier reentrada con Livewire
                  setTimeout(() => {
                    liveInput.dispatchEvent(new Event('change', {
                      bubbles: true
                    }));
                    this.processing = false;
                  }, 50);
                },

                // eliminar una preview concreta y recalcular input livewire
                remove(index) {
                  // liberar url
                  URL.revokeObjectURL(this.previews[index]);
                  this.previews.splice(index, 1);
                  this.files.splice(index, 1);
                  // actualizar input livewire con los files restantes
                  const dt = new DataTransfer();
                  this.files.forEach(f => dt.items.add(f));
                  const liveInput = document.getElementById('fotos_livewire');
                  liveInput.files = dt.files;
                  // dispatch async
                  setTimeout(() => liveInput.dispatchEvent(new Event('change', {
                    bubbles: true
                  })), 50);
                },

                // helper para limpiar todo
                _clearAll() {
                  // liberar urls antiguas
                  this.previews.forEach(u => URL.revokeObjectURL(u));
                  this.previews = [];
                  this.files = [];
                  this.rejected = [];
                }
              }
            }
          </script>

          @error('imagenes')
            <span class="text-lg font-semibold text-yellow-400">{{ $message }}</span>
          @enderror
          @error('imagenes.*')
            <span class="text-lg font-semibold text-yellow-400">{{ $message }}</span>
          @enderror
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
