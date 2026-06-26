<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Login - SIPESA')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/logo.png') }}">

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

    @stack('styles')
</head>

<body>

    <main class="auth-wrapper">
        <div class="container-fluid p-0 h-100">
            <div class="row g-0 h-100 min-vh-100">

                <!-- Sisi Kiri: Banner Info (Hanya tampil di Desktop) -->
                <div class="col-lg-6 d-none d-lg-flex auth-left align-items-center justify-content-center p-5">
                    @include('components.auth.auth-header')
                </div>

                <!-- Sisi Kanan: Area Form Login -->
                <div class="col-lg-6 d-flex align-items-center justify-content-center p-4 p-md-5 bg-auth-right">
                    <div class="w-100" style="max-width: 440px;">

                        @yield('content')

                        @include('components.auth.auth-footer')
                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>

</html>
