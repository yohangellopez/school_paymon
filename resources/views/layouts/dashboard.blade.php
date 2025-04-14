<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Administrativo - @yield('title','Dashboard') </title>
    @vite('resources/css/app.css', 'resources/js/app.js')
    @include('components.script.style')
    @livewireStyles
</head>

<body class="min-h-screen flex flex-col">
    <div class="flex-1" id="app">
        {{-- navbar --}}
        <nav id="navbar-main" class="navbar is-fixed-top ">
            <div class="navbar-brand">
                <a class="navbar-item mobile-aside-button">
                    <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
                </a>
            </div>
            <div class="navbar-brand is-right">
                <a class="navbar-item --jb-navbar-menu-toggle" data-target="navbar-menu">
                    <span class="icon"><i class="mdi mdi-dots-vertical mdi-24px"></i></span>
                </a>
            </div>
            <div class="navbar-menu" id="navbar-menu">
                <div class="navbar-end">
                    <div class="navbar-item dropdown has-divider has-user-avatar">
                        <a class="navbar-link">
                            <div class="is-user-name">
                                <span>{{ Auth::user()->name }} </span></div>
                            <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
                        </a>
                        <div class="navbar-dropdown">
                            <a >
                                <span class="icon"><i class="mdi mdi-account"></i></span>
                                <span>Mi perfil</span>
                            </a>
                            <hr class="navbar-divider">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="navbar-item w-full">
                                    <span class="icon"><i class="mdi mdi-logout"></i></span>
                                    <span>Salir</span>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </nav>

        {{-- aside --}}
        <aside class="aside is-placed-left is-expanded">
            <div class="aside-tools">
                <div>
                    Dashboard
                </div>
            </div>
            <div class="menu is-menu-main">
                <p class="menu-label">General</p>
                <ul class="menu-list">
                    <li class="">
                        <a >
                            <span class="icon"><i class="mdi mdi-chart-bar"></i></span>
                            <span class="menu-item-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="">
                        <a class="dropdown">
                            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
                            <span class="menu-item-label">Usuarios</span>
                            <span class="icon"><i class="mdi mdi-plus"></i></span>
                        </a>
                        <ul>
                            <li class="">
                                <a href="{{ route('admin.user.index') }}">
                                    <span>Administradores</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <p class="menu-label">Académico</p>
                <ul class="menu-list">
                    <li class="">
                        <a href="{{ route('admin.representative.index') }}">
                            <span class="icon"><i class="mdi mdi-account-child"></i></span>
                            <span class="menu-item-label">Representantes</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.student.index') }}">
                            <span class="icon"><i class="mdi mdi-school"></i></span>
                            <span class="menu-item-label">Estudiantes</span>
                        </a>
                    </li>
                    <li class="">
                        <a href="{{ route('admin.academy.index') }}">
                            <span class="icon"><i class="mdi mdi-calendar"></i></span>
                            <span class="menu-item-label">Academias</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.enrollment.index') }}">
                            <span class="icon"><i class="mdi mdi-numeric"></i></span>
                            <span class="menu-item-label">Matriculas</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.communication.index') }}">
                            <span class="icon"><i class="mdi mdi-teach"></i></span>
                            <span class="menu-item-label">Comunicados</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <section class="is-hero-bar">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
                <h2 class="title w-full">
                    {{ $header }}
                </h2>
            </div>
        </section>

        <section class="section main-section">
            {{ $slot }}
        </section>
    </div>
    <footer class="footer ">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
            <div class="flex items-center justify-start space-x-3">
                <div>
                    © 2024 Area de Usuarios V1.0
                </div>
                <div>
                    <p>Realizado por: Yohangel López para Paymon<a>
                </div>
                
            </div>
        </div>
    </footer>
    @extends('components.script.script')
    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
