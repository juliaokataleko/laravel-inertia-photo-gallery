<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title', 'Home') {{ env('APP_NAME') }}</title>

    <link rel="stylesheet" href="{{ asset('build/assets/app.62e0d76f.css') }}">

</head>
<body>

    <header class="p-5 bg-emerald-300">

        <div class="container mx-auto flex flex-row justify-between align-items-center">
            <a href="#">
                {{ env('APP_NAME') }}
            </a>

            <div>
                <a href="#" class="p-2 rounded bg-green-800">Entrar</a>
            </div>
        </div>

    </header>

    <div class="container">
        @yield('content')
    </div>

    <footer>
        &copy; {{ date('Y') }}
    </footer>

</body>
</html>
