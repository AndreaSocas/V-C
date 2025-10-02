@extends('layouts.app')

@section('content')

{{-- Formulario de contacto --}}
<div>
    <div x-data="{show: true}">
                
        @if ($errors->any())
        <div x-show="show">
            <div>
                @foreach ($errors->all() as $error)
                <h4>{{ $error }}</h4>
                @endforeach
            </div>
            <button wire:click="aceptar()" @click="show = false">
                {{-- <img src="{{ asset(' ') }}" alt="Cerrar"> --}}
            </button>
        </div>
        @endif

        <form action="{{ route ('ContactoEnviar') }}" id="contact-form" name="contact-form" method="POST">
            @csrf

            <input type="text" id="middlename" name="middlename" class="hidden" placeholder="Apellido">

            <label for="name" class="pb-2 text-red">{{ __('contacto.cont_01') }}</label>
            <input type="text" id="name" name="name" style="max-width: 70vw" class=" mb-4 focus:ring-0"
                placeholder="Nombre" required>

            <label for="email" class="pb-2">{{ __('contacto.cont_02') }}</label>
            <input type="text" id="email" name="email" style="max-width: 70vw" class="mb-4 focus:ring-0"
                placeholder="Email" required>

            <label for="message" class="pb-2">{{ __('contacto.cont_03') }}</label>
            <textarea type="text" id="message" name="message" style="max-width: 70vw" class="focus:ring-0"
                placeholder=" ..." required></textarea>

            <div>
                <input class="mr-2 focus:ring-0" type="checkbox" value="" id="ContactoCkeckbox" required>
                <label for="ContactoCkeckbox">
                    {{ __('contacto.cont_04') }} 
                    <a href="{{ route('avisoLegal') }}">
                        {{ __('contacto.cont_05') }}
                    </a>
                    {{ __('contacto.cont_06') }}
                    <a href="{{ route('privacidad') }}">
                        {{ __('contacto.cont_07') }}
                    </a>
                </label>
            </div>

            <div>
                <button type="submit" >{{ __('contacto.cont_08') }}</button>
            </div>

            @if (session('info'))
            <div x-show="show">
                <h4> {{ session('info') }}</h4>
                <button wire:click="aceptar()" @click="show = false">
                    {{-- <img src="{{ asset('') }}" alt="Cerrar"> --}}
                </button>
            </div>
            @endif 
        </form>
    </div>
</div>
@endsection