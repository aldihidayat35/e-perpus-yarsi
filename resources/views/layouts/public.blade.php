<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <base href="{{ url('/') }}/"/>
    <title>@yield('title', 'Katalog') - {{ app_setting('app_name', config('app.name')) }}</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" href="{{ app_setting('favicon') ? asset('storage/' . app_setting('favicon')) : asset('assets/media/logos/favicon.ico') }}"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"/>
    @stack('vendor-css')
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css"/>
    <style>
        .public-hero {
            background: linear-gradient(135deg, #1e3a5f 0%, #2563eb 100%);
            min-height: 200px;
        }
        .book-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #f1f1f4;
        }
        .book-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.08);
        }
        .book-cover {
            height: 220px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .book-cover-placeholder {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f5f8fa;
            border-radius: 8px 8px 0 0;
        }
    </style>
    @stack('custom-css')
</head>
<body id="kt_body" class="bg-body">
    <!--begin::Navbar-->
    <div class="bg-white shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between py-4">
                <div class="d-flex align-items-center">
                    <a href="{{ route('catalog.index') }}" class="text-gray-900 text-hover-primary fs-3 fw-bold text-decoration-none">
                        @if(app_setting('app_logo'))
                            <img alt="Logo" src="{{ asset('storage/' . app_setting('app_logo')) }}" class="h-30px me-3"/>
                        @endif
                        {{ app_setting('app_name', config('app.name')) }}
                    </a>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('catalog.index') }}" class="btn btn-sm btn-light-primary {{ request()->routeIs('catalog.index') ? 'active' : '' }}">
                        <i class="ki-duotone ki-book fs-4"><span class="path1"></span><span class="path2"></span></i> Katalog
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-sm btn-light">
                        <i class="ki-duotone ki-entrance-right fs-4"><span class="path1"></span><span class="path2"></span></i> Admin
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!--end::Navbar-->

    @yield('hero')

    <!--begin::Content-->
    <div class="container py-10">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-5" role="alert">
                <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                <div>{{ session('success') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-5" role="alert">
                <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    <div class="bg-gray-200 py-8 mt-10">
        <div class="container">
            <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                <div class="text-gray-600 order-2 order-md-1">
                    <span class="text-muted fw-semibold me-1">{{ date('Y') }} &copy;</span>
                    <a href="{{ url('/') }}" class="text-gray-800 text-hover-primary">{{ app_setting('app_name', config('app.name')) }}</a>
                    <span class="text-muted ms-1">— Perpustakaan Digital</span>
                </div>
                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1 mb-3 mb-md-0">
                    <li class="menu-item">
                        <span class="menu-link px-2 text-muted">{{ app_setting('app_version', 'v1.0.0') }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--end::Footer-->

    <script>var hostUrl = "assets/";</script>
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    @stack('vendor-js')
    @stack('custom-js')
</body>
</html>
