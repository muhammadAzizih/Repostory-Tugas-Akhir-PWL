<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'KELAR.IN') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            /* Emerald Premium Palette */
            --primary: #10b981;
            --primary-dark: #059669;
            --primary-light: #d1fae5;
            --bg-body: #f3f4f6;
            --bg-card: rgba(255, 255, 255, 0.9);
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Glassmorphism Utilities */
        .glass-card {
            background: var(--bg-card);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }

        /* Buttons */
        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border: none;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(16, 185, 129, 0.3);
            color: white;
        }

        /* Layout */
        .layout-wrapper {
            min-height: 100vh;
        }

        /* Sidebar Modern */
        .sidebar-wrapper {
            position: fixed;
            top: 72px;
            left: 0;
            width: 280px;
            height: calc(100vh - 72px);
            padding: 20px;
            transition: all 0.3s ease;
            z-index: 1040;
        }

        .sidebar {
            background: white;
            border-radius: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .sidebar::-webkit-scrollbar { width: 6px; }
        .sidebar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        .brand-section {
            padding: 25px 20px;
            border-bottom: 1px dashed var(--border-color);
        }

        .nav-link-modern {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            margin: 4px 12px;
            color: var(--text-muted);
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .nav-link-modern i { font-size: 1.1rem; transition: transform 0.2s; }
        .nav-link-modern:hover {
            color: var(--primary);
            background: var(--primary-light);
        }
        .nav-link-modern:hover i { transform: translateX(3px); }
        .nav-link-modern.active {
            background: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }
        .nav-link-modern.active i { color: white; }

        /* Main Content Area */
        .main-wrapper {
            margin-left: 280px;
            padding: 115px 30px 40px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Navbar Modern */
        .top-navbar {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(18px) saturate(1.4);
            -webkit-backdrop-filter: blur(18px) saturate(1.4);
            border-radius: 0;
            padding: 12px 30px;
            box-shadow: 0 1px 10px rgba(0,0,0,.05);
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 72px;
            z-index: 1050;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: box-shadow .3s, background .3s;
        }

        /* Footer */
        .footer-full {
            margin-left: 280px;
            transition: all 0.3s ease;
        }

        /* Collapse Sidebar */
        .layout-wrapper.sidebar-collapsed .sidebar-wrapper {
            transform: translateX(-100%);
        }
        .layout-wrapper.sidebar-collapsed .main-wrapper {
            margin-left: 0;
            width: 100%;
        }
        .layout-wrapper.sidebar-collapsed .footer-full {
            margin-left: 0;
        }

        /* Sidebar Backdrop */
        .sidebar-backdrop {
            display: none;
        }

        .avatar-img {
            border: 2px solid var(--primary-light);
            border-radius: 50%;
            object-fit: cover;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            .sidebar-wrapper { 
                transform: translateX(-100%); 
                transition: transform 0.3s; 
            }
            .sidebar-wrapper.show { transform: translateX(0); }
            .sidebar-backdrop {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.35);
                opacity: 0;
                pointer-events: none;
                transition: 0.3s;
                z-index: 1035;
            }
            .sidebar-wrapper.show + .sidebar-backdrop {
                opacity: 1;
                pointer-events: auto;
            }
            .main-wrapper { 
                margin-left: 0;
                width: 100%;
                padding: 95px 18px 30px;
            }
            .footer-full {
                margin-left: 0;
            }
            .top-navbar { top: 15px; }
            .top-navbar h5 {
                max-width: 160px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }

        .guest-wrapper {
            padding: 100px 24px 40px 24px !important;
        }
        @media (max-width: 991.98px) {
            .guest-wrapper {
                padding: 95px 16px 30px 16px !important;
            }
        }

        /* Animations */
        .fade-in-up {
            animation: fadeInUp 0.4s ease-out;
        }
        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: none; }
        }

        /* Footer Modern styles */
        .hover-primary:hover {
            color: var(--primary-dark) !important;
            transform: translateX(4px);
        }
        .hover-primary {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-block;
        }
        .footer-modern {
            background: linear-gradient(135deg, rgba(209, 250, 229, 0.4) 0%, rgba(255, 255, 255, 0.75) 100%);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.05);
        }
    </style>
