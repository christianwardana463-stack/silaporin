@extends('layouts.dashboard')

@section('title', 'Laporan Pengaduan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Laporan Pengaduan</h1>
    </div>

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter me-2"></i> Filter Laporan
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Dari Tanggal</label>
                    <input type="date" name="start_date" class="form-control"
                           value="{{ request('start_date') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Sampai Tanggal</label>
                    <input type="date" name="end_date" class="form-control"
                           value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Kategori</label>
                    <select name="category" class="form-select">
                        <option value="">Semua</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua</option>
                        <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold">Prioritas</label>
                    <select name="priority" class="form-select">
                        <option value="">Semua</option>
                        <option value="Rendah" {{ request('priority') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="Sedang" {{ request('priority') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Tinggi" {{ request('priority') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i> Tampilkan
                    </button>
                    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary">
                        <i class="fas fa-undo me-2"></i> Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Hasil Laporan -->
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-file-alt me-2"></i> Hasil Laporan ({{ $complaints->count() }} data)
            </h6>
            <div>
                <a href="{{ route('admin.reports.export-pdf', request()->query()) }}"
                   class="btn btn-sm btn-danger" target="_blank">
                    <i class="fas fa-file-pdf me-2"></i> Export PDF
                </a>
                <a href="{{ route('admin.reports.export-excel', request()->query()) }}"
                   class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel me-2"></i> Export Excel
                </a>
                <button onclick="window.print()" class="btn btn-sm btn-info">
                    <i class="fas fa-print me-2"></i> Cetak
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Tiket</th>
                            <th>Tanggal</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $index => $complaint)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $complaint->ticket_number }}</td>
                                <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                <td>{{ $complaint->user->name }}</td>
                                <td>{{ $complaint->category->name }}</td>
                                <td>{{ $complaint->title }}</td>
                                <td>
                                    <span class="badge priority-{{ strtolower($complaint->priority) }}">
                                        {{ $complaint->priority }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge status-{{ strtolower($complaint->status) }}">
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="fas fa-inbox fa-2x text-muted d-block mb-2"></i>
                                    <span class="text-muted">Tidak ada data.</span>
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