@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel') {{-- Cambiar Laravel por el nombre de la web --}}
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="{{-- Nombre de la web --}}"> {{-- Cambiar imagen después de publicada la web --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
