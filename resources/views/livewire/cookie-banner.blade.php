<div>
    <div x-data="{show: true}">
        @if (!Cookie::has('cookies'))
            
            <div class="TarjetaCookie" x-show="show">
                <div>
                    <div class="TarjetaCookieTitulo">
                        <img src="" alt="">
                        <h2>{{ __('Aviso de cookies') }}</h2>
                    </div>
        
                    <div class="TarjetaCookieTexto">
                        <p>{{ __('Texto cookies') }} 
                        <a href="{{ route('cookies') }}">{{ __('Politica de cookies') }}</a>.
                        </p>
                    </div>
                
                    <button wire:click="aceptar()" @click="show = false" class=""> {{ __('Accept') }} </button>
                </div>
            </div>
        @endif
    </div>
    
</div>
