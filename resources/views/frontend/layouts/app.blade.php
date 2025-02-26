<html lang="{{ app()->getLocale() }}">
    <head>
        <title>Blog - @yield('title')</title>
    </head>
    <body>
        @include('frontend.layouts.header')
        <div class="container">
            @yield('content')
        </div>
        @include('frontend.layouts.footer')
    </body>
</html>