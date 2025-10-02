<x-mail::message>
# Han contactado a traves de la web

<x-mail::panel>
<strong>Nombre:</strong> {{ $correo['nombre'] }}<br>
</x-mail::panel>

<x-mail::panel>
<strong>Email:</strong> {{ $correo['email'] }}<br>
</x-mail::panel>

<x-mail::panel>
<strong>Mensaje:</strong> {{ $correo['mensaje'] }}<br>
</x-mail::panel>

<x-mail::button :url="$correo['url']">
Responder
</x-mail::button>
<p>
    Por favor, asegúrate de responder al mensaje del cliente en el menor tiempo posible.  
</p>
<p>
    ¡Gracias por tu atención y que tengas un buen día!
</p>
</x-mail::message>

{{-- Modificaciones en views > vendor > html > header y themes > default.css--}}