</head>
<body>
    <div class="layout-wrapper">
        @auth
        <!-- Sidebar -->
        <div class="sidebar-wrapper "id="sidebar">
            <div class="sidebar">
                <div class="brand-section d-flex align-items-start justify-content-between gap-2">
                    <div>
                        <h4 class="fw-bolder mb-0 d-flex align-items-center gap-2" style="color: var(--primary);">
                        <i class="bi bi-layers-fill"></i> KELAR.IN
                    </h4>
                    <small class="text-muted fw-medium">Repository Universitas</small>
                    </div>
                </div>
                
                <div class="sidebar-content py-3 flex-grow-1">
                    <div class="px-4 mb-2 text-uppercase fw-bold text-muted" style="font-size: 0.7rem; letter-spacing: 1px;">Menu Utama</div>
                    
                    @if(auth()->user()->isMahasiswa())
                        <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link-modern {{ request()->routeIs('mahasiswa.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i> Dashboard</a>
                        <a href="{{ route('mahasiswa.sktl.create') }}" class="nav-link-modern {{ request()->routeIs('mahasiswa.sktl.*') ? 'active' : '' }}"><i class="bi bi-file-earmark-arrow-up"></i> Upload SKTL</a>
                        <a href="{{ route('mahasiswa.files.create') }}" class="nav-link-modern {{ request()->routeIs('mahasiswa.files.*') ? 'active' : '' }}"><i class="bi bi-folder-plus"></i> Upload {{ (auth()->user()->jurusan->jenjang ?? 'S1') === 'S3' ? 'Disertasi' : ((auth()->user()->jurusan->jenjang ?? 'S1') === 'S2' ? 'Tesis' : 'Skripsi') }}</a>
                        <a href="{{ route('mahasiswa.status') }}" class="nav-link-modern {{ request()->routeIs('mahasiswa.status') ? 'active' : '' }}"><i class="bi bi-activity"></i> Status Tracking</a>
                    @elseif(auth()->user()->isOperator())
                        <a href="{{ route('operator.dashboard') }}" class="nav-link-modern {{ request()->routeIs('operator.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i> Dashboard</a>
                        <a href="{{ route('operator.verifikasi.sktl') }}" class="nav-link-modern {{ request()->routeIs('operator.verifikasi.sktl') ? 'active' : '' }}"><i class="bi bi-check2-square"></i> Validasi SKTL</a>
                        <a href="{{ route('operator.verifikasi.files') }}" class="nav-link-modern {{ request()->routeIs('operator.verifikasi.files') ? 'active' : '' }}"><i class="bi bi-folder-check"></i> Validasi File</a>
                        <a href="{{ route('operator.students.index') }}" class="nav-link-modern {{ request()->routeIs('operator.students.*') ? 'active' : '' }}"><i class="bi bi-people"></i> Mahasiswa</a>
                        
                        <div class="px-4 mt-4 mb-2 text-uppercase fw-bold text-muted" style="font-size: 0.7rem; letter-spacing: 1px;">Informasi</div>
                        <a href="{{ route('operator.publikasi') }}" class="nav-link-modern {{ request()->routeIs('operator.publikasi') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i> Publikasi</a>
                        <a href="{{ route('operator.riwayat') }}" class="nav-link-modern {{ request()->routeIs('operator.riwayat') ? 'active' : '' }}"><i class="bi bi-clock-history"></i> Riwayat</a>
                    @elseif(auth()->user()->isKaprodi())
                        <a href="{{ route('kaprodi.dashboard') }}" class="nav-link-modern {{ request()->routeIs('kaprodi.dashboard') ? 'active' : '' }}"><i class="bi bi-grid-1x2"></i> Dashboard</a>
                        <a href="{{ route('kaprodi.persetujuan') }}" class="nav-link-modern {{ request()->routeIs('kaprodi.persetujuan') ? 'active' : '' }}"><i class="bi bi-award"></i> Persetujuan Akhir</a>
                        <a href="{{ route('kaprodi.analitik') }}" class="nav-link-modern {{ request()->routeIs('kaprodi.analitik') ? 'active' : '' }}"><i class="bi bi-pie-chart"></i> Analitik</a>
                    @endif
                    
                    <div class="px-4 mt-4 mb-2 text-uppercase fw-bold text-muted" style="font-size: 0.7rem; letter-spacing: 1px;">Lainnya</div>
                    <a href="{{ route('welcome') }}" class="nav-link-modern"><i class="bi bi-search"></i> Cari Dokumen</a>
                    <a href="{{ route('profile.edit') }}" class="nav-link-modern {{ request()->routeIs('profile.edit') ? 'active' : '' }}"><i class="bi bi-person-circle"></i> Profil Saya</a>
                    <a href="{{ route('logout') }}" class="nav-link-modern text-danger hover-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </div>
            </div>
        </div>
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>
        @endauth

            <!-- Top Navbar -->
            <nav class="top-navbar d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <button class="btn btn-light rounded-circle shadow-sm" type="button" id="sidebarToggle">
                            <i class="bi bi-list"></i>
                        </button>
                    @endauth
                    
                    @if(!auth()->check())
                        <a href="{{ route('welcome') }}" class="text-decoration-none d-flex align-items-center gap-2">
                            <i class="bi bi-layers-fill fs-3" style="color: var(--primary);"></i>
                            <h4 class="fw-bolder mb-0 text-dark">KELAR.IN</h4>
                        </a>
                    @else
                        <div>
                            <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h5>
                            <small class="text-muted d-none d-md-block">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</small>
                        </div>
                    @endif
                </div>

                <div class="d-flex align-items-center gap-3">
                    @guest
                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-primary-custom px-4">Masuk</a>
                        @endif
                    @else
                        <div class="dropdown">
                            <a class="text-decoration-none text-dark d-flex align-items-center gap-2 p-1 pe-3 rounded-pill" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background: rgba(0,0,0,0.03);">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=10b981&color=fff&rounded=true&bold=true" alt="Avatar" width="36" height="36" class="avatar-img shadow-sm">
                                <div class="d-none d-md-block">
                                    <div class="fw-bold" style="font-size: 0.9rem; line-height: 1;">{{ Auth::user()->name }}</div>
                                    <small class="text-muted" style="font-size: 0.75rem;">{{ Auth::user()->role->name }}</small>
                                </div>
                                <i class="bi bi-chevron-down ms-1 text-muted small"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2 rounded-4" style="min-width: 200px;">
                                <div class="px-3 py-2 d-md-none border-bottom mb-2">
                                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                                    <small class="text-muted">{{ Auth::user()->role->name }}</small>
                                </div>
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-muted"></i> Profil Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item py-2 text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Keluar Sistem
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </nav>

            <div class="main-wrapper {{ !auth()->check() ? 'ms-0 guest-wrapper' : '' }}">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            <main class="fade-in-up">
                @if(session('success'))
                    <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success d-flex align-items-center rounded-4 shadow-sm mb-4" role="alert">
                        <i class="bi bi-check-circle-fill fs-4 me-3"></i> 
                        <div class="fw-medium">{{ session('success') }}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger d-flex align-items-center rounded-4 shadow-sm mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i> 
                        <div class="fw-medium">{{ session('error') }}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger border-0 bg-danger bg-opacity-10 text-danger rounded-4 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i> 
                            <div class="fw-bold">Terdapat Kesalahan:</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <ul class="mb-0 fw-medium">
                            @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
    
                    @yield('content')
                </main>
                
                <footer class="footer-modern mt-5 p-4 p-md-5">
                    <div class="container-fluid px-0">
                        <div class="row g-4">
                            <div class="col-md-5 mb-4 mb-md-0">
                                <h5 class="fw-bold text-success-emphasis mb-3 d-flex align-items-center gap-2" style="color: var(--primary-dark) !important;">
                                    <i class="bi bi-layers-fill text-success" style="font-size: 1.5rem;"></i> KELAR.IN
                                </h5>
                                <p class="text-muted mb-4 small" style="max-width: 360px; line-height: 1.6;">
                                    Sistem Repositori Tugas Akhir, Skripsi, Tesis, dan Disertasi Universitas. Memudahkan pengelolaan, pencarian, dan validasi karya ilmiah secara transparan dan terintegrasi.
                                </p>
                                <div class="d-flex gap-2">
                                    <a href="#" class="btn btn-sm text-white shadow-sm" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 50%; border: none; padding: 0 !important;"><i class="bi bi-globe"></i></a>
                                    <a href="#" class="btn btn-sm text-white shadow-sm" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 50%; border: none; padding: 0 !important;"><i class="bi bi-youtube"></i></a>
                                    <a href="#" class="btn btn-sm text-white shadow-sm" style="width: 36px; height: 36px; display: inline-flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--primary-dark)); border-radius: 50%; border: none; padding: 0 !important;"><i class="bi bi-twitter-x"></i></a>
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-6 mb-4 mb-sm-0">
                                <h6 class="fw-bold text-success-emphasis text-uppercase mb-3 small" style="letter-spacing: 1px; color: var(--primary-dark) !important;">Navigasi Cepat</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2">
                                        <a href="{{ route('welcome') }}" class="text-muted text-decoration-none small hover-primary d-flex align-items-center gap-1">
                                            <i class="bi bi-chevron-right text-success small"></i> Cari Dokumen
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="{{ route('login') }}" class="text-muted text-decoration-none small hover-primary d-flex align-items-center gap-1">
                                            <i class="bi bi-chevron-right text-success small"></i> Masuk Ke Sistem
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a href="#" class="text-muted text-decoration-none small hover-primary d-flex align-items-center gap-1">
                                            <i class="bi bi-chevron-right text-success small"></i> Panduan Pengguna
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="col-md-4 col-sm-6">
                                <h6 class="fw-bold text-success-emphasis text-uppercase mb-3 small" style="letter-spacing: 1px; color: var(--primary-dark) !important;">Hubungi Kami</h6>
                                <ul class="list-unstyled mb-0 text-muted small">
                                    <li class="d-flex gap-3 mb-3 align-items-center">
                                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle" style="width: 32px; height: 32px; flex-shrink: 0;">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>
                                        <span>Gedung Rektorat Lt. 2, Kampus Pusat Universitas</span>
                                    </li>
                                    <li class="d-flex gap-3 mb-3 align-items-center">
                                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle" style="width: 32px; height: 32px; flex-shrink: 0;">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                        <span>support@kelar.in</span>
                                    </li>
                                    <li class="d-flex gap-3 align-items-center">
                                        <div class="d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle" style="width: 32px; height: 32px; flex-shrink: 0;">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <span>Senin - Jumat: 08.00 - 16.00 WIB</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <hr class="my-4 opacity-10" style="border-color: rgba(16, 185, 129, 0.15);">
                        
                        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
                            <span class="text-muted small">&copy; {{ date('Y') }} KELAR.IN &bull; Kelompok 2 PWL. All rights reserved.</span>
                            <div class="d-flex gap-3 text-muted small">
                                <a href="#" class="text-muted text-decoration-none hover-primary">Kebijakan Privasi</a>
                                <span>&bull;</span>
                                <a href="#" class="text-muted text-decoration-none hover-primary">Syarat & Ketentuan</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
    </div>

    @stack('modals')

    <!-- Sidebar Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

        const layout = document.querySelector('.layout-wrapper');
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        const backdrop = document.getElementById('sidebarBackdrop');

        if (toggleBtn && sidebar && layout) {
            toggleBtn.addEventListener('click', function () {
                if (window.innerWidth < 992) {
                    sidebar.classList.toggle('show');
                } else {
                    layout.classList.toggle('sidebar-collapsed');
                }
            });
        }

        if (backdrop && sidebar) {
            backdrop.addEventListener('click', function () {
                sidebar.classList.remove('show');
            });
        }

        if (sidebar) {
            window.addEventListener('resize', function () {
                if (window.innerWidth >= 992) {
                    sidebar.classList.remove('show');
                }
            });
        }

    });
    </script>
</body>
</html>