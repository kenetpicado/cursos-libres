<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    <div id="app">
        @include('partials.sidebar')

        <main class="container my-4">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Inicio</a></li>
                    @yield('bread')
                </ol>
            </nav>
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    
    <script>
        function delete_element($id, $name) {
            $result = confirm("¿Desea eliminar " + $name + "?");
            if ($result)
                Livewire.emit('delete_element', $id)
        };

        Livewire.on('open-modal', function() {
            document.getElementById('btn-open-modal').click();
        });

        Livewire.on('open-modal-pagar', function() {
            document.getElementById('btn-open-modal-pagar').click();
        });

        Livewire.on('close-modal', function() {
            document.getElementById('btn-close-modal').click();
        });
    </script>
</body>

</html>
