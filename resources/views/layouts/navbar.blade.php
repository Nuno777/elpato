<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div class="sidebar sidebar-with-footer">
        <!-- App Brand -->
        <div class="app-brand">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('/images/icon.png') }}" alt="Mono" style="height: 100%;">
                <span class="brand-name" style="width: 100%;">ElPato</span>
            </a>
        </div>

        <!-- Sidebar Content -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <!-- Sidebar Menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard Link -->
                <li class="@if (Request::is('dashboard')) active @endif">
                    <a class="sidenav-item-link" href="{{ route('dashboard') }}">
                        <i class="mdi mdi-monitor"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <!-- Admin Functions (if user is admin) -->
                @if (auth()->check() && auth()->user()->type == 'admin')
                    <li class="has-sub @if (Request::is('adminpainel') ||
                            Request::is('createuser') ||
                            Request::is('allusers') ||
                            Request::is('allorders') ||
                            Request::is('allftid') ||
                            Request::is('login-logs')) active show @endif">
                        <a class="sidenav-item-link" data-toggle="collapse" data-target="#adminpanel"
                            href="{{ route('adminpainel') }}" aria-expanded="false" aria-controls="adminpanel">
                            <i class="mdi mdi-monitor-dashboard"></i>
                            <span class="nav-text">Admin Functions</span>
                            <b class="caret"></b>
                        </a>

                        <ul class="collapse @if (Request::is('adminpainel') ||
                                Request::is('createuser') ||
                                Request::is('allusers') ||
                                Request::is('allorders') ||
                                Request::is('allftid') ||
                                Request::is('login-logs')) show @endif" id="adminpanel"
                            data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="@if (Request::is('adminpainel')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('adminpainel') }}">
                                        <span class="nav-text">Admin Panel</span>
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

                                <li class="@if (Request::is('login-logs')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('login.logs') }}">
                                        <span class="nav-text">Login & Logout Logs</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                @endif


                <!-- Drops and Orders (for authorized users) -->
                @if (auth()->check() &&
                        (auth()->user()->type == 'admin' || auth()->user()->type == 'general' || auth()->user()->type == 'worker'))
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

                <!-- FTID (for admin and general users) -->
                @if (auth()->check() && (auth()->user()->type == 'admin' || auth()->user()->type == 'general'))
                    <li class="@if (Request::is('ftid') || Request::is('createftid')) active @endif">
                        <a class="sidenav-item-link" href="{{ route('ftid') }}">
                            <i class="mdi mdi-file-pdf"></i>
                            <span class="nav-text">FTID</span>
                        </a>
                    </li>
                @endif

                <!-- Admin Functions (if user is admin) -->
                @if (auth()->check() &&
                        (auth()->user()->type == 'admin' || auth()->user()->type == 'general' || auth()->user()->type == 'worker'))
                    <li class="@if (Request::is('generator')) active @endif">
                        <a class="sidenav-item-link" href="">
                            <i class="mdi mdi-refresh"></i>
                            <span class="nav-text">Generator</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="sidebar-footer">
            <div class="sidebar-footer-content">
                <ul class="d-flex">
                    @if (auth()->check() && auth()->user()->type == 'admin')
                        <li>
                            <a href="{{ route('login.logs') }}" data-toggle="tooltip" title="Logs"><i
                                    class="mdi mdi-file-document-outline"></i></a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('profile') }}" data-toggle="tooltip" title="Profile settings"><i
                                class="mdi mdi-settings"></i></a>
                    </li>

                </ul>
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

                <p style="color: #0e84cc"><b>Balance: </b></p>

                <!-- notificacoes -->
                <li class="custom-dropdown">
                    <button class="notify-toggler custom-dropdown-toggler">
                        @if (auth()->user()->type == 'admin')
                            <a href="{{ route('user.all') }}">
                                <i class="mdi mdi-bell-outline icon"></i>
                                @if (auth()->user()->type == 'admin')
                                    <span class="badge badge-xs rounded-circle">{{ $messagesCountAll }}</span>
                                @elseif (auth()->user()->type == 'worker' && !empty($message->response))
                                    <span class="badge badge-xs rounded-circle">{{ $messagesCount }}</span>
                                @else
                                    <span class="badge badge-xs rounded-circle"></span>
                                @endif
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}">

                                <i class="mdi mdi-bell-outline icon"></i>
                                @if (auth()->user()->type == 'admin')
                                    <span class="badge badge-xs rounded-circle">{{ $messagesCountAll }}</span>
                                @elseif (auth()->user()->type == 'worker' && !empty($message->response))
                                    <span class="badge badge-xs rounded-circle">{{ $messagesCount }}</span>
                                @else
                                    <span class="badge badge-xs rounded-circle"></span>
                                @endif
                            </a>
                        @endif
                    </button>
                </li>
                <!-- end notificacoes -->

                <!-- User Account -->
                <ul class="nav navbar-nav">
                    <li class="dropdown user-menu">
                        <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                            @if (Auth::user()->profile_image)
                                <img class="user-image rounded-circle"
                                    src="{{ asset('storage/profile_img/' . Auth::user()->profile_image) }}"
                                    width="150px" alt="User Image">
                            @else
                                <img class="user-image rounded-circle" src="{{ asset('/images/user/user.png') }}"
                                    width="150px" alt="Default User Image">
                            @endif
                            <span class="d-none d-lg-inline-block">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a class="dropdown-link-item" href="{{ route('profile') }}">
                                    <i class="mdi mdi-account-outline"></i>
                                    <span class="nav-text">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-link-item" href="{{ route('profile.settings') }}">
                                    <i class="mdi mdi-settings"></i>
                                    <span class="nav-text">Account Setting</span>
                                </a>
                            </li>

                            <li class="dropdown-footer">
                                @if (Auth::check())
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-link-item" href="{{ route('logout') }}"
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
