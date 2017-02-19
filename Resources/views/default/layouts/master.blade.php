<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Zix Development') }}</title>

    <!-- Styles -->
    <link href="{{ mix('assets/'.site()->ui.'/css/app.css') }}" rel="stylesheet">
    {!! SEO::generate() !!}
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user'      => \Auth::user() ? \Auth::user() : [],
        ]) !!};
        window.Spark = {
            // Laravel CSRF Token
            csrfToken: '{{ csrf_token() }}',

            // Current User ID
            userId: {!! Auth::user() ? Auth::id() : 'null' !!},

            // Current Team ID
            @if (Auth::user() && Zexus::usingTeams() && Auth::user()->hasTeams())
                currentTeamId: {{ Auth::user()->currentTeam->id }},
            @else
                currentTeamId: null,
            @endif

            stripeKey: '{{ config('services.stripe.key') }}'
        }
    </script>
</head>
<body>
<div id="zix-app" v-cloak>
    @yield('main')
</div>

<!-- Scripts -->
<script src="{{ mix('assets/'.site()->ui.'/js/app.js') }}"></script>
</body>
</html>
