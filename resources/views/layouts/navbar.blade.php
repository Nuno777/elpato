{{-- <aside class="left-sidebar sidebar-dark" id="left-sidebar">
    <div class="sidebar sidebar-with-footer">
        <!-- App Brand -->
        <div class="app-brand">
            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('/images/icon.png') }}" alt="Mono" style="height: 100%;">
                {{-- <img src="{{ asset('/images/PainelIMG.png') }}" alt="Mono" style="margin-left:20px; height: 50%;">
                <h4>EL Panel</h4>
            </a>
        </div>

        <!-- Sidebar Content -->
        <div class="sidebar-left" data-simplebar style="height: 100%;">
            <!-- Sidebar Menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard Link -->
                <li class="@if (Request::is('panel')) active @endif">
                    <a class="sidenav-item-link" href="{{ route('dashboard') }}">
                        <i class="mdi mdi-monitor"></i>
                        <span class="nav-text">Panel</span>
                    </a>
                </li>

                <!-- Admin Functions (if user is admin) Admin Functions-->
                @if (auth()->check() && auth()->user()->type == 'admin')
                    <li class="has-sub @if (Request::is('panel/control-panel') || Request::is('panel/control-panel/create-user') || Request::is('panel/control-panel/all-users') || Request::is('panel/control-panel/all-orders') || Request::is('panel/control-panel/all-ftid')) active show @endif">
                        <a class="sidenav-item-link" data-toggle="collapse" data-target="#adminpanel"
                            href="{{ route('adminpainel') }}" aria-expanded="false" aria-controls="adminpanel">
                            <i class="mdi mdi-monitor-dashboard"></i>
                            <span class="nav-text">Control Panel</span>
                            <b class="caret"></b>
                        </a>

                        <ul class="collapse @if (Request::is('panel/control-panel') || Request::is('panel/control-panel/create-user') || Request::is('panel/control-panel/all-users') || Request::is('panel/control-panel/all-orders') || Request::is('panel/control-panel/all-ftid')) show @endif" id="adminpanel"
                            data-parent="#sidebar-menu">
                            <div class="sub-menu">
                                <li class="@if (Request::is('panel/control-panel')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('adminpainel') }}">
                                        <span class="nav-text">Control Panel</span>
                                    </a>
                                </li>

                                <li class="@if (Request::is('panel/control-panel/all-users')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('user.all') }}">
                                        <span class="nav-text">All Users</span>
                                    </a>
                                </li>

                                <li class="@if (Request::is('panel/control-panel/all-orders')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('orders.all') }}">
                                        <span class="nav-text">All Orders</span>
                                    </a>
                                </li>

                                <li class="@if (Request::is('panel/control-panel/all-ftid')) active @endif">
                                    <a class="sidenav-item-link" href="{{ route('ftid.all') }}">
                                        <span class="nav-text">All FTIDs</span>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </li>
                @endif


                <!-- Drops and Orders (for authorized users) -->
                @if (auth()->check() && (auth()->user()->type == 'admin' || auth()->user()->type == 'general' || auth()->user()->type == 'worker'))
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
                            <li>
                                <a class="dropdown-link-item" href="#">
                                    <i class="mdi mdi-theme-light-dark"></i>
                                    <span class="nav-text">Dark Mode</span>
                                    <label class="switch switch-text switch-success switch-pill form-control-label">
                                        <input id="darkModeSwitch" type="checkbox" class="switch-input form-check-input">
                                        <span class="switch-label" data-on="On" data-off="Off"></span>
                                        <span class="switch-handle"></span>
                                    </label>
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
 --}}

