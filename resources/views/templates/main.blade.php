<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @yield('scripts')
    @yield('styles')
</head>
<body>
    <header>
        @yield('header')
    </header>
    <main>
        @yield('main')
    </main>
    <footer>
        @yield('footer')
    </footer>
</body>
</html>
