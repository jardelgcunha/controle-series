@php use Illuminate\Support\Facades\Route; @endphp
    <!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/sass/app.scss']) <!-- Incluindo os arquivos do Vite -->
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('series.index') }}">Home</a>

        @if(auth()->check())
            Bem-vindo {{ auth()->user()->name ?? ''}}
        @endif

        @auth
            <a href="{{ route('logout') }}">Sair</a>
        @endauth

        @guest
            @if(Route::currentRouteName() === "series.index")
            <a href="{{ route('login') }}">Entrar</a>
            @endif
        @endguest
    </div>
</nav>

<div class="container mt-3">
    <h1>{{ $title }}</h1>

    @isset($mensagemSucesso)
        <div class="alert alert-success mt-4">
            {{ $mensagemSucesso }}
        </div>
    @endisset

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{ $slot }}
</div>
</body>
</html>
