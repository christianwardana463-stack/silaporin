@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>

    <!-- Statistik Cards -->
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 4px solid #2563EB;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                Total Pengaduan
                            </div>
                            <div class="h3 mb-0 fw-bold">{{ $totalComplaints }}</div>
                        </div>
                        <i class="fas fa-clipboard-list fa-2x" style="color: #2563EB; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 4px solid #F59E0B;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-uppercase mb-1" style="color: #F59E0B;">
                                Diproses
                            </div>
                            <div class="h3 mb-0 fw-bold">{{ $diproses }}</div>
                        </div>
                        <i class="fas fa-spinner fa-2x" style="color: #F59E0B; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 4px solid #10B981;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-uppercase mb-1" style="color: #10B981;">
                                Selesai
                            </div>
                            <div class="h3 mb-0 fw-bold">{{ $selesai }}</div>
                        </div>
                        <i class="fas fa-check-circle fa-2x" style="color: #10B981; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 py-2" style="border-left: 4px solid #EF4444;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs fw-bold text-uppercase mb-1" style="color: #EF4444;">
                                Ditolak
                            </div>
                            <div class="h3 mb-0 fw-bold">{{ $ditolak }}</div>
                        </div>
                        <i class="fas fa-times-circle fa-2x" style="color: #EF4444; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CHART SECTION -->
    <div class="row">
        <!-- Chart 1: Tren Pengaduan 7 Hari -->
        <div class="col-md-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-line me-2"></i> Tren Pengaduan 7 Hari Terakhir
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="chartTrend" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart 2: Status Pengaduan -->
        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-pie me-2"></i> Status Pengaduan
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="chartStatus" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart 3: Pengaduan per Kategori -->
        <div class="col-md-12 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-chart-bar me-2"></i> Pengaduan per Kategori
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="chartCategories" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Tambahan -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <i class="fas fa-users fa-2x text-primary mb-2"></i>
                    <h5 class="fw-bold">{{ $totalUsers }}</h5>
                    <small class="text-muted">Total Pengguna</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <i class="fas fa-user-graduate fa-2x text-info mb-2"></i>
                    <h5 class="fw-bold">{{ $totalSiswa }}</h5>
                    <small class="text-muted">Total Siswa</small>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <i class="fas fa-tags fa-2x text-success mb-2"></i>
                    <h5 class="fw-bold">{{ $totalKategori }}</h5>
                    <small class="text-muted">Total Kategori</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaduan Terbaru -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-clock me-2"></i> Pengaduan Terbaru
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentComplaints as $complaint)
                            <tr>
                                <td><strong>{{ $complaint->ticket_number }}</strong></td>
                                <td>{{ $complaint->user->name }}</td>
                                <td>{{ $complaint->category->name }}</td>
                                <td>{{ Str::limit($complaint->title, 30) }}</td>
                                <td>
                                    <span class="badge status-{{ strtolower($complaint->status) }}">
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                                <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.complaints.show', $complaint->id) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x text-muted d-block mb-2"></i>
                                    <span class="text-muted">Belum ada pengaduan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // ============================================
    // CHART 1: TREN PENGADUAN 7 HARI (LINE CHART)
    // ============================================
    const ctxTrend = document.getElementById('chartTrend').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: @json($chartTrendLabels),
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: @json($chartTrendData),
                borderColor: '#2563EB',
                backgroundColor: 'rgba(37, 99, 235, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#2563EB',
                pointBorderColor: '#FFFFFF',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { family: 'Poppins', size: 11 }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: { family: 'Poppins', size: 11 }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // ============================================
    // CHART 2: STATUS PENGADUAN (DOUGHNUT)
    // ============================================
    const ctxStatus = document.getElementById('chartStatus').getContext('2d');
    new Chart(ctxStatus, {
        type: 'doughnut',
        data: {
            labels: @json($chartStatusLabels),
            datasets: [{
                data: @json($chartStatusData),
                backgroundColor: [
                    '#3B82F6', // Diterima - Blue
                    '#F59E0B', // Diproses - Yellow
                    '#10B981', // Selesai - Green
                    '#EF4444'  // Ditolak - Red
                ],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: 'Poppins', size: 11 },
                        padding: 12,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                }
            },
            cutout: '65%'
        }
    });

    // ============================================
    // CHART 3: PENGADUAN PER KATEGORI (BAR CHART)
    // ============================================
    const ctxCategories = document.getElementById('chartCategories').getContext('2d');
    new Chart(ctxCategories, {
        type: 'bar',
        data: {
            labels: @json($chartCategoriesLabels),
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: @json($chartCategoriesData),
                backgroundColor: [
                    '#2563EB', '#10B981', '#F59E0B', '#EF4444',
                    '#8B5CF6', '#EC4899', '#06B6D4', '#F97316'
                ],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { family: 'Poppins', size: 11 }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    ticks: {
                        font: { family: 'Poppins', size: 11 }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>
@endpush