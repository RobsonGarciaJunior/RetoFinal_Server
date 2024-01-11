<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ trans('app.admin_panel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="bg-light">
    <!-- Navbar -->
    <header class="navbar navbar-expand-md navbar-light shadow-sm">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ url('admin/home') }}">
            <img id="logo" src="{{ asset('img/EEM-logo-color.svg') }}" class="img-fluid" alt="Logo">
        </a>
        <ul class="navbar-nav flex-row d-md-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </li>
        </ul>
        <!-- Sidebar con la navegación -->
        <div id="navbarSearch" class="navbar-search w-100 collapse">
            <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search"
                aria-label="Search">
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary full-height">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">{{ trans('app.admin_panel') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a id="link_admin" class="nav-link d-flex align-items-center gap-2 {{ Request::is('admin/degrees*') ? 'active' : '' }}"
                                    aria-current="page" href="{{ route('admin.degrees.index') }}">
                                    <span class="material-symbols-outlined">
                                        school
                                    </span>
                                    {{ trans('app.degrees') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="link_admin" class="nav-link d-flex align-items-center gap-2 {{ Request::is('admin/departments*') ? 'active' : '' }}"
                                    href="{{ route('admin.departments.index') }}">
                                    <span class="material-symbols-outlined">
                                        work
                                    </span>
                                    {{ trans('app.departments') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="link_admin" class="nav-link d-flex align-items-center gap-2 {{ Request::is('admin/modules*') ? 'active' : '' }}"
                                    href="{{ route('admin.modules.index') }}">
                                    <span class="material-symbols-outlined">
                                        collections_bookmark
                                    </span>
                                    {{ trans('app.modules') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="link_admin" class="nav-link d-flex align-items-center gap-2 {{ Request::is('admin/roles*') ? 'active' : '' }}"
                                    href="{{ route('admin.roles.index') }}">
                                    <span class="material-symbols-outlined">
                                        theater_comedy
                                    </span>
                                    {{ trans('app.roles') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="link_admin" class="nav-link d-flex align-items-center gap-2 {{ Request::is('admin/users*') ? 'active' : '' }}"
                                    href="{{ route('admin.users.index') }}">
                                    <i class="bi bi-people-fill"></i>
                                    {{ trans('app.users') }}
                                </a>
                            </li>
                        </ul>

                        <hr class="my-3">

                        <ul class="nav flex-column mb-auto">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" id="languageDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-translate"></i>
                                    {{ trans('app.language') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-bottom" aria-labelledby="languageDropdown">
                                    <li><a class="dropdown-item" href="{{ route('language', 'es') }}">
                                            {{ trans('app.spanish') }}</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('language', 'en') }}">
                                            {{ trans('app.english') }}</a></li>
                                </ul>
                            </div>
                            <li class="nav-item">
                                <a id="link_admin" class="nav-link d-flex align-items-center gap-2"
                                    href={{ '/home' }}>
                                    <i class="bi bi-wrench-adjustable-circle"></i>
                                    {{ trans('app.user_panel') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="link_admin" class="nav-link d-flex align-items-center gap-2"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="bi bi-door-open-fill"></i>
                                    {{ trans('app.log_out') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>

</html>
