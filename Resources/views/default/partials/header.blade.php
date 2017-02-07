<header>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    @if(Menu::get('navbar'))
                    @include(config('laravel-menu.views.bootstrap-items'), array('items' => Menu::get('navbar')->roots()))
                    @endif
                            <!-- Authentication Links -->
                    @if (Auth::guest())

                    @else
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{--{{ Auth::user()->username }}--}}
                                <img class="nav-profile-photo m-r-xs" src="{{ \Auth::user()->avatar ? \Auth::user()->avatar : 'https://www.gravatar.com/avatar/8798bd6307b5288654155f168d4288bf.jpg?s=200&amp;d=mm' }}">
                                <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <!-- Settings -->
                                <li class="dropdown-header">Settings</li>

                                <li>
                                    <a href="{{ url('settings') }}">
                                        <i class="fa fa-btn fa-fw fa-cog"></i>Your Settings
                                    </a>
                                </li>

                                <li class="divider"></li>
                                <li>
                                    <a href="{{ url('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-btn fa-fw fa-sign-out"></i>
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>