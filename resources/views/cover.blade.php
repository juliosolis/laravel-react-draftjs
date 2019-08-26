<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">

</head>
<body class="text-center">
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">{{ config('app.name', 'Laravel') }}</h3>
            <nav class="nav nav-masthead justify-content-center">
                @auth
                    <a class="nav-link active" href="{{ url('/email') }}">Home</a>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>

                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading">Manage your Email efficiently and effectively.</h1>
        <p class="lead">Email editor is and Advance Email Manager.</p>
        <p class="lead">
            @guest
                <a href="{{ route('login') }}" class="btn btn-lg btn-secondary">Learn more</a>
            @else
                <a href="{{ route('email') }}" class="btn btn-lg btn-secondary">Go</a>
            @endguest
        </p>
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>Julio Solis Lainez &copy; {{ date('Y') }}</p>
        </div>
    </footer>
</div>
</body>
</html>
