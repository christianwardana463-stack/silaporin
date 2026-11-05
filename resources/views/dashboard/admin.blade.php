
@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@push('styles')
<style>
    /* =====================================
       DASHBOARD ADMIN - THEME SUPPORT
    ===================================== */

    .admin-dashboard {
        color: var(--text-dark);
    }

    .admin-dashboard .card {
        background: var(--bg-card);
        color: var(--text-dark);
        border: 1px solid var(--border);
        border-radius: 14px;
    }

    .admin-dashboard .card h2 {
        color: var(--text-dark);
    }

    .admin-dashboard .card small {
        color: var(--text-muted, #64748b);
    }

    /* LIGHT MODE TABLE */
    .admin-dashboard .table {
        --bs-table-color: #1F2937;
        --bs-table-bg: #FFFFFF;
        --bs-table-border-color: #E5E7EB;
        --bs-table-hover-color: #1F2937;
        --bs-table-hover-bg: #F1F5F9;

        color: #1F2937;
        background: #FFFFFF;
        border-color: #E5E7EB;
        margin-bottom: 0;
    }

    .admin-dashboard .table thead th,
    .admin-dashboard .table-light th {
        background: #F1F5F9 !important;
        color: #334155 !important;
        border-color: #E5E7EB !important;
        font-weight: 700;
        white-space: nowrap;
    }

    .admin-dashboard .table tbody td {
        background: #FFFFFF;
        color: #1F2937 !important;
        border-color: #E5E7EB !important;
        vertical-align: middle;
    }

    .admin-dashboard .table-hover tbody tr:hover td {
        background: #F1F5F9 !important;
        color: #1F2937 !important;
    }

    /* DARK MODE TABLE */
    [data-theme="dark"] .admin-dashboard .table,
    [data-theme="dark"] .admin-dashboard .table-light {
        --bs-table-color: #F1F5F9;
        --bs-table-bg: #1E293B;
        --bs-table-border-color: #475569;
        --bs-table-hover-color: #FFFFFF;
        --bs-table-hover-bg: #334155;

        color: #F1F5F9 !important;
        background: #1E293B !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .admin-dashboard .table thead th,
    [data-theme="dark"] .admin-dashboard .table-light th {
        background: #334155 !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .admin-dashboard .table tbody tr,
    [data-theme="dark"] .admin-dashboard .table tbody td {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .admin-dashboard .table-hover tbody tr:hover td {
        background: #334155 !important;
        color: #FFFFFF !important;
    }

    /* CARD DARK MODE */
    [data-theme="dark"] .admin-dashboard .card {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .admin-dashboard .card h2,
    [data-theme="dark"] .admin-dashboard .card h6 {
        color: #F1F5F9 !important;
    }

    [data-theme="dark"] .admin-dashboard .card small {
        color: #CBD5E1 !important;
    }

    /* STATUS */
    .admin-dashboard .status-diterima,
    .admin-dashboard .status-diproses,
    .admin-dashboard .status-selesai,
    .admin-dashboard .status-ditolak {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .admin-dashboard .status-diterima {
        background: #DBEAFE;
        color: #1D4ED8;
    }

    .admin-dashboard .status-diproses {
        background: #FEF3C7;
        color: #92400E;
    }

    .admin-dashboard .status-selesai {
        background: #D1FAE5;
        color: #065F46;
    }

    .admin-dashboard .status-ditolak {
        background: #FEE2E2;
        color: #991B1B;
    }

    /* BUTTON */
    .admin-dashboard .btn-view {
        background: var(--primary);
        color: #FFFFFF;
        border: none;
    }

    .admin-dashboard .btn-view:hover {
        opacity: 0.85;
        color: #FFFFFF;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .admin-dashboard .table {
            min-width: 650px;
        }
    }

/* =====================================
   STATUS BADGES - FIX KONTRAS
===================================== */

.admin-dashboard .status-diterima {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    background: #DBEAFE !important;
    color: #1D4ED8 !important;
}

.admin-dashboard .status-diproses {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    background: #FEF3C7 !important;
    color: #92400E !important;
}

.admin-dashboard .status-selesai {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    background: #D1FAE5 !important;
    color: #065F46 !important;
}

.admin-dashboard .status-ditolak {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    white-space: nowrap;
    background: #FEE2E2 !important;
    color: #991B1B !important;
}

</style>
@endpush

@section('content')

<div class="admin-dashboard">

    <!-- STATISTIK -->
    <div class="row">

        <div class="col-6 col-md-3 mb-3">
            <div class="card p-3 border-0 h-100"
                 style="border-left: 4px solid var(--primary) !important;">
                <small class="fw-bold text-uppercase">Total Pengaduan</small>
                <h2 class="fw-bold m-0 mt-2">{{ $totalComplaints }}</h2>
            </div>
        </div>

        <div class="col-6 col-md-3 mb-3">
            <div class="card p-3 border-0 h-100"
                 style="border-left: 4px solid #F59E0B !important;">
                <small class="fw-bold text-uppercase">Diproses</small>
                <h2 class="fw-bold m-0 mt-2 text-warning">{{ $diproses }}</h2>
            </div>
        </div>

        <div class="col-6 col-md-3 mb-3">
            <div class="card p-3 border-0 h-100"
                 style="border-left: 4px solid #10B981 !important;">
                <small class="fw-bold text-uppercase">Selesai</small>
                <h2 class="fw-bold m-0 mt-2 text-success">{{ $selesai }}</h2>
            </div>
        </div>

        <div class="col-6 col-md-3 mb-3">
            <div class="card p-3 border-0 h-100"
                 style="border-left: 4px solid #EF4444 !important;">
                <small class="fw-bold text-uppercase">Ditolak</small>
                <h2 class="fw-bold m-0 mt-2 text-danger">{{ $ditolak }}</h2>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <div class="row mt-2">

        <div class="col-md-8 mb-3">
            <div class="card h-100 p-3">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-chart-line me-2"></i>
                    Tren Pengaduan 7 Hari
                </h6>

                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="chartTrend"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card h-100 p-3">
                <h6 class="fw-bold mb-3">
                    <i class="fas fa-chart-pie me-2"></i>
                    Status Pengaduan
                </h6>

                <div style="position: relative; height: 300px; width: 100%;">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- PENGADUAN TERBARU -->
    <div class="card p-3 mt-2">

        <h6 class="fw-bold mb-3">
            <i class="fas fa-clock me-2"></i>
            Pengaduan Terbaru
        </h6>

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Tiket</th>
                        <th>Pelapor</th>
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
                            {{ $c->user->name }}
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
                            <a href="{{ route('admin.complaints.show', $c->id) }}"
                               class="btn btn-sm btn-view">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Belum ada data.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // DETEKSI TEMA
    function getDashboardTheme() {
        return document.documentElement.getAttribute('data-theme') === 'dark' ||
               document.body.getAttribute('data-theme') === 'dark';
    }

    const isDark = getDashboardTheme();

    const chartTextColor = isDark ? '#CBD5E1' : '#64748B';
    const chartGridColor = isDark
        ? 'rgba(148, 163, 184, 0.12)'
        : 'rgba(100, 116, 139, 0.12)';

    // CHART TREND
    new Chart(document.getElementById('chartTrend'), {
        type: 'line',

        data: {
            labels: @json($chartTrendLabels),

            datasets: [{
                label: 'Pengaduan',
                data: @json($chartTrendData),
                borderColor: '#DC2626',
                backgroundColor: 'rgba(220, 38, 38, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    labels: {
                        color: chartTextColor
                    }
                }
            },

            scales: {
                x: {
                    ticks: {
                        color: chartTextColor
                    },
                    grid: {
                        color: chartGridColor
                    }
                },

                y: {
                    ticks: {
                        color: chartTextColor
                    },
                    grid: {
                        color: chartGridColor
                    }
                }
            }
        }
    });

    // CHART STATUS
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',

        data: {
            labels: @json($chartStatusLabels),

            datasets: [{
                data: @json($chartStatusData),
                backgroundColor: [
                    '#3B82F6',
                    '#F59E0B',
                    '#10B981',
                    '#EF4444'
                ],
                borderWidth: 0
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',

            plugins: {
                legend: {
                    labels: {
                        color: chartTextColor
                    }
                }
            }
        }
    });
</script>

@endpush
