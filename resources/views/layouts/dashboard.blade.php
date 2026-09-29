<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiLaporin - @yield('title')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            background: #1F2937;
            color: white;
            padding: 0;
        }

        .sidebar .brand {
            padding: 20px 16px;
            font-size: 22px;
            font-weight: 700;
            color: white;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        .sidebar .brand span {
            color: #60A5FA;
        }

        .sidebar .nav-link {
            color: #D1D5DB;
            padding: 12px 20px;
            border-radius: 0;
            border-left: 4px solid transparent;
            transition: all 0.2s;
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

        .main-content {
            padding: 24px;
        }

        .topbar {
            background: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
            background: #2563EB;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 18px;
        }

        .logout-btn {
            color: #6B7280;
            text-decoration: none;
            transition: all 0.2s;
        }

        .logout-btn:hover {
            color: #DC2626;
        }

        .status-badge {
            padding: 4px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-diterima { background: #DBEAFE; color: #1D4ED8; }
        .status-diproses { background: #FEF3C7; color: #B45309; }
        .status-selesai { background: #D1FAE5; color: #065F46; }
        .status-ditolak { background: #FEE2E2; color: #991B1B; }

        .priority-rendah { background: #D1FAE5; color: #065F46; }
        .priority-sedang { background: #FEF3C7; color: #B45309; }
        .priority-tinggi { background: #FEE2E2; color: #991B1B; }
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
@stack('scripts')
</body>
</html>