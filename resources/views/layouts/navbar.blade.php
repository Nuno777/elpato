<aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div class="sidebar sidebar-with-footer">
        <!-- App Brand -->
        <div class="app-brand">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('/images/icon.png') }}" alt="Mono" style="height: 100%;">
                <img src="{{ asset('/images/PainelIMG.png') }}" alt="Mono" style="margin-left:20px; height: 50%;">

            </a>
        </div>

        <!-- Sidebar Content -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <!-- Sidebar Menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard Link -->
                <li class="@if (Request::is('main/panel')) active @endif">
                    <a class="sidenav-item-link" href="{{ route('dashboard') }}">
                        <i class="mdi mdi-monitor"></i>
                        <span class="nav-text">Main Panel</span>
                    </a>
                </li>

                <!-- Admin Functions (if user is admin) Admin Functions-->
                @if (auth()->check() && auth()->user()->type == 'admin')
                    <li class="has-sub @if (Request::is('panel-dashboard') ||
                            Request::is('create-user') ||
                            Request::is('all-users') ||
                            Request::is('all-orders') ||
                            Request::is('all-ftid') ||
                            Request::is('login-logs')) active show @endif">
                        <a class="sidenav-item-link" data-toggle="collapse" data-target="#adminpanel"
                            href="{{ route('adminpainel') }}" aria-expanded="false" aria-controls="adminpanel">
                            <i class="mdi mdi-monitor-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                            <b class="caret"></b>
                        </a>

                        <ul class="collapse @if (Request::is('panel-dashboard') ||
                                Request::is('create-user') ||
                                Request::is('all-users') ||
                                Request::is('all-orders') ||
                                Request::is('all-ftid') ||
                                Request::is('login-logs')) show @endif" id="adminpanel"
                            data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="@if (Request::is('panel-dashboard')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('adminpainel') }}">
                                        <span class="nav-text">Dashboard</span>
                                    </a>
                                </li>

                                <li class="@if (Request::is('all-users')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('user.all') }}">
                                        <span class="nav-text">All Users</span>
                                    </a>
                                </li>

                                <li class="@if (Request::is('all-orders')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('orders.all') }}">
                                        <span class="nav-text">All Orders</span>
                                    </a>
                                </li>

                                <li class="@if (Request::is('all-ftid')) active @endif">
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
                    <li class="@if (Request::is('panel/drops') || Request::is('panel/drops/filter')) active @endif">
                        <a class="sidenav-item-link" href="{{ route('drops') }}">
                            <i class="mdi mdi-truck"></i>
                            <span class="nav-text">Drops</span>
                        </a>
                    </li>

                    <li class="@if (Request::is('panel/orders')) active @endif">
                        <a class="sidenav-item-link" href="{{ route('orders') }}">
                            <i class="mdi mdi-package-variant-closed"></i>
                            <span class="nav-text">Orders</span>
                        </a>
                    </li>
                @endif

                <!-- FTID (for admin and general users) -->
                @if (auth()->check() && (auth()->user()->type == 'admin' || auth()->user()->type == 'general'))
                    <li class="@if (Request::is('main-panel/ftid') || Request::is('createftid')) active @endif">
                        <a class="sidenav-item-link" href="{{ route('ftid') }}">
                            <i class="mdi mdi-file-pdf"></i>
                            <span class="nav-text">FTID</span>
                        </a>
                    </li>
                @endif

                @if (auth()->check() && auth()->user()->type == 'admin')
                    <li class="@if (Request::is('orders-refund')) active @endif">
                        <a class="sidenav-item-link" href="{{ route('orders.ref') }}">
                            <i class="mdi mdi-package-variant"></i>
                            <span class="nav-text">Orders Refund</span>
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
                    @else
                        <li>
                            <a href="" data-toggle="tooltip" title="Analytics"><i
                                    class="mdi mdi-chart-line"></i></a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('profile') }}" data-toggle="tooltip" title="Profile settings"><i
                                class="mdi mdi-account-outline"></i></a>
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

                <!-- <p style="color: #0e84cc"><b>Balance: </b></p>-->

                <label class="switch switch-text switch-success switch-pill form-control-label">
                    <input id="darkModeSwitch" type="checkbox" class="switch-input form-check-input">
                    <span class="switch-label" data-on="On" data-off="Off"></span>
                    <span class="switch-handle"></span>
                </label>


                <ul class="nav navbar-nav">
                    <li class="custom-dropdown">
                        <button class="notify-toggler custom-dropdown-toggler">
                            @if (auth()->user()->type == 'admin')
                                <a>
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
                                <a>
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

                        <div class="dropdown-notify">

                            <header>
                                <div class="nav nav-underline" id="nav-tab" role="tablist">
                                    @if (auth()->user()->type == 'admin')
                                        <a class="nav-item nav-link active" id="all-tabs" data-toggle="tab"
                                            href="#all" role="tab" aria-controls="nav-home"
                                            aria-selected="true">All ({{ $messagesCountAll }})</a>
                                    @elseif (auth()->user()->type == 'worker' && !empty($message->response))
                                        <a class="nav-item nav-link active" id="all-tabs" data-toggle="tab"
                                            href="#all" role="tab" aria-controls="nav-home"
                                            aria-selected="true">All ({{ $messagesCount }})</a>
                                    @else
                                        <a class="nav-item nav-link active" id="all-tabs" data-toggle="tab"
                                            href="#all" role="tab" aria-controls="nav-home"
                                            aria-selected="true">All (0)</a>
                                    @endif
                                </div>
                            </header>

                            <div class="" data-simplebar style="height: 325px;">
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="all" role="tabpanel"
                                        aria-labelledby="all-tabs">
                                        @forelse($messages as $message)
                                            <div class="media media-sm p-4 mb-0">
                                                <div class="media-sm-wrapper bg-info-dark">
                                                    <a>
                                                        <i class="mdi mdi-message-text"></i>
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <a>
                                                        <span class="title mb-0">Message from
                                                            {{ $message->user->name }}</span>
                                                        <span class="discribe">{{ $message->message }}</span>
                                                    </a>
                                                    <div class="buttons">
                                                        @if ($message->response)
                                                            @if ($message->response == 'no')
                                                                <span
                                                                    class="badge badge-danger">{{ $message->response }}</span>
                                                            @elseif($message->response == 'yes')
                                                                <span
                                                                    class="badge badge-success">{{ $message->response }}</span>
                                                            @else
                                                                <span class="badge badge-info">new</span>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-light">new</span>
                                                        @endif
                                                    </div>

                                                    <span class="time">
                                                        <time>{{ $message->created_at->diffForHumans() }}</time>...
                                                    </span>

                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-center">No messages to display.</p>
                                        @endforelse
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- User Account -->
                    <li class="dropdown user-menu">
                        <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                            @if (Auth::user()->profile_image)
                                <img class="user-image rounded-circle"
                                    src="{{ asset('profile_images/' . Auth::user()->profile_image) }}" width="150px"
                                    alt="User Image">
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
                                    <span class="nav-text navtext-hover">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-link-item" href="{{ route('profile.settings') }}">
                                    <i class="mdi mdi-settings"></i>
                                    <span class="nav-text navtext-hover">Account Setting</span>
                                </a>
                            </li>

                            <li class="dropdown-footer">
                                @if (Auth::check())
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="dropdown-link-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                            <i class="mdi mdi-logout"></i>

                                            <span class="nav-text navtext-hover">Log out</span>
                                        </a>
                                    </form>
                                @endauth
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- end notificacoes -->
        </div>
    </nav>
</header>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const switchInput = document.getElementById("darkModeSwitch");
        const root = document.documentElement;

        // Sincronizar o estado do switch com a preferência salva
        const isDarkMode = localStorage.getItem("darkMode") === "true";
        switchInput.checked = isDarkMode;

        // Alterar tema ao clicar no switch
        switchInput.addEventListener("change", function() {
            if (switchInput.checked) {
                root.classList.add("dark-mode");
                localStorage.setItem("darkMode", "true");
            } else {
                root.classList.remove("dark-mode");
                localStorage.setItem("darkMode", "false");
            }
        });
    });
</script>
