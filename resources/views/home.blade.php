@extends('layouts.app')

@section('content')
  <div class="HomeA">
    <img src="{{ asset('/imagenes/VC.01.webp') }}" alt="">
  </div>

  {{-- <div class="HomeB">
    <h2>Nuestro mejor recuerdo serán las miradas, las sonrisas y los instantes compartidos.</h2>
    <h2>Esta página es nuestro álbum, creado entre todos, para que cada foto que guardes sea parte de la historia de
      nuestro gran día.</h2>
  </div>

  <div class="HomeC">
    <div class="HomeC0">
        <div>
            <div class="HomeC1">
                <label for="">Nombre</label>
                <input type="text">
            </div>
    
            <div class="HomeC2">
                <input type="image" multiple>
            </div>
        </div>
    </div>
  </div>

  <div class="HomeDivisor">
    <img src="{{ asset('imagenes/VC.03.webp') }}" alt="">
  </div>

  <div class="HomeD" x-data="{ showModal: false, imageSrc: '' }">
    <img src="{{ asset('imagenes/VC.03.webp') }}" alt="" alt="Imagen ampliable"
      @click="imageSrc = $el.src; showModal = true" class="cursor-pointer">

    <template x-if="showModal">
      <div x-show="showModal" @click.self="showModal = false"
        class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50" x-transition>
        <div class="relative">

          <button @click="showModal = false"
            class="absolute top-3 right-3 text-white text-3xl font-bold hover:scale-110 transition">
            &times;
          </button>

          <img :src="imageSrc" class="max-w-[90vw] max-h-[90vh] rounded-lg shadow-lg">
        </div>
      </div>
    </template>
  </div> --}}
@endsection
