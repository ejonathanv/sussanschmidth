<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="The enigmatic surrealistic images of Susan Schmidt-Hazen create for the observer a magical world at once familiar and disquieting.">
        <meta name="keywords" content="susan, schmidt, hazen, susan schmidt, hazen, schmidt-hazen, art, oil, canvas, oil and canvas, paint, painting, surrealistic, roses, giant roses, airplanes, light, shadows, diminutive, figures, human, diminutive figures, humans, scale, realistic, cards, giant, jacks, figures, fedora hats, balloons">
        <title>{{ config('app.name', '© Susan Schmidt - Portfolio') }} @if(isset($description)) - {{ $description }} @endif</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        {{--@vite(['resources/css/app.css', 'resources/js/app.js'])--}}
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body class="font-sans antialiased">
        <x-sidebar />
        <section style="min-height: 100%;">
            {{ $slot }}
        </section>
        <x-footer />
    </body>
</html>
