@extends(site()->partial('core::%s.layouts.master'))


@section('main')
    {{--Bread Cumb--}}
    <div class="container">
        @yield('content')
    </div>
@stop