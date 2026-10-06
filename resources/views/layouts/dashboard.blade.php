<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiLaporin - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        // Cek tema dari localStorage SEBELUM render (biar gak flash)
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <style>
        * { font-family: 'Poppins', sans-serif; }

        /* ====================================================
           CSS VARIABLES - LIGHT THEME (DEFAULT)
           ==================================================== */
        :root {
            --bg-body: #f3f4f6;
            --bg-card: #ffffff;
            --bg-sidebar: #1F2937;
            --bg-topbar: #ffffff;
            --bg-input: #f9fafb;
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --text-sidebar: #D1D5DB;
            --border-color: #E5E7EB;
            --shadow: 0 2px 8px rgba(0,0,0,0.05);
            --shadow-hover: 0 10px 25px rgba(0,0,0,0.1);
            --primary: #2563EB;
            --primary-dark: #1D4ED8;
        }

        /* ====================================================
           CSS VARIABLES - DARK THEME
           ==================================================== */
        [data-theme="dark"] {
            --bg-body: #0F172A;
            --bg-card: #1E293B;
            --bg-sidebar: #0B1220;
            --bg-topbar: #1E293B;
            --bg-input: #334155;
            --text-primary: #F1F5F9;
            --text-secondary: #94A3B8;
            --text-sidebar: #CBD5E1;
            --border-color: #334155;
            --shadow: 0 2px 8px rgba(0,0,0,0.3);
            --shadow-hover: 0 10px 25px rgba(0,0,0,0.5);
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-primary);
            min-height: 100vh;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar {
            min-height: 100vh;
            background: var(--bg-sidebar);
            color: white;
            padding: 0;
            transition: background-color 0.3s ease;
        }

        .sidebar .brand {
            padding: 20px 16px;
            font-size: 22px;
            font-weight: 700;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar .brand span { color: #60A5FA; }

        .sidebar .nav-link {
            color: var(--text-sidebar);
            padding: 12px 20px;
            border-radius: 0;
            border-left: 4px solid transparent;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link:hover {
            background: rgba(255,255,255,0.06);
            color: white;
            border-left-color: #60A5FA;
        }

        .sidebar .nav-link.active {
            background: rgba(96, 165, 250, 0.12);
            color: white;
            border-left-color: #60A5FA;
        }

        .sidebar .nav-link i {
            width: 24px;
            margin-right: 12px;
        }

        .sidebar .nav-link .badge {
            margin-left: auto;
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 10px;
            font-weight: 600;
        }

        .main-content {
            padding: 24px;
        }

        .topbar {
            background: var(--bg-topbar);
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: var(--shadow);
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar .user-info .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
        }

        /* DARK MODE TOGGLE BUTTON */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--bg-input);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .theme-toggle:hover {
            background: var(--primary);
            color: white;
            transform: rotate(20deg);
        }

        /* CARDS - DARK MODE SUPPORT */
        .card {
            background: var(--bg-card);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            transition: background-color 0.3s ease;
        }

        .card-header {
            background: var(--bg-card);
            color: var(--text-primary);
            border-bottom: 1px solid var(--border-color);
        }

        .card-body {
            color: var(--text-primary);
        }

        /* TABLES - DARK MODE */
        .table {
            color: var(--text-primary);
        }

        .table thead th {
            color: var(--text-secondary);
            border-bottom-color: var(--border-color);
        }

        .table tbody tr {
            border-bottom-color: var(--border-color);
        }

        .table-hover tbody tr:hover {
            background: rgba(37, 99, 235, 0.05);
            color: var(--text-primary);
        }

        /* TEXT COLORS */
        .text-gray-800 { color: var(--text-primary) !important; }
        .text-muted { color: var(--text-secondary) !important; }

        /* FORM INPUT - DARK MODE */
        .form-control, .form-select {
            background: var(--bg-input);
            color: var(--text-primary);
            border-color: var(--border-color);
        }

        .form-control:focus, .form-select:focus {
            background: var(--bg-input);
            color: var(--text-primary);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        /* STATUS BADGES */
        .status-diterima { background: #DBEAFE; color: #1D4ED8; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-diproses { background: #FEF3C7; color: #B45309; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-selesai { background: #D1FAE5; color: #065F46; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .status-ditolak { background: #FEE2E2; color: #991B1B; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }

        .priority-rendah { background: #D1FAE5; color: #065F46; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .priority-sedang { background: #FEF3C7; color: #B45309; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .priority-tinggi { background: #FEE2E2; color: #991B1B; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: 600; }

        /* MODAL DARK MODE */
        .modal-content {
            background: var(--bg-card);
            color: var(--text-primary);
        }

        /* ALERT DARK MODE */
        .alert-info {
            background: rgba(37, 99, 235, 0.1);
            border-color: rgba(37, 99, 235, 0.3);
            color: var(--text-primary);
        }

        /* SCROLLBAR DARK */
        [data-theme="dark"]::-webkit-scrollbar {
            width: 10px;
        }

        [data-theme="dark"]::-webkit-scrollbar-track {
            background: #1E293B;
        }

        [data-theme="dark"]::-webkit-scrollbar-thumb {
            background: #475569;
            border-radius: 5px;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="container-fluid p-0">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <div class="brand">
                Si<span>Laporin</span>
            </div>

            <nav class="nav flex-column">
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('dashboard.admin') }}" class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.complaints.index') }}" class="nav-link {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">
                        <i class="fas fa-clipboard-list"></i> Kelola Pengaduan
                        @if(isset($pendingComplaints) && $pendingComplaints > 0)
                            <span class="badge bg-danger">{{ $pendingComplaints }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i> Kelola Pengguna
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i> Kelola Kategori
                    </a>
                    <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                        <i class="fas fa-file-alt"></i> Laporan
                    </a>
                @else
                    <a href="{{ route('dashboard.siswa') }}" class="nav-link {{ request()->routeIs('dashboard.siswa') ? 'active' : '' }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('siswa.complaints.create') }}" class="nav-link {{ request()->routeIs('siswa.complaints.create') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i> Buat Pengaduan
                    </a>
                    <a href="{{ route('siswa.complaints.history') }}" class="nav-link {{ request()->routeIs('siswa.complaints.history') ? 'active' : '' }}">
                        <i class="fas fa-history"></i> Riwayat Pengaduan
                        @if(isset($myActiveComplaints) && $myActiveComplaints > 0)
                            <span class="badge bg-info">{{ $myActiveComplaints }}</span>
                        @endif
                    </a>
                @endif

                <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i> Profil
                </a>
                <a href="{{ route('logout') }}" class="nav-link"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col-md-10">
            <div class="main-content">
                <!-- Top Bar -->
                <div class="topbar">
                    <div>
                        <h5 class="m-0 fw-bold">@yield('title')</h5>
                    </div>
                    <div class="user-info">
                        <button class="theme-toggle" onclick="toggleTheme()" title="Ganti Tema">
                            <i class="fas fa-moon" id="themeIcon"></i>
                        </button>
                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                        <span class="badge bg-primary">{{ Auth::user()->role }}</span>
                        <div class="avatar">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                </div>

                <!-- Content -->
                @yield('content')
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ==========================================================
    // DARK MODE TOGGLE
    // ==========================================================
    function toggleTheme() {
        const html = document.documentElement;
        const currentTheme = html.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
    }

    function updateThemeIcon(theme) {
        const icon = document.getElementById('themeIcon');
        if (theme === 'dark') {
            icon.classList.remove('fa-moon');
            icon.classList.add('fa-sun');
        } else {
            icon.classList.remove('fa-sun');
            icon.classList.add('fa-moon');
        }
    }

    // Update icon saat halaman load
    document.addEventListener('DOMContentLoaded', function() {
        const theme = document.documentElement.getAttribute('data-theme') || 'light';
        updateThemeIcon(theme);
    });
</script>

@stack('scripts')
</body>
</html>