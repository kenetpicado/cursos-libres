<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
        }
        
    </style>
</head>

<body>
    <main class="form-signin w-100 m-auto">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            {{-- <img class="mb-4" src="/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
            <h1 class="h3 mb-3 fw-normal text-center">{{config('app.name')}}</h1>

            <x-input name="email"></x-input>
            <x-input name="password" type="password"></x-input>

            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" name="remember" id="remember"
                    {{ old('remember') ? 'checked' : '' }}> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Iniciar sesión</button>
        </form>
    </main>

</body>

</html>
