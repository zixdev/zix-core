@extends(site()->partial('core::%s.layouts.master'))


@section('main')

    @yield('before-header')
    @section('header')
        @include(site()->partial('core::%s.partials.header'))
    @show
    @yield('after-header')

    @yield('before-banner')
    @section('banner')
        @include(site()->partial('core::%s.partials.banner'))
    @show
    @yield('after-banner')

    {{--Bread Cumb--}}
    @yield('before-content')
    <div class="container">
        @yield('content')
    </div>
    @yield('after-content')

    @yield('before-footer')
    @section('footer')
        @include(site()->partial('core::%s.partials.footer'))
    @show
    @yield('after-footer')
@stop