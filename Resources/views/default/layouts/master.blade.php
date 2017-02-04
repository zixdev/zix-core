<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zix Development') }}</title>

    <!-- Styles -->
    <link href="{{ mix('assets/'.site()->ui.'/css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    @include(site()->partial('core::default.partials.header'))

    @yield('main')

    @include(site()->partial('core::default.partials.footer'))
</div>

<!-- Scripts -->
<script src="{{ mix('assets/'.site()->ui.'/js/app.js') }}"></script>
</body>
</html>
