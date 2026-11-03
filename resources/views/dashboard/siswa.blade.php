
@extends('layouts.dashboard')

@section('title', 'Dashboard Siswa')

@push('styles')
<style>
    /* =====================================
       DASHBOARD SISWA - LIGHT & DARK MODE
    ===================================== */

    .dashboard-page {
        color: var(--text-dark);
    }

    /* HERO SECTION */
    .dashboard-welcome {
        background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
        color: #FFFFFF !important;
        border-radius: 20px;
        padding: 32px !important;
        border: none !important;
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
    }

    .dashboard-welcome h3,
    .dashboard-welcome p {
        color: #FFFFFF !important;
    }

    .dashboard-welcome .btn {
        background: #FFFFFF;
        color: #2563EB !important;
        border: none;
        transition: all .2s ease;
    }

    .dashboard-welcome .btn:hover {
        background: #DBEAFE;
        transform: translateY(-2px);
    }

    /* HERO DARK MODE */
    [data-theme="dark"] .dashboard-welcome {
        background: linear-gradient(135deg, #1E3A8A 0%, #172554 100%);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    }

    [data-theme="dark"] .dashboard-welcome .btn {
        background: #E2E8F0;
        color: #1D4ED8 !important;
    }

    /* STATISTIC CARDS */
    .dashboard-stat-card {
        background: var(--bg-card);
        color: var(--text-dark);
        border: 1px solid var(--border) !important;
        border-radius: 18px;
        padding: 22px !important;
        min-height: 145px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .dashboard-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.07);
    }

    .dashboard-stat-card small {
        color: var(--text-muted) !important;
        font-size: 13px;
        letter-spacing: .5px;
    }

    .dashboard-stat-card h2 {
        font-size: 36px;
        margin-top: 12px !important;
    }

    /* CARD STATISTIC DARK */
    [data-theme="dark"] .dashboard-stat-card {
        background: #1E293B;
        border-color: #334155 !important;
        box-shadow: 0 4px 15px rgba(0,0,0,.15);
    }

    [data-theme="dark"] .dashboard-stat-card:hover {
        background: #243247;
        box-shadow: 0 8px 20px rgba(0,0,0,.2);
    }

    /* RIWAYAT CARD */
    .dashboard-history {
        background: var(--bg-card);
        color: var(--text-dark);
        border: 1px solid var(--border);
        border-radius: 18px;
    }

    .dashboard-history h6 {
        color: var(--text-dark);
    }

    /* TABLE HEADER LIGHT MODE */
    .dashboard-page .table thead th {
        background: #F8FAFC;
        color: #64748B;
        font-size: 13px;
        font-weight: 600;
        padding: 14px;
        border-color: var(--border);
    }

    .dashboard-page .table tbody td {
        padding: 14px;
        vertical-align: middle;
        color: var(--text-dark);
    }

    /* TABLE DARK MODE */
    [data-theme="dark"] .dashboard-page .table {
        --bs-table-bg: #1E293B;
        --bs-table-color: #F1F5F9;
        --bs-table-border-color: #334155;
        --bs-table-hover-bg: #273449;
        --bs-table-hover-color: #FFFFFF;

        background: #1E293B;
        color: #F1F5F9;
    }

    [data-theme="dark"] .dashboard-page .table thead th,
    [data-theme="dark"] .dashboard-page .table thead.table-light th {
        background: #273449 !important;
        color: #CBD5E1 !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .dashboard-page .table tbody td {
        background: #1E293B;
        color: #F1F5F9 !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .dashboard-page .table-hover tbody tr:hover td {
        background: #334155 !important;
        color: #FFFFFF !important;
    }

    /* STATUS BADGE TETAP BERWARNA */
    .dashboard-page .status-diterima,
    .dashboard-page .status-diproses,
    .dashboard-page .status-selesai,
    .dashboard-page .status-ditolak {
        display: inline-block;
        white-space: nowrap;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .dashboard-welcome {
            padding: 24px !important;
        }

        .dashboard-welcome h3 {
            font-size: 22px;
        }

        .dashboard-welcome p {
            font-size: 13px;
        }

        .dashboard-stat-card {
            padding: 16px !important;
            min-height: 120px;
        }

        .dashboard-stat-card h2 {
            font-size: 30px;
        }

        .dashboard-page .table {
            min-width: 550px;
        }
    }
</style>
@endpush

@section('content')

<div class="dashboard-page">

    <!-- HERO SECTION -->
    <div class="card dashboard-welcome mb-4">

        <h3 class="fw-bold">
            Halo, {{ Auth::user()->name }}! 👋
        </h3>

        <p class="mb-4 opacity-75">
            Laporkan kerusakan sarana sekolah dengan mudah dan pantau progresnya.
        </p>

        <a href="{{ route('siswa.complaints.create') }}"
           class="btn fw-bold rounded-pill px-4 py-2 align-self-start">

            <i class="fas fa-plus-circle me-2"></i>
            Buat Pengaduan Baru

        </a>

    </div>

    <!-- STATISTIK PENGADUAN -->
    <div class="row">

        <!-- TOTAL -->
        <div class="col-6 col-md-3 mb-3">

            <div class="card dashboard-stat-card h-100"
                 style="border-left: 4px solid var(--primary) !important;">

                <small class="fw-bold text-uppercase">
                    Total Saya
                </small>

                <h2 class="fw-bold m-0 mt-2"
                    style="color: var(--primary);">
                    {{ $totalComplaints }}
                </h2>

            </div>

        </div>

        <!-- DIPROSES -->
        <div class="col-6 col-md-3 mb-3">

            <div class="card dashboard-stat-card h-100"
                 style="border-left: 4px solid #F59E0B !important;">

                <small class="fw-bold text-uppercase">
                    Diproses
                </small>

                <h2 class="fw-bold m-0 mt-2 text-warning">
                    {{ $diproses }}
                </h2>

            </div>

        </div>

        <!-- SELESAI -->
        <div class="col-6 col-md-3 mb-3">

            <div class="card dashboard-stat-card h-100"
                 style="border-left: 4px solid #10B981 !important;">

                <small class="fw-bold text-uppercase">
                    Selesai
                </small>

                <h2 class="fw-bold m-0 mt-2 text-success">
                    {{ $selesai }}
                </h2>

            </div>

        </div>

        <!-- DITOLAK -->
        <div class="col-6 col-md-3 mb-3">

            <div class="card dashboard-stat-card h-100"
                 style="border-left: 4px solid #EF4444 !important;">

                <small class="fw-bold text-uppercase">
                    Ditolak
                </small>

                <h2 class="fw-bold m-0 mt-2 text-danger">
                    {{ $ditolak }}
                </h2>

            </div>

        </div>

    </div>

    <!-- PENGADUAN TERBARU -->
    <div class="card dashboard-history p-3 mt-2">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h6 class="fw-bold m-0">
                <i class="fas fa-history me-2"></i>
                Riwayat Terakhir
            </h6>

            <a href="{{ route('siswa.complaints.history') }}"
               class="text-decoration-none fw-bold"
               style="color: var(--primary);">

                Lihat Semua

            </a>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>
                        <th>Tiket</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($recentComplaints as $c)

                    <tr>

                        <td class="fw-bold">
                            {{ $c->ticket_number }}
                        </td>

                        <td>
                            {{ Str::limit($c->title, 20) }}
                        </td>

                        <td>
                            <span class="status-{{ strtolower($c->status) }}">
                                {{ $c->status }}
                            </span>
                        </td>

                        <td>

                            <a href="{{ route('siswa.complaints.show', $c->id) }}"
                               class="btn btn-sm text-white"
                               style="background: var(--primary);">

                                <i class="fas fa-eye"></i>

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Belum ada pengaduan.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
