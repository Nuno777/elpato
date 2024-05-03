<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <div class="app-brand">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('/images/icon.png') }}" alt="Mono" style="height: 100%;">
                <span class="brand-name" style="width: 100%;">ElPato</span>
            </a>
        </div>
        <div id="sidebar" class="sidebar sidebar-with-footer">
            <div class="app-brand">
            </div>
            <div class="sidebar-left" data-simplebar style="height: 100%;">

                <ul class="nav sidebar-inner" id="sidebar-menu">

                    <li class="@if (Request::is('dashboard')) active @endif">
                        <a class="sidenav-item-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-monitor"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>

                    @if (auth()->check() && auth()->user()->type == 'admin')
                        <li
                            class="has-sub @if (Request::is('adminpainel')) active show @elseif (Request::is('createuser')) active show
                            @elseif (Request::is('allusers')) active show @elseif (Request::is('allorders')) active show @elseif (Request::is('allftid')) active show @endif">
                            <a class="sidenav-item-link" data-toggle="collapse" data-target="#adminpainel"
                                href="{{ route('adminpainel') }}" aria-expanded="false" aria-controls="adminpainel">
                                <i class="mdi mdi-monitor-dashboard"></i>
                                <span class="nav-text">Admin Functions</span>
                                <b class="caret"></b>
                            </a>

                            <ul class="collapse @if (Request::is('adminpainel')) show @elseif (Request::is('createuser')) show
                            @elseif (Request::is('allusers')) show @elseif (Request::is('allorders')) show @elseif (Request::is('allftid')) show @endif"
                                id="adminpainel" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li class="@if (Request::is('adminpainel')) active @endif">
                                        <a class="sidenav-item-link" href="{{ route('adminpainel') }}">
                                            <span class="nav-text">Admin Painel</span>
                                        </a>
                                    </li>

                                    <li class="@if (Request::is('createuser')) active @endif">
                                        <a class="sidenav-item-link" href="{{ route('createuser') }}">
                                            <span class="nav-text">Create User</span>
                                        </a>
                                    </li>
                                    <li class="@if (Request::is('allusers')) active @endif">
                                        <a class="sidenav-item-link" href="{{ route('user.all') }}">
                                            <span class="nav-text">All Users</span>
                                        </a>
                                    </li>
                                    <li class="@if (Request::is('allorders')) active @endif">
                                        <a class="sidenav-item-link" href="{{ route('orders.all') }}">
                                            <span class="nav-text">All Orders</span>
                                        </a>
                                    </li>
                                    <li class="@if (Request::is('allftid')) active @endif">
                                        <a class="sidenav-item-link" href="{{ route('ftid.all') }}">
                                            <span class="nav-text">All FTIDs</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>
                    @endif

                    @if (auth()->check() && auth()->user()->type == 'admin' || auth()->user()->type == 'general' || auth()->user()->type == 'worker')
                        <li class="@if (Request::is('drops')) active @endif">
                            <a class="sidenav-item-link" href="{{ route('drops') }}">
                                <i class="mdi mdi-truck"></i>
                                <span class="nav-text">Drops</span>
                            </a>
                        </li>

                        <li class="@if (Request::is('orders')) active @endif">
                            <a class="sidenav-item-link" href="{{ route('orders') }}">
                                <i class="mdi mdi-package-variant-closed"></i>
                                <span class="nav-text">Orders</span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->check() && auth()->user()->type == 'admin' || auth()->user()->type == 'general')
                        <li
                            class="@if (Request::is('ftid')) active @elseif(Request::is('createftid')) active @endif">
                            <a class="sidenav-item-link" href="{{ route('ftid') }}">
                                <i class="mdi mdi-file-pdf"></i>
                                <span class="nav-text">FTID</span>
                            </a>
                        </li>
                    @endif

                    {{--  <li class="@if (Request::is('analytics')) active @endif">
                        <a class="sidenav-item-link" href="{{ '/analytics' }}">
                            <i class="mdi mdi-chart-line"></i>
                            <span class="nav-text">Analytics</span>
                        </a>
                    </li>

                    <li class="@if (Request::is('bitcoin')) active @endif">
                        <a class="sidenav-item-link" href="{{ '/bitcoin' }}">
                            <i class="mdi mdi-bitcoin"></i>
                            <span class="nav-text">Bitcoin</span>
                        </a>
                    </li> --}}

                </ul>

            </div>
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <div class="app-brand">
                </div>
                <div id="sidebar" class="sidebar sidebar-with-footer">
                    <div class="app-brand">
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>

<div class="page-wrapper">

    <header class="main-header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <span class="page-title">@yield('page-title')</span>

            <div class="navbar-right ">
                <!-- User Account -->
                <ul class="nav navbar-nav">
                    <li class="dropdown user-menu">
                        <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                            @if (Auth::check() && Auth::user()->id == '1')
                                <img src="{{ asset('/images/user/skeleton.png') }}" class="user-image rounded-circle"
                                    alt="User Image" />
                            @elseif (Auth::check() && Auth::user()->id == '2')
                                <img src="{{ asset('/images/user/pekka.png') }}" class="user-image rounded-circle"
                                    alt="User Image" />
                            @elseif (Auth::check() && Auth::user()->id == '3')
                                <img src="{{ asset('/images/user/et.png') }}" class="user-image rounded-circle"
                                    alt="User Image" />
                            @elseif (Auth::check() && Auth::user()->id == '4')
                                <img src="{{ asset('/images/user/calvo.png') }}" class="user-image rounded-circle"
                                    alt="User Image" />
                            @else
                                <img src="{{ asset('/images/user/user.png') }}" class="user-image rounded-circle"
                                    alt="User Image" />
                            @endif

                            <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            {{--  <li>
                                <a class="dropdown-link-item" href="">
                                    <i class="mdi mdi-account-outline"></i>
                                    <span class="nav-text">My Profile</span>
                                </a>
                            </li> --}}
                            <li>
                                <a class="dropdown-link-item" href="{{ route('profile.edit') }}">
                                    <i class="mdi mdi-settings"></i>
                                    <span class="nav-text">Account Setting</span>
                                </a>
                            </li>

                            <li class="dropdown-footer">
                                @if (Auth::check())
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-link-item" href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="mdi mdi-logout"></i>

                                            <span class="nav-text">Log out</span>
                                        </a>
                                    </form>
                                @endauth
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