<!-- ===== Sidebar Start ===== -->
<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="flex items-center gap-2 pt-8 sidebar-header pb-7">
        <a href="index.html">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <img class="dark:hidden" src="{{ asset('/images/icon.png') }}" width="65px" alt="Logo" />
                <img class="hidden dark:block" src="{{ asset('/images/icon.png') }}" width="65px" alt="Logo" />
            </span>

            <img class="logo-icon" :class="sidebarToggle ? 'lg:block' : 'hidden'" src="{{ asset('/images/icon.png') }}"
                alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="flex flex-col overflow-y-auto duration-300 ease-linear no-scrollbar">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        MENU
                    </span>

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">
                    <!-- Menu Item Dashboard -->
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                            class="menu-item group"
                            :class="(selected === 'Dashboard') || (page === 'ecommerce' || page === 'analytics' ||
                                page === 'marketing' || page === 'crm' || page === 'stocks') ?
                            'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Dashboard') || (page === 'ecommerce' || page === 'analytics' ||
                                page === 'marketing' || page === 'crm' || page === 'stocks') ?
                            'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V8.99998C3.25 10.2426 4.25736 11.25 5.5 11.25H9C10.2426 11.25 11.25 10.2426 11.25 8.99998V5.5C11.25 4.25736 10.2426 3.25 9 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H9C9.41421 4.75 9.75 5.08579 9.75 5.5V8.99998C9.75 9.41419 9.41421 9.74998 9 9.74998H5.5C5.08579 9.74998 4.75 9.41419 4.75 8.99998V5.5ZM5.5 12.75C4.25736 12.75 3.25 13.7574 3.25 15V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H9C10.2426 20.75 11.25 19.7427 11.25 18.5V15C11.25 13.7574 10.2426 12.75 9 12.75H5.5ZM4.75 15C4.75 14.5858 5.08579 14.25 5.5 14.25H9C9.41421 14.25 9.75 14.5858 9.75 15V18.5C9.75 18.9142 9.41421 19.25 9 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V15ZM12.75 5.5C12.75 4.25736 13.7574 3.25 15 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V8.99998C20.75 10.2426 19.7426 11.25 18.5 11.25H15C13.7574 11.25 12.75 10.2426 12.75 8.99998V5.5ZM15 4.75C14.5858 4.75 14.25 5.08579 14.25 5.5V8.99998C14.25 9.41419 14.5858 9.74998 15 9.74998H18.5C18.9142 9.74998 19.25 9.41419 19.25 8.99998V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H15ZM15 12.75C13.7574 12.75 12.75 13.7574 12.75 15V18.5C12.75 19.7426 13.7574 20.75 15 20.75H18.5C19.7426 20.75 20.75 19.7427 20.75 18.5V15C20.75 13.7574 19.7426 12.75 18.5 12.75H15ZM14.25 15C14.25 14.5858 14.5858 14.25 15 14.25H18.5C18.9142 14.25 19.25 14.5858 19.25 15V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15C14.5858 19.25 14.25 18.9142 14.25 18.5V15Z"
                                    fill />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Dashboard
                            </span>

                            <svg class="menu-item-arrow"
                                :class="[(selected === 'Dashboard') ? 'menu-item-arrow-active' :
                                    'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                                ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Dashboard') ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="index.html" class="menu-dropdown-item group"
                                        :class="page === 'ecommerce' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        eCommerce
                                    </a>
                                </li>
                                <li>
                                    <a href="analytics.html" class="menu-dropdown-item group"
                                        :class="page === 'analytics' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        Analytics
                                        <span class="absolute flex items-center gap-1 right-3">
                                            <span class="menu-dropdown-badge"
                                                :class="page === 'analytics' ? 'menu-dropdown-badge-active' :
                                                    'menu-dropdown-badge-inactive'">
                                                Pro
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="menu-dropdown-item group" href="marketing.html"
                                        :class="page === 'marketing' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        Marketing
                                        <span class="absolute flex items-center gap-1 right-3">
                                            <span class="menu-dropdown-badge"
                                                :class="page === 'marketing' ? 'menu-dropdown-badge-active' :
                                                    'menu-dropdown-badge-inactive'">
                                                Pro
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="crm.html" class="menu-dropdown-item group"
                                        :class="page === 'crm' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        CRM
                                        <span class="absolute flex items-center gap-1 right-3">
                                            <span class="menu-dropdown-badge"
                                                :class="page === 'crm' ? 'menu-dropdown-badge-active' :
                                                    'menu-dropdown-badge-inactive'">
                                                Pro
                                            </span>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="stocks.html" class="menu-dropdown-item group"
                                        :class="page === 'stocks' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        Stocks
                                        <span class="absolute flex items-center gap-1 right-3">
                                            <span class="menu-dropdown-badge"
                                                :class="page === 'stocks' ? 'menu-dropdown-badge-active' :
                                                    'menu-dropdown-badge-inactive'">
                                                New
                                            </span>
                                            <span class="menu-dropdown-badge"
                                                :class="page === 'stocks' ? 'menu-dropdown-badge-active' :
                                                    'menu-dropdown-badge-inactive'">
                                                Pro
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>

                    <!-- Menu Item Dashboard -->

                    <!-- Menu Item Profile -->
                    <li>
                        <a href="profile.html" @click="selected = (selected === 'Profile' ? '':'Profile')"
                            class="menu-item group"
                            :class="(selected === 'Profile') && (page === 'profile') ? 'menu-item-active' :
                            'menu-item-inactive'">
                            <svg :class="(selected === 'Profile') && (page === 'profile') ? 'menu-item-icon-active' :
                            'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                    fill />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                User Profile
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Profile -->

                    <!-- Menu Item Forms -->
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Forms' ? '':'Forms')"
                            class="menu-item group"
                            :class="(selected === 'Forms') || (page === 'formElements' || page === 'formLayout' ||
                                page === 'proFormElements' || page === 'proFormLayout') ? 'menu-item-active' :
                            'menu-item-inactive'">
                            <svg :class="(selected === 'Forms') || (page === 'formElements' || page === 'formLayout' ||
                                page === 'proFormElements' || page === 'proFormLayout') ?
                            'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M5.5 3.25C4.25736 3.25 3.25 4.25736 3.25 5.5V18.5C3.25 19.7426 4.25736 20.75 5.5 20.75H18.5001C19.7427 20.75 20.7501 19.7426 20.7501 18.5V5.5C20.7501 4.25736 19.7427 3.25 18.5001 3.25H5.5ZM4.75 5.5C4.75 5.08579 5.08579 4.75 5.5 4.75H18.5001C18.9143 4.75 19.2501 5.08579 19.2501 5.5V18.5C19.2501 18.9142 18.9143 19.25 18.5001 19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5V5.5ZM6.25005 9.7143C6.25005 9.30008 6.58583 8.9643 7.00005 8.9643L17 8.96429C17.4143 8.96429 17.75 9.30008 17.75 9.71429C17.75 10.1285 17.4143 10.4643 17 10.4643L7.00005 10.4643C6.58583 10.4643 6.25005 10.1285 6.25005 9.7143ZM6.25005 14.2857C6.25005 13.8715 6.58583 13.5357 7.00005 13.5357H17C17.4143 13.5357 17.75 13.8715 17.75 14.2857C17.75 14.6999 17.4143 15.0357 17 15.0357H7.00005C6.58583 15.0357 6.25005 14.6999 6.25005 14.2857Z"
                                    fill />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Forms
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Forms') ? 'menu-item-arrow-active' :
                                    'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                                ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Forms') ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="form-elements.html" class="menu-dropdown-item group"
                                        :class="page === 'formElements' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        Form Elements
                                    </a>
                                </li>
                                <li>
                                    <a href="form-layout.html" class="menu-dropdown-item group"
                                        :class="page === 'formLayout' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        Form Layout
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                    <!-- Menu Item Forms -->

                    <!-- Menu Item Tables -->
                    <li>
                        <a href="#" @click.prevent="selected = (selected === 'Tables' ? '':'Tables')"
                            class="menu-item group"
                            :class="(selected === 'Tables') || (page === 'basicTables' || page === 'dataTables') ?
                            'menu-item-active' : 'menu-item-inactive'">
                            <svg :class="(selected === 'Tables') || (page === 'basicTables' || page === 'dataTables') ?
                            'menu-item-icon-active' : 'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M3.25 5.5C3.25 4.25736 4.25736 3.25 5.5 3.25H18.5C19.7426 3.25 20.75 4.25736 20.75 5.5V18.5C20.75 19.7426 19.7426 20.75 18.5 20.75H5.5C4.25736 20.75 3.25 19.7426 3.25 18.5V5.5ZM5.5 4.75C5.08579 4.75 4.75 5.08579 4.75 5.5V8.58325L19.25 8.58325V5.5C19.25 5.08579 18.9142 4.75 18.5 4.75H5.5ZM19.25 10.0833H15.416V13.9165H19.25V10.0833ZM13.916 10.0833L10.083 10.0833V13.9165L13.916 13.9165V10.0833ZM8.58301 10.0833H4.75V13.9165H8.58301V10.0833ZM4.75 18.5V15.4165H8.58301V19.25H5.5C5.08579 19.25 4.75 18.9142 4.75 18.5ZM10.083 19.25V15.4165L13.916 15.4165V19.25H10.083ZM15.416 19.25V15.4165H19.25V18.5C19.25 18.9142 18.9142 19.25 18.5 19.25H15.416Z"
                                    fill />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Tables
                            </span>

                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current"
                                :class="[(selected === 'Tables') ? 'menu-item-arrow-active' :
                                    'menu-item-arrow-inactive', sidebarToggle ? 'lg:hidden' : ''
                                ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown Menu Start -->
                        <div class="overflow-hidden transform translate"
                            :class="(selected === 'Tables') ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="flex flex-col gap-1 mt-2 menu-dropdown pl-9">
                                <li>
                                    <a href="basic-tables.html" class="menu-dropdown-item group"
                                        :class="page === 'basicTables' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        Basic Tables
                                    </a>
                                </li>
                                <li>
                                    <a href="data-tables.html" class="menu-dropdown-item group"
                                        :class="page === 'dataTables' ? 'menu-dropdown-item-active' :
                                            'menu-dropdown-item-inactive'">
                                        Data Tables
                                        <span class="absolute flex items-center gap-1 right-3">
                                            <span class="menu-dropdown-badge"
                                                :class="page === 'dataTables' ? 'menu-dropdown-badge-active' :
                                                    'menu-dropdown-badge-inactive'">
                                                Pro
                                            </span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- Dropdown Menu End -->
                    </li>
                    <!-- Menu Item Tables -->

                </ul>
            </div>

            <!-- Support Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase leading-[20px] text-gray-400">
                    <span class="menu-group-title" :class="sidebarToggle ? 'lg:hidden' : ''">
                        Support
                    </span>

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="mx-auto fill-current menu-group-icon" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill />
                    </svg>
                </h3>

                <ul class="flex flex-col gap-4 mb-6">
                    <!-- Menu Item Chat -->
                    <li>
                        <a href="chat.html" @click="selected = (selected === 'Chat' ? '':'Chat')"
                            class="menu-item group"
                            :class="(selected === 'Chat') && (page === 'chat') ? 'menu-item-active' :
                            'menu-item-inactive'">
                            <svg :class="(selected === 'Chat') && (page === 'chat') ? 'menu-item-icon-active' :
                            'menu-item-icon-inactive'"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M4.00002 12.0957C4.00002 7.67742 7.58174 4.0957 12 4.0957C16.4183 4.0957 20 7.67742 20 12.0957C20 16.514 16.4183 20.0957 12 20.0957H5.06068L6.34317 18.8132C6.48382 18.6726 6.56284 18.4818 6.56284 18.2829C6.56284 18.084 6.48382 17.8932 6.34317 17.7526C4.89463 16.304 4.00002 14.305 4.00002 12.0957ZM12 2.5957C6.75332 2.5957 2.50002 6.849 2.50002 12.0957C2.50002 14.4488 3.35633 16.603 4.77303 18.262L2.71969 20.3154C2.50519 20.5299 2.44103 20.8525 2.55711 21.1327C2.6732 21.413 2.94668 21.5957 3.25002 21.5957H12C17.2467 21.5957 21.5 17.3424 21.5 12.0957C21.5 6.849 17.2467 2.5957 12 2.5957ZM7.62502 10.8467C6.93467 10.8467 6.37502 11.4063 6.37502 12.0967C6.37502 12.787 6.93467 13.3467 7.62502 13.3467H7.62512C8.31548 13.3467 8.87512 12.787 8.87512 12.0967C8.87512 11.4063 8.31548 10.8467 7.62512 10.8467H7.62502ZM10.75 12.0967C10.75 11.4063 11.3097 10.8467 12 10.8467H12.0001C12.6905 10.8467 13.2501 11.4063 13.2501 12.0967C13.2501 12.787 12.6905 13.3467 12.0001 13.3467H12C11.3097 13.3467 10.75 12.787 10.75 12.0967ZM16.375 10.8467C15.6847 10.8467 15.125 11.4063 15.125 12.0967C15.125 12.787 15.6847 13.3467 16.375 13.3467H16.3751C17.0655 13.3467 17.6251 12.787 17.6251 12.0967C17.6251 11.4063 17.0655 10.8467 16.3751 10.8467H16.375Z"
                                    fill />
                            </svg>

                            <span class="menu-item-text" :class="sidebarToggle ? 'lg:hidden' : ''">
                                Chat
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Chat -->
                </ul>
            </div>
        </nav>
        <!-- Sidebar Menu -->

        <!-- Promo Box -->
        <div :class="sidebarToggle ? 'lg:hidden' : ''"
            class="mx-auto mb-10 w-full max-w-60 rounded-2xl bg-gray-50 px-4 py-5 text-center dark:bg-white/[0.03]">
            <h3 class="mb-2 font-semibold text-gray-900 dark:text-white">
                TailAdmin Pro
            </h3>
            <p class="mb-4 text-gray-500 text-theme-sm dark:text-gray-400">
                Get All Dashboards and 300+ UI Elements
            </p>
            <a href="https://tailadmin.com/pricing" target="_blank" rel="nofollow"
                class="flex items-center justify-center p-3 font-medium text-white rounded-lg bg-brand-500 text-theme-sm hover:bg-brand-600">
                Upgrade Plan
            </a>
        </div>
        <!-- Promo Box -->
    </div>
