<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'SIPESA')</title>

    <meta name="description" content="SIPESA - Sistem Pelayanan Surat Desa Payudan-Dungdang">
    <meta name="author" content="Desa Payudan-Dungdang">

    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('assets/css/landing.css') }}">

    @stack('styles')
</head>

<body>

    {{-- Navbar --}}
    @include('components.landing.navbar')

    {{-- Content --}}
    <main class="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.landing.footer')

    {{-- Modal --}}
    @include('components.landing.modal-ajukan')
    @include('components.landing.modal-status')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/landing.js') }}"></script>

    @stack('scripts')

</body>

</html>
