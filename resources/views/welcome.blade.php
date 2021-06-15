<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Stripy</title>
    </head>
    <body>
        <h1>Laravel Stripy</h1>

        @if (Route::has('login'))
                @auth
                    <a href="{{ url('/checkout') }}">Checkout page</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        | <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
        @endif

        | <a href="{{ url('/account') }}">Account</a>

        | <a href="{{ url('/posts') }}">Posts</a>

        <p>
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </p>
    </body>
</html>
