<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('page-title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        @include('partials.header')
        <main>
            {{-- SIDEBAR --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary">
                            <ul class="nav nav-pills flex-column mb-auto">

                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard') }}" class="nav-link active"
                                        aria-current="page">
                                        <svg class="bi pe-none me-2" width="16" height="16">
                                            <use xlink:href="#home"></use>
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.posts.index') }}" class="nav-link" aria-current="page">
                                        <svg class="bi pe-none me-2" width="16" height="16">
                                            <use xlink:href="#home"></use>
                                        </svg>
                                        Posts
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ route('admin.types.index') }}"
                                        class="nav-link @if (Route::currentRouteName() == 'admin.types.index') active @endif">
                                        <svg class="bi pe-none me-2" width="16" height="16">
                                            <use xlink:href="#home"></use>
                                        </svg>
                                        Types
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </div>

                    <div class="col-10">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
