<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
        <script src="/js/utils.js?rnd=<?php echo uniqid();?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="/css/fontawesome/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/styles.css?rnd=1" />

        <!-- PWA  -->
        <meta name="theme-color" content="#6777ef"/>
        <link rel="apple-touch-icon" href="{{ asset('/logo.png') }}">
        <link rel="manifest" href="{{ asset('/manifest.json') }}">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
            <div id="alert" class="alert alert-warning hidden" role="alert">

            </div>
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow hidden">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
            <br/><br/>
            <nav x-data="{ open: false }" class="bg-white border-b border-gray-100 footer">
                <div class="bg-white shadow max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" style="width:100%">
                    <div class="flex justify-between h-16">
                        <div class="row w-100" style="padding-top:20px;">
                            <div class="col tc">
                                <i id="logo-mobile-screen" title="L'écran reste allumé" class="fa fa-mobile-screen icon_footer"></i>
                            </div>
                            <div class="col tc">
                                <i id="logo-gps" class="fa fa-location-pin-lock icon_footer" title="La localisation GPS se rafraichit toutes les 5 minutes"></i>
                            </div>
                            <div class="col tc">
                                <i id="logo-arret" title="Recherchez un arrêt" class="findArret fa-solid fa-magnifying-glass icon_footer"></i>
                            </div>
                            <div class="col tc">
                                @if ($_SERVER['REQUEST_URI'] == "/infos")
                                    <a title="Informations" href="/"><i class="fa-solid fa-list icon_footer"></i></a>
                                @else
                                    <a title="Informations" href="/infos"><i class="fa fa-info icon_footer"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <script src="{{ asset('/sw.js') }}"></script>
        <script>
            if (!navigator.serviceWorker.controller) {
                navigator.serviceWorker.register("/sw.js").then(function (reg) {
                    console.log("Service worker has been registered for scope: " + reg.scope);
                });
            }
        </script>
    </body>
</html>
