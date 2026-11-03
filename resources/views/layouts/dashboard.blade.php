
<!DOCTYPE html>
<html lang="id" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SiLaporin - @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>

    <style>
        :root {
            /* LIGHT THEME */
            --bg-body: #f3f4f6;
            --bg-card: #ffffff;
            --bg-sidebar: #1F2937;
            --bg-input: #f9fafb;
            --text-dark: #1F2937;
            --text-muted: #6B7280;
            --border: #E5E7EB;
            --primary: #2563EB;
            --primary-light: rgba(37, 99, 235, 0.12);
        }

        [data-theme="dark"] {
            /* DARK THEME */
            color-scheme: dark;
            --bg-body: #0F172A;
            --bg-card: #1E293B;
            --bg-sidebar: #0B1220;
            --bg-input: #273449;
            --text-dark: #F1F5F9;
            --text-muted: #94A3B8;
            --border: #334155;
            --primary: #3B82F6;
            --primary-light: rgba(59, 130, 246, 0.15);

            /* Bootstrap variables */
            --bs-body-color: #F1F5F9;
            --bs-body-bg: #0F172A;
            --bs-secondary-color: #94A3B8;
            --bs-border-color: #334155;
            --bs-tertiary-bg: #273449;
        }

        /* Tema Admin (Merah/Ruby) */
        [data-role="admin"] {
            --primary: #DC2626;
            --primary-light: rgba(220, 38, 38, 0.12);
            --bg-sidebar: #450a0a;
        }

        [data-theme="dark"][data-role="admin"] {
            --bg-sidebar: #2a0505;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* === SIDEBAR === */
        .sidebar {
            min-height: 100vh;
            background: var(--bg-sidebar);
            color: white;
            padding: 0;
            transition: all 0.3s ease;
            position: fixed;
            width: 16.66666667%;
            z-index: 1040;
        }

        .sidebar .brand {
            padding: 20px 16px;
            font-size: 22px;
            font-weight: 800;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar .brand span {
            color: #93C5FD;
        }

        [data-role="admin"] .sidebar .brand span {
            color: #FCA5A5;
        }

        .sidebar .nav-link {
            color: #D1D5DB;
            padding: 12px 20px;
            border-left: 4px solid transparent;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: var(--primary-light);
            color: white;
            border-left-color: var(--primary);
        }

        .sidebar .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 18px;
        }

        .sidebar .nav-link .badge {
            margin-left: auto;
        }

        /* === MAIN CONTENT === */
        .main-content {
            margin-left: 16.66666667%;
            padding: 24px;
            transition: all 0.3s ease;
        }

        .topbar {
            background: var(--bg-card);
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid var(--border);
        }

        .topbar .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .topbar .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-dark);
            background: var(--bg-input);
            transition: all 0.2s;
            text-decoration: none;
            position: relative;
            border: 1px solid var(--border);
        }

        .topbar .icon-btn:hover {
            background: var(--primary);
            color: white;
        }

        .notif-badge {
            position: absolute;
            top: -2px;
            right: -2px;
            background: #EF4444;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* === KOMPONEN CARD & TABEL === */
        .card {
            background: var(--bg-card);
            color: var(--text-dark);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            margin-bottom: 20px;
        }

        .card-header {
            background: var(--bg-card);
            border-bottom: 1px solid var(--border);
            color: var(--text-dark);
        }

        .form-control,
        .form-select {
            background: var(--bg-input);
            color: var(--text-dark);
            border: 1px solid var(--border);
        }

        .form-control:focus,
        .form-select:focus {
            background: var(--bg-input);
            color: var(--text-dark);
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-light);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        /* === DARK MODE IMPROVEMENT === */

        [data-theme="dark"] body {
            background-color: var(--bg-body);
            color: var(--text-dark);
        }

        /* Text */
        [data-theme="dark"] .text-dark,
        [data-theme="dark"] .text-body {
            color: #F1F5F9 !important;
        }

        [data-theme="dark"] .text-muted {
            color: #94A3B8 !important;
        }

        [data-theme="dark"] h1,
        [data-theme="dark"] h2,
        [data-theme="dark"] h3,
        [data-theme="dark"] h4,
        [data-theme="dark"] h5,
        [data-theme="dark"] h6,
        [data-theme="dark"] p {
            color: inherit;
        }

        /* Card */
        [data-theme="dark"] .card,
        [data-theme="dark"] .card-header,
        [data-theme="dark"] .card-body,
        [data-theme="dark"] .card-footer {
            background-color: var(--bg-card);
            color: var(--text-dark);
            border-color: var(--border);
        }

        /* Topbar */
        [data-theme="dark"] .topbar {
            background-color: var(--bg-card);
            border-color: var(--border);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        /* Table */
        [data-theme="dark"] .table {
            --bs-table-color: #F1F5F9;
            --bs-table-bg: #1E293B;
            --bs-table-border-color: #334155;
            --bs-table-striped-color: #F1F5F9;
            --bs-table-striped-bg: #243247;
            --bs-table-hover-color: #FFFFFF;
            --bs-table-hover-bg: #334155;

            color: #F1F5F9 !important;
            border-color: #334155 !important;
        }

        [data-theme="dark"] .table th,
        [data-theme="dark"] .table td {
            color: #F1F5F9 !important;
            border-color: #334155 !important;
        }

        [data-theme="dark"] .table thead th {
            background-color: #273449 !important;
            color: #CBD5E1 !important;
            border-bottom: 2px solid #334155 !important;
        }

        [data-theme="dark"] .table-hover tbody tr:hover > * {
            background-color: #334155 !important;
            color: #FFFFFF !important;
        }

        /* Input */
        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select,
        [data-theme="dark"] textarea {
            background-color: #273449;
            color: #F1F5F9;
            border-color: #475569;
        }

        [data-theme="dark"] .form-control::placeholder,
        [data-theme="dark"] textarea::placeholder {
            color: #94A3B8;
        }

        [data-theme="dark"] .form-control:focus,
        [data-theme="dark"] .form-select:focus,
        [data-theme="dark"] textarea:focus {
            background-color: #273449;
            color: #FFFFFF;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px var(--primary-light);
        }

        [data-theme="dark"] .form-select option {
            background-color: #1E293B;
            color: #F1F5F9;
        }

        /* Button */
        [data-theme="dark"] .btn-light {
            background-color: #334155;
            color: #F1F5F9;
            border-color: #475569;
        }

        [data-theme="dark"] .btn-outline-secondary {
            color: #CBD5E1;
            border-color: #64748B;
        }

        /* Dropdown */
        [data-theme="dark"] .dropdown-menu {
            background-color: #1E293B;
            border-color: #334155;
        }

        [data-theme="dark"] .dropdown-item {
            color: #F1F5F9;
        }

        [data-theme="dark"] .dropdown-item:hover {
            background-color: #334155;
            color: #FFFFFF;
        }

        /* Modal */
        [data-theme="dark"] .modal-content {
            background-color: #1E293B;
            color: #F1F5F9;
            border-color: #334155;
        }

        [data-theme="dark"] .modal-header,
        [data-theme="dark"] .modal-footer {
            border-color: #334155;
        }

        [data-theme="dark"] .btn-close {
            filter: invert(1);
        }

        /* Alert */
        [data-theme="dark"] .alert-light,
        [data-theme="dark"] .bg-light {
            background-color: #273449 !important;
            color: #F1F5F9 !important;
            border-color: #334155 !important;
        }

        /* List Group */
        [data-theme="dark"] .list-group-item {
            background-color: #1E293B;
            color: #F1F5F9;
            border-color: #334155;
        }

        /* Pagination */
        [data-theme="dark"] .page-link {
            background-color: #1E293B;
            color: #60A5FA;
            border-color: #334155;
        }

        [data-theme="dark"] .page-item.active .page-link {
            background-color: var(--primary);
            color: #FFFFFF;
            border-color: var(--primary);
        }

        /* Sidebar */
        [data-theme="dark"] .sidebar {
            background-color: var(--bg-sidebar);
        }

        [data-theme="dark"] .sidebar .nav-link {
            color: #CBD5E1;
        }

        [data-theme="dark"] .sidebar .nav-link:hover,
        [data-theme="dark"] .sidebar .nav-link.active {
            background-color: var(--primary-light);
            color: #FFFFFF;
        }

        /* Admin Dark Mode */
        [data-theme="dark"][data-role="admin"] {
            --primary: #EF4444;
            --primary-light: rgba(239, 68, 68, 0.15);
            --bg-sidebar: #200B0B;
        }

        /* Transition */
        body,
        .card,
        .topbar,
        .sidebar,
        .form-control,
        .form-select,
        .table,
        .modal-content,
        .dropdown-menu {
            transition:
                background-color 0.25s ease,
                color 0.25s ease,
                border-color 0.25s ease;
        }

        /* === MOBILE RESPONSIVE === */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                width: 250px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 16px;
            }

            .topbar {
                padding: 12px 16px;
            }

            .mobile-menu-btn {
                display: block !important;
            }

            .hide-mobile {
                display: none;
            }
        }

        .mobile-menu-btn {
            display: none;
            color: var(--text-dark);
            font-size: 24px;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            z-index: 1030;
        }

        .sidebar-overlay.show {
            display: block;
        }

        /* Badge Status */
        .status-diterima {
            background: #DBEAFE;
            color: #1D4ED8;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-diproses {
            background: #FEF3C7;
            color: #B45309;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-selesai {
            background: #D1FAE5;
            color: #065F46;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-ditolak {
            background: #FEE2E2;
            color: #991B1B;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .priority-rendah {
            background: #D1FAE5;
            color: #065F46;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .priority-sedang {
            background: #FEF3C7;
            color: #B45309;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .priority-tinggi {
            background: #FEE2E2;
            color: #991B1B;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>

    @stack('styles')
</head>

<body data-role="{{ strtolower(Auth::user()->role) }}">

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<div class="container-fluid p-0">

    <div class="sidebar" id="sidebar">
        <div class="brand">Si<span>Laporin</span></div>

        <nav class="nav flex-column mt-2">

            @if(Auth::user()->isAdmin())

                <a href="{{ route('dashboard.admin') }}"
                   class="nav-link {{ request()->routeIs('dashboard.admin') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>

                <a href="{{ route('admin.complaints.index') }}"
                   class="nav-link {{ request()->routeIs('admin.complaints.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i> Kelola Pengaduan
                </a>

                <a href="{{ route('admin.users.index') }}"
                   class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Kelola Pengguna
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fas fa-tags"></i> Kelola Kategori
                </a>

                <a href="{{ route('admin.reports.index') }}"
                   class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i> Laporan
                </a>

            @else

                <a href="{{ route('dashboard.siswa') }}"
                   class="nav-link {{ request()->routeIs('dashboard.siswa') ? 'active' : '' }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>

                <a href="{{ route('siswa.complaints.create') }}"
                   class="nav-link {{ request()->routeIs('siswa.complaints.create') ? 'active' : '' }}">
                    <i class="fas fa-plus-circle"></i> Buat Pengaduan
                </a>

                <a href="{{ route('siswa.complaints.history') }}"
                   class="nav-link {{ request()->routeIs('siswa.complaints.history') ? 'active' : '' }}">
                    <i class="fas fa-history"></i> Riwayat
                </a>

            @endif

            <hr class="text-secondary mx-3">

            <a href="{{ route('profile') }}"
               class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                <i class="fas fa-user"></i> Profil
            </a>

            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </nav>
    </div>

    <div class="main-content" id="mainContent">

        <div class="topbar">

            <div class="d-flex align-items-center gap-3">

                <div class="mobile-menu-btn" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </div>

                <h5 class="m-0 fw-bold d-none d-md-block">
                    @yield('title')
                </h5>

            </div>

            <div class="d-flex align-items-center gap-2 gap-md-3">

                <div class="icon-btn" onclick="toggleTheme()" title="Ganti Tema">
                    <i class="fas fa-moon" id="themeIcon"></i>
                </div>

                <a href="{{ route('notifications.index') }}"
                   class="icon-btn"
                   title="Notifikasi">

                    <i class="fas fa-bell"></i>

                    @php
                        $unreadCount = Auth::user()->notifications()->where('is_read', false)->count();
                    @endphp

                    @if($unreadCount > 0)
                        <span class="notif-badge">{{ $unreadCount }}</span>
                    @endif

                </a>

                <span class="fw-semibold d-none d-md-block ms-2">
                    {{ Auth::user()->name }}
                </span>

                <span class="badge" style="background: var(--primary);">
                    {{ Auth::user()->role }}
                </span>

                <div class="avatar">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>

            </div>

        </div>

        <h5 class="m-0 fw-bold d-md-none mb-3">
            @yield('title')
        </h5>

        @yield('content')

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
        document.getElementById('sidebarOverlay').classList.toggle('show');
    }

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

    document.addEventListener('DOMContentLoaded', () => {
        updateThemeIcon(document.documentElement.getAttribute('data-theme') || 'light');
    });
</script>

@stack('scripts')

</body>
</html>
