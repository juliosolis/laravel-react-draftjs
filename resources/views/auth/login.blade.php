<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="SignIn" class="text-center">
<form class="form-signin" method="POST" action="{{ route('login') }}">
    @csrf

    <img class="mb-4" src="{{ asset('imgs/email-svg-icon-27.jpg') }}" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">{{ __('Please sign in') }}</h1>
    <label for="email" class="sr-only">{{ __('E-Mail Address') }}</label>
    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email address"
           name="email" value="{{ old('email') }}" required
           autocomplete="email" autofocus>
    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror

    <label for="password" class="sr-only">{{ __('Password') }}</label>
    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" required
           autocomplete="current-password">
    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
    <a class="btn btn-lg btn-info btn-block" href="{{ route('register') }}">{{ __('Register') }}</a>

    @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
    @endif

    <p class="mt-5 mb-3 text-muted">&copy; {{ date('Y') }}</p>
</form>
</body>
</html>