</aside>

<!-- ===== Sidebar End ===== -->

<!-- ===== Content Area Start ===== -->
<div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
    <!-- Small Device Overlay Start -->
    <div :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fixed z-9 h-screen w-full bg-gray-900/50"></div>
    <!-- Small Device Overlay End -->

    <!-- ===== Header Start ===== -->
    <header x-data="{ menuToggle: false }"
        class="sticky top-0 z-99999 flex w-full border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-900 lg:border-b">
        <div class="flex flex-grow flex-col items-center justify-between lg:flex-row lg:px-6">
            <div
                class="flex w-full items-center justify-between gap-2 border-b border-gray-200 px-3 py-3 dark:border-gray-800 sm:gap-4 lg:justify-normal lg:border-b-0 lg:px-0 lg:py-4">
                <!-- Hamburger Toggle BTN -->
                <button
                    :class="sidebarToggle ? 'lg:bg-transparent dark:lg:bg-transparent bg-gray-100 dark:bg-gray-800' : ''"
                    class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg border-gray-200 text-gray-500 dark:border-gray-800 dark:text-gray-400 lg:h-11 lg:w-11 lg:border"
                    @click.stop="sidebarToggle = !sidebarToggle">
                    <svg class="hidden fill-current lg:block" width="16" height="12" viewBox="0 0 16 12"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0.583252 1C0.583252 0.585788 0.919038 0.25 1.33325 0.25H14.6666C15.0808 0.25 15.4166 0.585786 15.4166 1C15.4166 1.41421 15.0808 1.75 14.6666 1.75L1.33325 1.75C0.919038 1.75 0.583252 1.41422 0.583252 1ZM0.583252 11C0.583252 10.5858 0.919038 10.25 1.33325 10.25L14.6666 10.25C15.0808 10.25 15.4166 10.5858 15.4166 11C15.4166 11.4142 15.0808 11.75 14.6666 11.75L1.33325 11.75C0.919038 11.75 0.583252 11.4142 0.583252 11ZM1.33325 5.25C0.919038 5.25 0.583252 5.58579 0.583252 6C0.583252 6.41421 0.919038 6.75 1.33325 6.75L7.99992 6.75C8.41413 6.75 8.74992 6.41421 8.74992 6C8.74992 5.58579 8.41413 5.25 7.99992 5.25L1.33325 5.25Z"
                            fill />
                    </svg>

                    <svg :class="sidebarToggle ? 'hidden' : 'block lg:hidden'" class="fill-current lg:hidden"
                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M3.25 6C3.25 5.58579 3.58579 5.25 4 5.25L20 5.25C20.4142 5.25 20.75 5.58579 20.75 6C20.75 6.41421 20.4142 6.75 20 6.75L4 6.75C3.58579 6.75 3.25 6.41422 3.25 6ZM3.25 18C3.25 17.5858 3.58579 17.25 4 17.25L20 17.25C20.4142 17.25 20.75 17.5858 20.75 18C20.75 18.4142 20.4142 18.75 20 18.75L4 18.75C3.58579 18.75 3.25 18.4142 3.25 18ZM4 11.25C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75L12 12.75C12.4142 12.75 12.75 12.4142 12.75 12C12.75 11.5858 12.4142 11.25 12 11.25L4 11.25Z"
                            fill />
                    </svg>

                    <!-- cross icon -->
                    <svg :class="sidebarToggle ? 'block lg:hidden' : 'hidden'" class="fill-current" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z"
                            fill />
                    </svg>
                </button>
                <!-- Hamburger Toggle BTN -->

                <a href="index.html" class="lg:hidden">
                    <img class="dark:hidden" src="" alt="Logo" />
                    <img class="hidden dark:block" src="" alt="Logo" />
                </a>

                <!-- Application nav menu button -->
                <button
                    class="z-99999 flex h-10 w-10 items-center justify-center rounded-lg text-gray-700 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 lg:hidden"
                    :class="menuToggle ? 'bg-gray-100 dark:bg-gray-800' : ''" @click.stop="menuToggle = !menuToggle">
                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99902 10.4951C6.82745 10.4951 7.49902 11.1667 7.49902 11.9951V12.0051C7.49902 12.8335 6.82745 13.5051 5.99902 13.5051C5.1706 13.5051 4.49902 12.8335 4.49902 12.0051V11.9951C4.49902 11.1667 5.1706 10.4951 5.99902 10.4951ZM17.999 10.4951C18.8275 10.4951 19.499 11.1667 19.499 11.9951V12.0051C19.499 12.8335 18.8275 13.5051 17.999 13.5051C17.1706 13.5051 16.499 12.8335 16.499 12.0051V11.9951C16.499 11.1667 17.1706 10.4951 17.999 10.4951ZM13.499 11.9951C13.499 11.1667 12.8275 10.4951 11.999 10.4951C11.1706 10.4951 10.499 11.1667 10.499 11.9951V12.0051C10.499 12.8335 11.1706 13.5051 11.999 13.5051C12.8275 13.5051 13.499 12.8335 13.499 12.0051V11.9951Z"
                            fill />
                    </svg>
                </button>
                <!-- Application nav menu button -->
            </div>

            <div :class="menuToggle ? 'flex' : 'hidden'"
                class="w-full items-center justify-between gap-4 px-5 py-4 shadow-theme-md lg:flex lg:justify-end lg:px-0 lg:shadow-none">
                <div class="flex items-center gap-2 2xsm:gap-3">
                    <!-- Dark Mode Toggler -->
                    <button
                        class="hover:text-dark-900 relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                        @click.prevent="darkMode = !darkMode">
                        <svg class="hidden dark:block" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M9.99998 1.5415C10.4142 1.5415 10.75 1.87729 10.75 2.2915V3.5415C10.75 3.95572 10.4142 4.2915 9.99998 4.2915C9.58577 4.2915 9.24998 3.95572 9.24998 3.5415V2.2915C9.24998 1.87729 9.58577 1.5415 9.99998 1.5415ZM10.0009 6.79327C8.22978 6.79327 6.79402 8.22904 6.79402 10.0001C6.79402 11.7712 8.22978 13.207 10.0009 13.207C11.772 13.207 13.2078 11.7712 13.2078 10.0001C13.2078 8.22904 11.772 6.79327 10.0009 6.79327ZM5.29402 10.0001C5.29402 7.40061 7.40135 5.29327 10.0009 5.29327C12.6004 5.29327 14.7078 7.40061 14.7078 10.0001C14.7078 12.5997 12.6004 14.707 10.0009 14.707C7.40135 14.707 5.29402 12.5997 5.29402 10.0001ZM15.9813 5.08035C16.2742 4.78746 16.2742 4.31258 15.9813 4.01969C15.6884 3.7268 15.2135 3.7268 14.9207 4.01969L14.0368 4.90357C13.7439 5.19647 13.7439 5.67134 14.0368 5.96423C14.3297 6.25713 14.8045 6.25713 15.0974 5.96423L15.9813 5.08035ZM18.4577 10.0001C18.4577 10.4143 18.1219 10.7501 17.7077 10.7501H16.4577C16.0435 10.7501 15.7077 10.4143 15.7077 10.0001C15.7077 9.58592 16.0435 9.25013 16.4577 9.25013H17.7077C18.1219 9.25013 18.4577 9.58592 18.4577 10.0001ZM14.9207 15.9806C15.2135 16.2735 15.6884 16.2735 15.9813 15.9806C16.2742 15.6877 16.2742 15.2128 15.9813 14.9199L15.0974 14.036C14.8045 13.7431 14.3297 13.7431 14.0368 14.036C13.7439 14.3289 13.7439 14.8038 14.0368 15.0967L14.9207 15.9806ZM9.99998 15.7088C10.4142 15.7088 10.75 16.0445 10.75 16.4588V17.7088C10.75 18.123 10.4142 18.4588 9.99998 18.4588C9.58577 18.4588 9.24998 18.123 9.24998 17.7088V16.4588C9.24998 16.0445 9.58577 15.7088 9.99998 15.7088ZM5.96356 15.0972C6.25646 14.8043 6.25646 14.3295 5.96356 14.0366C5.67067 13.7437 5.1958 13.7437 4.9029 14.0366L4.01902 14.9204C3.72613 15.2133 3.72613 15.6882 4.01902 15.9811C4.31191 16.274 4.78679 16.274 5.07968 15.9811L5.96356 15.0972ZM4.29224 10.0001C4.29224 10.4143 3.95645 10.7501 3.54224 10.7501H2.29224C1.87802 10.7501 1.54224 10.4143 1.54224 10.0001C1.54224 9.58592 1.87802 9.25013 2.29224 9.25013H3.54224C3.95645 9.25013 4.29224 9.58592 4.29224 10.0001ZM4.9029 5.9637C5.1958 6.25659 5.67067 6.25659 5.96356 5.9637C6.25646 5.6708 6.25646 5.19593 5.96356 4.90303L5.07968 4.01915C4.78679 3.72626 4.31191 3.72626 4.01902 4.01915C3.72613 4.31204 3.72613 4.78692 4.01902 5.07981L4.9029 5.9637Z"
                                fill="currentColor" />
                        </svg>
                        <svg class="dark:hidden" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.4547 11.97L18.1799 12.1611C18.265 11.8383 18.1265 11.4982 17.8401 11.3266C17.5538 11.1551 17.1885 11.1934 16.944 11.4207L17.4547 11.97ZM8.0306 2.5459L8.57989 3.05657C8.80718 2.81209 8.84554 2.44682 8.67398 2.16046C8.50243 1.8741 8.16227 1.73559 7.83948 1.82066L8.0306 2.5459ZM12.9154 13.0035C9.64678 13.0035 6.99707 10.3538 6.99707 7.08524H5.49707C5.49707 11.1823 8.81835 14.5035 12.9154 14.5035V13.0035ZM16.944 11.4207C15.8869 12.4035 14.4721 13.0035 12.9154 13.0035V14.5035C14.8657 14.5035 16.6418 13.7499 17.9654 12.5193L16.944 11.4207ZM16.7295 11.7789C15.9437 14.7607 13.2277 16.9586 10.0003 16.9586V18.4586C13.9257 18.4586 17.2249 15.7853 18.1799 12.1611L16.7295 11.7789ZM10.0003 16.9586C6.15734 16.9586 3.04199 13.8433 3.04199 10.0003H1.54199C1.54199 14.6717 5.32892 18.4586 10.0003 18.4586V16.9586ZM3.04199 10.0003C3.04199 6.77289 5.23988 4.05695 8.22173 3.27114L7.83948 1.82066C4.21532 2.77574 1.54199 6.07486 1.54199 10.0003H3.04199ZM6.99707 7.08524C6.99707 5.52854 7.5971 4.11366 8.57989 3.05657L7.48132 2.03522C6.25073 3.35885 5.49707 5.13487 5.49707 7.08524H6.99707Z"
                                fill="currentColor" />
                        </svg>
                    </button>
                    <!-- Dark Mode Toggler -->

                    <!-- Notification Menu Area -->
                    <div class="relative" x-data="{ dropdownOpen: false, notifying: true }" @click.outside="dropdownOpen = false">
                        <button
                            class="hover:text-dark-900 relative flex h-11 w-11 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700 dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400 dark:hover:bg-gray-800 dark:hover:text-white"
                            @click.prevent="dropdownOpen = ! dropdownOpen; notifying = false">
                            <span :class="!notifying ? 'hidden' : 'flex'"
                                class="absolute right-0 top-0.5 z-1 h-2 w-2 rounded-full bg-orange-400">
                                <span
                                    class="absolute -z-1 inline-flex h-full w-full animate-ping rounded-full bg-orange-400 opacity-75"></span>
                            </span>
                            <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.75 2.29248C10.75 1.87827 10.4143 1.54248 10 1.54248C9.58583 1.54248 9.25004 1.87827 9.25004 2.29248V2.83613C6.08266 3.20733 3.62504 5.9004 3.62504 9.16748V14.4591H3.33337C2.91916 14.4591 2.58337 14.7949 2.58337 15.2091C2.58337 15.6234 2.91916 15.9591 3.33337 15.9591H4.37504H15.625H16.6667C17.0809 15.9591 17.4167 15.6234 17.4167 15.2091C17.4167 14.7949 17.0809 14.4591 16.6667 14.4591H16.375V9.16748C16.375 5.9004 13.9174 3.20733 10.75 2.83613V2.29248ZM14.875 14.4591V9.16748C14.875 6.47509 12.6924 4.29248 10 4.29248C7.30765 4.29248 5.12504 6.47509 5.12504 9.16748V14.4591H14.875ZM8.00004 17.7085C8.00004 18.1228 8.33583 18.4585 8.75004 18.4585H11.25C11.6643 18.4585 12 18.1228 12 17.7085C12 17.2943 11.6643 16.9585 11.25 16.9585H8.75004C8.33583 16.9585 8.00004 17.2943 8.00004 17.7085Z"
                                    fill />
                            </svg>
                        </button>

                        <!-- Dropdown Start -->
                        <div x-show="dropdownOpen"
                            class="absolute -right-[240px] mt-[17px] flex h-[480px] w-[350px] flex-col rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark sm:w-[361px] lg:right-0">
                            <div
                                class="mb-3 flex items-center justify-between border-b border-gray-100 pb-3 dark:border-gray-800">
                                <h5 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                                    Notification
                                </h5>

                                <button @click="dropdownOpen = false" class="text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.21967 7.28131C5.92678 6.98841 5.92678 6.51354 6.21967 6.22065C6.51256 5.92775 6.98744 5.92775 7.28033 6.22065L11.999 10.9393L16.7176 6.22078C17.0105 5.92789 17.4854 5.92788 17.7782 6.22078C18.0711 6.51367 18.0711 6.98855 17.7782 7.28144L13.0597 12L17.7782 16.7186C18.0711 17.0115 18.0711 17.4863 17.7782 17.7792C17.4854 18.0721 17.0105 18.0721 16.7176 17.7792L11.999 13.0607L7.28033 17.7794C6.98744 18.0722 6.51256 18.0722 6.21967 17.7794C5.92678 17.4865 5.92678 17.0116 6.21967 16.7187L10.9384 12L6.21967 7.28131Z"
                                            fill />
                                    </svg>
                                </button>
                            </div>

                            <ul class="custom-scrollbar flex h-auto flex-col overflow-y-auto">
                                <li>
                                    <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                                        href="#">
                                        <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                                            <img src="" alt="User"
                                                class="overflow-hidden rounded-full" />
                                            <span
                                                class="absolute bottom-0 right-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white bg-success-500 dark:border-gray-900"></span>
                                        </span>

                                        <span class="block">
                                            <span class="mb-1.5 block text-theme-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-medium text-gray-800 dark:text-white/90">Terry
                                                    Franci</span>
                                                requests permission to change
                                                <span class="font-medium text-gray-800 dark:text-white/90">Project
                                                    - Nganter App</span>
                                            </span>

                                            <span
                                                class="flex items-center gap-2 text-theme-xs text-gray-500 dark:text-gray-400">
                                                <span>Project</span>
                                                <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                                                <span>5 min ago</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                                        href="#">
                                        <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                                            <img src="" alt="User"
                                                class="overflow-hidden rounded-full" />
                                            <span
                                                class="absolute bottom-0 right-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white bg-success-500 dark:border-gray-900"></span>
                                        </span>

                                        <span class="block">
                                            <span class="mb-1.5 block text-theme-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-medium text-gray-800 dark:text-white/90">Alena
                                                    Franci</span>
                                                requests permission to change
                                                <span class="font-medium text-gray-800 dark:text-white/90">Project
                                                    - Nganter App</span>
                                            </span>

                                            <span
                                                class="flex items-center gap-2 text-theme-xs text-gray-500 dark:text-gray-400">
                                                <span>Project</span>
                                                <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                                                <span>8 min ago</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a class="flex gap-3 rounded-lg border-b border-gray-100 p-3 px-4.5 py-3 hover:bg-gray-100 dark:border-gray-800 dark:hover:bg-white/5"
                                        href="#">
                                        <span class="relative z-1 block h-10 w-full max-w-10 rounded-full">
                                            <img src="" alt="User"
                                                class="overflow-hidden rounded-full" />
                                            <span
                                                class="absolute bottom-0 right-0 z-10 h-2.5 w-full max-w-2.5 rounded-full border-[1.5px] border-white bg-success-500 dark:border-gray-900"></span>
                                        </span>

                                        <span class="block">
                                            <span class="mb-1.5 block text-theme-sm text-gray-500 dark:text-gray-400">
                                                <span class="font-medium text-gray-800 dark:text-white/90">Jocelyn
                                                    Kenter</span>
                                                requests permission to change
                                                <span class="font-medium text-gray-800 dark:text-white/90">Project
                                                    - Nganter App</span>
                                            </span>

                                            <span
                                                class="flex items-center gap-2 text-theme-xs text-gray-500 dark:text-gray-400">
                                                <span>Project</span>
                                                <span class="h-1 w-1 rounded-full bg-gray-400"></span>
                                                <span>15 min ago</span>
                                            </span>
                                        </span>
                                    </a>
                                </li>

                            </ul>

                            <a href="#"
                                class="mt-3 flex justify-center rounded-lg border border-gray-300 bg-white p-3 text-theme-sm font-medium text-gray-700 shadow-theme-xs hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                                View All Notification
                            </a>
                        </div>
                        <!-- Dropdown End -->
                    </div>
                    <!-- Notification Menu Area -->
                </div>

                <!-- User Area -->
                <div class="relative" x-data="{ dropdownOpen: false }" @click.outside="dropdownOpen = false">
                    <a class="flex items-center text-gray-700 dark:text-gray-400" href="#"
                        @click.prevent="dropdownOpen = ! dropdownOpen">
                        <span class="mr-3 h-11 w-11 overflow-hidden rounded-full">
                            <img src="" alt="User" />
                        </span>

                        <span class="mr-1 block text-theme-sm font-medium">
                            Emirhan Boruch
                        </span>

                        <svg :class="dropdownOpen && 'rotate-180'" class="stroke-gray-500 dark:stroke-gray-400"
                            width="18" height="20" viewBox="0 0 18 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.3125 8.65625L9 13.3437L13.6875 8.65625" stroke stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                    <!-- Dropdown Start -->
                    <div x-show="dropdownOpen"
                        class="absolute right-0 mt-[17px] flex w-[260px] flex-col rounded-2xl border border-gray-200 bg-white p-3 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark">
                        <div>
                            <span class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                Emirhan Boruch
                            </span>
                            <span class="mt-0.5 block text-theme-xs text-gray-500 dark:text-gray-400">
                                <p class="__cf_email__">examp***@gm**.com</p>
                            </span>
                        </div>

                        <ul class="flex flex-col gap-1 border-b border-gray-200 pb-3 pt-4 dark:border-gray-800">
                            <li>
                                <a href="profile.html"
                                    class="group flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                    <svg class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M12 3.5C7.30558 3.5 3.5 7.30558 3.5 12C3.5 14.1526 4.3002 16.1184 5.61936 17.616C6.17279 15.3096 8.24852 13.5955 10.7246 13.5955H13.2746C15.7509 13.5955 17.8268 15.31 18.38 17.6167C19.6996 16.119 20.5 14.153 20.5 12C20.5 7.30558 16.6944 3.5 12 3.5ZM17.0246 18.8566V18.8455C17.0246 16.7744 15.3457 15.0955 13.2746 15.0955H10.7246C8.65354 15.0955 6.97461 16.7744 6.97461 18.8455V18.856C8.38223 19.8895 10.1198 20.5 12 20.5C13.8798 20.5 15.6171 19.8898 17.0246 18.8566ZM2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM11.9991 7.25C10.8847 7.25 9.98126 8.15342 9.98126 9.26784C9.98126 10.3823 10.8847 11.2857 11.9991 11.2857C13.1135 11.2857 14.0169 10.3823 14.0169 9.26784C14.0169 8.15342 13.1135 7.25 11.9991 7.25ZM8.48126 9.26784C8.48126 7.32499 10.0563 5.75 11.9991 5.75C13.9419 5.75 15.5169 7.32499 15.5169 9.26784C15.5169 11.2107 13.9419 12.7857 11.9991 12.7857C10.0563 12.7857 8.48126 11.2107 8.48126 9.26784Z"
                                            fill />
                                    </svg>
                                    Edit profile
                                </a>
                            </li>
                            <li>
                                <a href="messages.html"
                                    class="group flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                    <svg class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.4858 3.5L13.5182 3.5C13.9233 3.5 14.2518 3.82851 14.2518 4.23377C14.2518 5.9529 16.1129 7.02795 17.602 6.1682C17.9528 5.96567 18.4014 6.08586 18.6039 6.43667L20.1203 9.0631C20.3229 9.41407 20.2027 9.86286 19.8517 10.0655C18.3625 10.9253 18.3625 13.0747 19.8517 13.9345C20.2026 14.1372 20.3229 14.5859 20.1203 14.9369L18.6039 17.5634C18.4013 17.9142 17.9528 18.0344 17.602 17.8318C16.1129 16.9721 14.2518 18.0471 14.2518 19.7663C14.2518 20.1715 13.9233 20.5 13.5182 20.5H10.4858C10.0804 20.5 9.75182 20.1714 9.75182 19.766C9.75182 18.0461 7.88983 16.9717 6.40067 17.8314C6.04945 18.0342 5.60037 17.9139 5.39767 17.5628L3.88167 14.937C3.67903 14.586 3.79928 14.1372 4.15026 13.9346C5.63949 13.0748 5.63946 10.9253 4.15025 10.0655C3.79926 9.86282 3.67901 9.41401 3.88165 9.06303L5.39764 6.43725C5.60034 6.08617 6.04943 5.96581 6.40065 6.16858C7.88982 7.02836 9.75182 5.9539 9.75182 4.23399C9.75182 3.82862 10.0804 3.5 10.4858 3.5ZM13.5182 2L10.4858 2C9.25201 2 8.25182 3.00019 8.25182 4.23399C8.25182 4.79884 7.64013 5.15215 7.15065 4.86955C6.08213 4.25263 4.71559 4.61859 4.0986 5.68725L2.58261 8.31303C1.96575 9.38146 2.33183 10.7477 3.40025 11.3645C3.88948 11.647 3.88947 12.3531 3.40026 12.6355C2.33184 13.2524 1.96578 14.6186 2.58263 15.687L4.09863 18.3128C4.71562 19.3814 6.08215 19.7474 7.15067 19.1305C7.64015 18.8479 8.25182 19.2012 8.25182 19.766C8.25182 20.9998 9.25201 22 10.4858 22H13.5182C14.7519 22 15.7518 20.9998 15.7518 19.7663C15.7518 19.2015 16.3632 18.8487 16.852 19.1309C17.9202 19.7476 19.2862 19.3816 19.9029 18.3134L21.4193 15.6869C22.0361 14.6185 21.6701 13.2523 20.6017 12.6355C20.1125 12.3531 20.1125 11.647 20.6017 11.3645C21.6701 10.7477 22.0362 9.38152 21.4193 8.3131L19.903 5.68667C19.2862 4.61842 17.9202 4.25241 16.852 4.86917C16.3632 5.15138 15.7518 4.79856 15.7518 4.23377C15.7518 3.00024 14.7519 2 13.5182 2ZM9.6659 11.9999C9.6659 10.7103 10.7113 9.66493 12.0009 9.66493C13.2905 9.66493 14.3359 10.7103 14.3359 11.9999C14.3359 13.2895 13.2905 14.3349 12.0009 14.3349C10.7113 14.3349 9.6659 13.2895 9.6659 11.9999ZM12.0009 8.16493C9.88289 8.16493 8.1659 9.88191 8.1659 11.9999C8.1659 14.1179 9.88289 15.8349 12.0009 15.8349C14.1189 15.8349 15.8359 14.1179 15.8359 11.9999C15.8359 9.88191 14.1189 8.16493 12.0009 8.16493Z"
                                            fill />
                                    </svg>
                                    Account settings
                                </a>
                            </li>
                            <li>
                                <a href="settings.html"
                                    class="group flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                    <svg class="fill-gray-500 group-hover:fill-gray-700 dark:fill-gray-400 dark:group-hover:fill-gray-300"
                                        width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M3.5 12C3.5 7.30558 7.30558 3.5 12 3.5C16.6944 3.5 20.5 7.30558 20.5 12C20.5 16.6944 16.6944 20.5 12 20.5C7.30558 20.5 3.5 16.6944 3.5 12ZM12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2ZM11.0991 7.52507C11.0991 8.02213 11.5021 8.42507 11.9991 8.42507H12.0001C12.4972 8.42507 12.9001 8.02213 12.9001 7.52507C12.9001 7.02802 12.4972 6.62507 12.0001 6.62507H11.9991C11.5021 6.62507 11.0991 7.02802 11.0991 7.52507ZM12.0001 17.3714C11.5859 17.3714 11.2501 17.0356 11.2501 16.6214V10.9449C11.2501 10.5307 11.5859 10.1949 12.0001 10.1949C12.4143 10.1949 12.7501 10.5307 12.7501 10.9449V16.6214C12.7501 17.0356 12.4143 17.3714 12.0001 17.3714Z"
                                            fill />
                                    </svg>
                                    Support
                                </a>
                            </li>
                        </ul>
                        <button
                            class="group mt-3 flex items-center gap-3 rounded-lg px-3 py-2 text-theme-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                            <svg class="fill-gray-500 group-hover:fill-gray-700 dark:group-hover:fill-gray-300"
                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M15.1007 19.247C14.6865 19.247 14.3507 18.9112 14.3507 18.497L14.3507 14.245H12.8507V18.497C12.8507 19.7396 13.8581 20.747 15.1007 20.747H18.5007C19.7434 20.747 20.7507 19.7396 20.7507 18.497L20.7507 5.49609C20.7507 4.25345 19.7433 3.24609 18.5007 3.24609H15.1007C13.8581 3.24609 12.8507 4.25345 12.8507 5.49609V9.74501L14.3507 9.74501V5.49609C14.3507 5.08188 14.6865 4.74609 15.1007 4.74609L18.5007 4.74609C18.9149 4.74609 19.2507 5.08188 19.2507 5.49609L19.2507 18.497C19.2507 18.9112 18.9149 19.247 18.5007 19.247H15.1007ZM3.25073 11.9984C3.25073 12.2144 3.34204 12.4091 3.48817 12.546L8.09483 17.1556C8.38763 17.4485 8.86251 17.4487 9.15549 17.1559C9.44848 16.8631 9.44863 16.3882 9.15583 16.0952L5.81116 12.7484L16.0007 12.7484C16.4149 12.7484 16.7507 12.4127 16.7507 11.9984C16.7507 11.5842 16.4149 11.2484 16.0007 11.2484L5.81528 11.2484L9.15585 7.90554C9.44864 7.61255 9.44847 7.13767 9.15547 6.84488C8.86248 6.55209 8.3876 6.55226 8.09481 6.84525L3.52309 11.4202C3.35673 11.5577 3.25073 11.7657 3.25073 11.9984Z"
                                    fill />
                            </svg>

                            Sign out
                        </button>
                    </div>
                    <!-- Dropdown End -->
                </div>
                <!-- User Area -->
            </div>
        </div>
    </header>
    <!-- ===== Header End ===== -->
