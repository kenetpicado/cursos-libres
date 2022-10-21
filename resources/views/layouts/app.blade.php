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
    @livewireStyles

    <style>
        .btn {
            min-width: 5rem;
        }
        @media screen and (max-width: 800px) {

            tbody,
            tr,
            td {
                display: block;
            }

            thead {
                display: none;
            }

            tbody {
                float: left;
            }

            td:before {
                content: attr(data-title);
                margin-right: 0.5em;
                font-weight: bold;
            }

            tr {
                border-top: 1px solid #aaaa;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        @include('partials.sidebar')

        <main class="container my-4">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script>
        function delete_element($id, $name) {
            $result = confirm("¿Desea eliminar " + $name + "?");
            if ($result)
                Livewire.emit('delete_element', $id)
        };

        Livewire.on('open-modal', function() {
            document.getElementById('btn-open-modal').click();
        });

        Livewire.on('close-modal', function() {
            document.getElementById('btn-close-modal').click();
        });
    </script>
</body>

</html>
