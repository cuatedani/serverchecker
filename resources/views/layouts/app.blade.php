<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicons -->
    <link href="{{ asset('images/logo-32x32.png') }}" rel="icon">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!--iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--Toast-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .pulse {
            animation: pulse 1s infinite;
            }

            @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
            }
        </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-dark" aria-label="Dark navbar">
            <div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasNavbarDark" aria-controls="offcanvasNavbarDark"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <a href="{{ route('servers.show') }}" class="navbar-brand ml-auto">ServerChecker</a>

                <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasNavbarDark"
                    aria-labelledby="offcanvasNavbarDarkLabel">
                    <div class="offcanvas-header">
                        <div class="d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                                alt="Logo Server Checker" style="color: white" class="bi bi-pc me-2"
                                viewBox="0 0 16 16">
                                <path
                                    d="M5 0a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H5Zm.5 14a.5.5 0 1 1 0 1 .5.5 0 0 1 0-1Zm2 0a.5.5 0 1 1 0 1 .5.5 0 0 1 0-1ZM5 1.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5ZM5.5 3h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1Z" />
                            </svg>
                            <h5 class="offcanvas-title" id="offcanvasNavbarDarkLabel">ServerChecker</h5>
                        </div>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            @guest
                                <li class="nav-item">
                                    <a href="{{ route('inicio') }}"
                                        class="nav-link {{ request()->is('/') ? 'active' : 'text-white' }}"
                                        aria-current="page">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi pe-none me-2" viewBox="0 0 16 16">
                                            <path
                                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z">
                                            </path>
                                        </svg>
                                        Inicio
                                    </a>
                                </li>
                            @endguest

                            @auth
                                <li class="nav-item">
                                    <a href="{{ route('servers.show') }}"
                                        class="nav-link {{ request()->is('servers*') ? 'active' : 'text-white' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi pe-none me-2" viewBox="0 0 16 16">
                                            <path
                                                d="M4.5 11a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zM3 10.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z">
                                            </path>
                                            <path
                                                d="M16 11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V9.51c0-.418.105-.83.305-1.197l2.472-4.531A1.5 1.5 0 0 1 4.094 3h7.812a1.5 1.5 0 0 1 1.317.782l 2.472 4.53c.2.368.305.78.305 1.198V11zM3.655 4.26 1.592 8.043C1.724 8.014 1.86 8 2 8h12c.14 0 .276.014.408.042L12.345 4.26a.5.5 0 0 0-.439-.26H4.094a.5.5 0 0 0-.44.26zM1 10v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1z">
                                            </path>
                                        </svg>
                                        Servers
                                    </a>
                                </li>

                                {{-- @if (auth()->user()->role('admin'))
                                    <li>
                                        <a href="{{ route('users.show') }}" class="nav-link {{ request()->is('users*') ? 'active' : 'text-white' }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi pe-none me-2" viewBox="0 0 16 16">
                                                <path
                                                    d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0z">
                                                </path>
                                                <path
                                                    d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-5-4s-5 3-5 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z">
                                                </path>
                                            </svg>
                                            Usuarios
                                        </a>
                                    </li>
                                @endif --}}

                                <li>
                                    <a href="{{ route('profile.edit') }}"
                                        class="nav-link {{ request()->is('profile*') ? 'active' : 'text-white' }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi pe-none me-2" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
                                            <path
                                                d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z">
                                            </path>
                                        </svg>
                                        Perfil
                                    </a>
                                </li>
                            @endauth

                        </ul>
                        @auth
                            <hr>
                            <div class="dropdown">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="#" class="nav-link text-white"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi pe-none me-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z">
                                            </path>
                                            <path fill-rule="evenodd"
                                                d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z">
                                            </path>
                                        </svg>
                                        <strong>Cerrar Sesión</strong>
                                    </a>
                                </form>
                            </div>
                        @endauth
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                            <li>
                                <a class="nav-link px-2 text-white">
                                    &copy;Copyright
                                    2023<strong><span> ServerChecker</span></strong>. <br>Todos los Derechos
                                    Reservados
                                </a>
                            </li>
                            <li>
                                <a class="nav-link px-2 text-white">
                                    Diseñado por: Juan Gomez && Ramon Herrera
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="py-4" style="background: RGBA(128,128,128,0.3); min-height: 100vh;">
        @yield('content')
    </main>

    <!-- ServerChecker js Library -->
    <script type="module" src="{{ asset('js/showinfo.js') }}"></script>
    <script type="module" src="{{ asset('js/serverdelete.js') }}"></script>
    <script type="module" src="{{ asset('js/serveredit.js') }}"></script>
    <script type="module" src="{{ asset('js/serveradd.js') }}"></script>
    <script type="module" src="{{ asset('js/servercheckone.js') }}"></script>
    <script type="module" src="{{ asset('js/servercheckall.js') }}"></script>

    <!-- JQuery js Library -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Toast js Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- SweetAlert js Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
