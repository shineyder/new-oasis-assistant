<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>{{ config('app.name', 'New Oasis Assistant') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!--Font Awesome -->
        <script src="https://kit.fontawesome.com/de15e2fa09.js" crossorigin="anonymous"></script>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="{{ mix('css/style.css') }}">
        <link rel="stylesheet" href="{{ mix('css/adminlte.css') }}">
        <link rel="stylesheet" href="{{ mix('css/overlayScrollbars.css') }}">

        @livewireStyles

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous" defer></script>

        <!-- Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous" defer></script>

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ mix('js/adminlte.js') }}" defer></script>
        <script src="{{ mix('js/overlayScrollbars.js') }}" defer></script>
    </head>
    <body class="hold-transition sidebar-mini layout-fixed font-sans antialiased">
        <div class="wrapper">
            <div class="min-h-screen bg-gray-100">
                @livewire('navigation-menu')
                @include('main-sidebar')

                <div class="content-wrapper">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow" style="height: 64px">
                            <div class="mx-auto sm:px-6 lg:px-8">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h1 style="padding-top: 8px;">{{ $header }}</h1>
                                        </div>
                                        <div class="col-sm-6">
                                            <ol class="breadcrumb float-sm-right" style="height: 64px">
                                                <li class="breadcrumb-item" style="padding-top: 8px;">
                                                    <a href="{{ route('dashboard') }}">{{ __('Home') }}</a>
                                                </li>
                                                <li class="breadcrumb-item active" style="padding-top: 8px;">
                                                    {{ $header }}
                                                </li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <main>
                        <section class="content" style="padding-top: 40px;">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </section>
                    </main>
                </div>
            </div>

            @stack('modals')

            @livewireScripts
        </div>
    </body>
</html>
