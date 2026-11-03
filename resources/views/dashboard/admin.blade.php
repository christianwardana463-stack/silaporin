@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row">
    <!-- Total (Merah) -->
    <div class="col-6 col-md-3 mb-3">
        <div class="card p-3 border-0 h-100" style="border-left: 4px solid var(--primary) !important;">
            <small class="text-muted fw-bold text-uppercase">Total Pengaduan</small>
            <h2 class="fw-bold m-0 mt-2">{{ $totalComplaints }}</h2>
        </div>
    </div>
    <!-- Diproses (Kuning) -->
    <div class="col-6 col-md-3 mb-3">
        <div class="card p-3 border-0 h-100" style="border-left: 4px solid #F59E0B !important;">
            <small class="text-muted fw-bold text-uppercase">Diproses</small>
            <h2 class="fw-bold m-0 mt-2 text-warning">{{ $diproses }}</h2>
        </div>
    </div>
    <!-- Selesai (Hijau) -->
    <div class="col-6 col-md-3 mb-3">
        <div class="card p-3 border-0 h-100" style="border-left: 4px solid #10B981 !important;">
            <small class="text-muted fw-bold text-uppercase">Selesai</small>
            <h2 class="fw-bold m-0 mt-2 text-success">{{ $selesai }}</h2>
        </div>
    </div>
    <!-- Ditolak (Merah Tua) -->
    <div class="col-6 col-md-3 mb-3">
        <div class="card p-3 border-0 h-100" style="border-left: 4px solid #EF4444 !important;">
            <small class="text-muted fw-bold text-uppercase">Ditolak</small>
            <h2 class="fw-bold m-0 mt-2 text-danger">{{ $ditolak }}</h2>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="row mt-2">
    <div class="col-md-8 mb-3">
        <div class="card h-100 p-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-chart-line me-2"></i>Tren Pengaduan 7 Hari</h6>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="chartTrend"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card h-100 p-3">
            <h6 class="fw-bold mb-3"><i class="fas fa-chart-pie me-2"></i>Status Pengaduan</h6>
            <div style="position: relative; height: 300px; width: 100%;">
                <canvas id="chartStatus"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Pengaduan Terbaru -->
<div class="card p-3 mt-2">
    <h6 class="fw-bold mb-3"><i class="fas fa-clock me-2"></i>Pengaduan Terbaru</h6>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
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
                    <td class="fw-bold">{{ $c->ticket_number }}</td>
                    <td>{{ $c->user->name }}</td>
                    <td>{{ Str::limit($c->title, 20) }}</td>
                    <td><span class="status-{{ strtolower($c->status) }}">{{ $c->status }}</span></td>
                    <td>
                        <a href="{{ route('admin.complaints.show', $c->id) }}" class="btn btn-sm text-white" style="background: var(--primary);">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart Trend
    new Chart(document.getElementById('chartTrend'), {
        type: 'line',
        data: {
            labels: @json($chartTrendLabels),
            datasets: [{
                label: 'Pengaduan',
                data: @json($chartTrendData),
                borderColor: '#DC2626', // Warna Merah Admin
                backgroundColor: 'rgba(220, 38, 38, 0.1)',
                borderWidth: 3, fill: true, tension: 0.4
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });

    // Chart Status
    new Chart(document.getElementById('chartStatus'), {
        type: 'doughnut',
        data: {
            labels: @json($chartStatusLabels),
            datasets: [{
                data: @json($chartStatusData),
                backgroundColor: ['#3B82F6', '#F59E0B', '#10B981', '#EF4444'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '70%' }
    });
</script>
@endpush