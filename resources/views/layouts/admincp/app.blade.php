<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        body {
            background-color: #cacaca;
        }
    </style>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Admin
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main >
            @if (Auth::id())
                <div class="container">
                    @include('layouts.admincp.navbar')
                </div>
            @endif

            <!-- Toastr Notifications -->
            <script>
                // Hiển thị thông báo từ session
                @if(session('success'))
                    toastr.success('{{ session('success') }}');
                @endif

                @if(session('error'))
                    toastr.error('{{ session('error') }}');
                @endif

                @if(session('info'))
                    toastr.info('{{ session('info') }}');
                @endif

                @if(session('warning'))
                    toastr.warning('{{ session('warning') }}');
                @endif

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        toastr.error('{{ $error }}');
                    @endforeach
                @endif
            </script>

            @yield('content')
        </main>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- jQuery (required for Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toastr Configuration -->
    <script src="{{ asset('js/toastr-config.js') }}"></script>

    <!-- Initialize Toasts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show success toast if exists
            if (document.getElementById('successToast')) {
                var successToast = new bootstrap.Toast(document.getElementById('successToast'), {
                    autohide: true,
                    delay: 5000
                });
                successToast.show();
            }

            // Show error toast if exists
            if (document.getElementById('errorToast')) {
                var errorToast = new bootstrap.Toast(document.getElementById('errorToast'), {
                    autohide: true,
                    delay: 5000
                });
                errorToast.show();
            }

            // Show info toast if exists
            if (document.getElementById('infoToast')) {
                var infoToast = new bootstrap.Toast(document.getElementById('infoToast'), {
                    autohide: true,
                    delay: 5000
                });
                infoToast.show();
            }

            // Show warning toast if exists
            if (document.getElementById('warningToast')) {
                var warningToast = new bootstrap.Toast(document.getElementById('warningToast'), {
                    autohide: true,
                    delay: 5000
                });
                warningToast.show();
            }

            // Show errors toast if exists
            if (document.getElementById('errorsToast')) {
                var errorsToast = new bootstrap.Toast(document.getElementById('errorsToast'), {
                    autohide: true,
                    delay: 5000
                });
                errorsToast.show();
            }
        });
    </script>
</body>

</html>
