<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])


  <!-- Styles -->
  @livewireStyles

  <!-- Título -->
  <title>V & C</title>

  <!-- Metadescripcion -->
  <meta name="description" content=""> <!-- 130-160 caracteres -->

  <!-- Keywords -->
  <meta name="keywords" content="">

  <!-- Versión canónica -->
  <link rel="canonical" href=""> <!-- Indica la URL canónica de la página web -->

  <!-- Robots -->
  <meta name="robots" content="index, follow"> <!-- Permite a los motores de búsqueda indexar y seguir la página web  -->

  <!-- Favicon -->
  <link rel="icon" href="/imagenes/favicon.png"> <!-- Ruta de la imagen - .ico, .svg, .png - 32px x 32px -->

  <!-- Autor -->
  <meta name="author" content="Metahorus">

  <!-- Título - Redes -->
  <meta name="og:title" content="Víctor & Cristina"> <!-- Define el título de la página web para Facebook -->
  <meta name="twitter:title" content="Víctor & Cristina"> <!-- Define el título de la página web para Twitter -->

  <!-- Descripción - Redes -->
  <meta name="og:description" content="..."> <!-- Define la descripción de la página web para Facebook -->
  <meta name="twitter:description" content="..."> <!-- Define la descripción de la página web para Twitter -->

</head>

<body>
  
  {{-- ------------------ Contenido ------------------ --}}
  <main class="Contenido">
    @yield('content')
  </main>

  @livewireScripts
</body>

</html>
