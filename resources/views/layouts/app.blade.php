<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#12233f">
    <title>@yield('title', 'SMKN 1 Wirausaha') | SMKN 1 Wirausaha</title>
    <link rel="stylesheet" href="{{ asset('css/school.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="brand" href="{{ route('home') }}" aria-label="SMKN 1 Wirausaha, beranda">
                <span class="brand-mark" aria-hidden="true">
                    <svg viewBox="0 0 40 40" fill="none">
                        <path d="M5 16.5 20 8l15 8.5v2H5v-2Z" fill="currentColor"/>
                        <path d="M8 20h4v11H8zm10 0h4v11h-4zm10 0h4v11h-4zM5 33h30v2H5z" fill="currentColor"/>
                    </svg>
                </span>
                <span class="brand-copy">
                    <strong>SMKN 1 Wirausaha</strong>
                    <small>Sistem Informasi Siswa</small>
                </span>
            </a>
            <nav class="main-nav" aria-label="Navigasi utama">
                <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                <a class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}" href="{{ route('siswa.index') }}">Data siswa</a>
            </nav>
            <div class="student-chip">
                <span class="chip-dot"></span>
                <span>NIM <strong>2457401026</strong></span>
            </div>
        </div>
    </header>

    <main class="page-shell">
        @yield('content')
    </main>

    <footer class="site-footer">
        <span>SMKN 1 Wirausaha</span>
        <span>Belajar, berkarya, dan tumbuh bersama.</span>
    </footer>
</body>
</html>
