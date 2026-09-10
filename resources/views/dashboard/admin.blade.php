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