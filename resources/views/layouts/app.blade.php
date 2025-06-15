<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MINews</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="navbar-brand ms-3" href="{{ url('/') }}">
                <strong>MINews</strong>
            </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
<ul class="navbar-nav me-auto mb-2 mb-lg-0">
    <li class="nav-item">
        <a class="nav-link{{ request()->is('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ request()->is('posts*') ? ' active' : '' }}" href="{{ route('posts.index') }}">Berita</a>
    </li>
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
        <li class="nav-item">
            <a class="nav-link{{ request()->is('categories*') ? ' active' : '' }}" href="{{ route('categories.index') }}">Kategori</a>
        </li>
        <li class="nav-item">
            <a class="nav-link{{ request()->is('comments*') ? ' active' : '' }}" href="{{ route('comments.index') }}">Komentar</a>
        </li>
    @endif
</ul>
<div class="flex-grow-1"></div>
<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
    <li class="nav-item dropdown">
        <a class="nav-link d-flex align-items-center" href="{{ route('profile.edit') }}">
            @if(Auth::user()->profile_photo)
                <img src="{{ asset('storage/'.Auth::user()->profile_photo) }}" alt="Avatar" class="rounded-circle" style="width:32px;height:32px;object-fit:cover;">
            @else
                <span class="rounded-circle bg-secondary text-white d-inline-flex justify-content-center align-items-center" style="width:32px;height:32px;font-size:1.1rem;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</span>
            @endif
        </a>
    </li>
</ul>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
@endauth

<ul class="navbar-nav me-auto"></ul>

                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto align-items-center">
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item d-flex align-items-center">
            <span class="me-2 fw-semibold">{{ Auth::user()->name }} <span class="badge bg-secondary text-lowercase">({{ Auth::user()->role }})</span></span>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link nav-link p-0" style="display:inline;">Logout</button>
            </form>
        </li>
    @endguest
</ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
