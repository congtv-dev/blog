<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>@yield('title') - Blog</title>
        <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    </head>
    <body>
        @include('frontend.layouts.header')

        <main class="container">
            @yield('content')
        </main>
        
        @include('frontend.layouts.footer')
    </body>
</html>