
@extends('layouts.dashboard')

@section('title', 'Laporan Pengaduan')

@push('styles')
<style>
    /* =====================================
       LAPORAN ADMIN - LIGHT MODE
    ===================================== */

    .report-page {
        color: var(--text-dark);
    }

    .report-page h1 {
        color: var(--text-dark) !important;
        font-weight: 700;
    }

    .report-page .report-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }

    .report-page .card-header {
        background: #F8FAFC;
        color: #1F2937;
        border-bottom: 1px solid #E5E7EB;
        padding: 16px 20px;
    }

    .report-page .card-header h6 {
        color: #2563EB !important;
    }

    .report-page .card-body {
        background: var(--bg-card);
        padding: 20px;
    }

    /* FORM FILTER */
    .report-page .form-label {
        color: #475569;
    }

    .report-page .form-control,
    .report-page .form-select {
        background: #FFFFFF;
        color: #1F2937;
        border: 1px solid #CBD5E1;
        border-radius: 9px;
        padding: 10px 12px;
    }

    .report-page .form-control:focus,
    .report-page .form-select:focus {
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59,130,246,.15);
    }

    /* TABLE */
    .report-page .table {
        --bs-table-color: #1F2937;
        --bs-table-bg: #FFFFFF;
        --bs-table-border-color: #E5E7EB;
        --bs-table-hover-color: #1F2937;
        --bs-table-hover-bg: #F1F5F9;

        color: #1F2937;
        background: #FFFFFF;
        margin-bottom: 0;
    }

    .report-page .table thead th {
        background: #F1F5F9 !important;
        color: #475569 !important;
        font-weight: 700;
        font-size: 13px;
        padding: 14px 12px;
        white-space: nowrap;
        border-color: #E5E7EB !important;
    }

    .report-page .table tbody td {
        background: #FFFFFF;
        color: #1F2937 !important;
        padding: 13px 12px;
        vertical-align: middle;
        border-color: #E5E7EB !important;
    }

    .report-page .table-hover tbody tr:hover td {
        background: #F1F5F9 !important;
        color: #1F2937 !important;
    }

    /* =====================================
       DARK MODE
    ===================================== */

    [data-theme="dark"] .report-page h1 {
        color: #F1F5F9 !important;
    }

    [data-theme="dark"] .report-page .report-card,
    [data-theme="dark"] .report-page .card-body {
        background: #1E293B !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .report-page .card-header {
        background: #334155 !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .report-page .card-header h6 {
        color: #93C5FD !important;
    }

    /* FORM DARK MODE */
    [data-theme="dark"] .report-page .form-label {
        color: #CBD5E1 !important;
    }

    [data-theme="dark"] .report-page .form-control,
    [data-theme="dark"] .report-page .form-select {
        background: #0F172A !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .report-page .form-control:focus,
    [data-theme="dark"] .report-page .form-select:focus {
        border-color: #3B82F6 !important;
        box-shadow: 0 0 0 3px rgba(59,130,246,.2) !important;
    }

    [data-theme="dark"] .report-page .form-select option {
        background: #1E293B;
        color: #F1F5F9;
    }

    /* TABLE DARK MODE */
    [data-theme="dark"] .report-page .table {
        --bs-table-color: #F1F5F9;
        --bs-table-bg: #1E293B;
        --bs-table-border-color: #475569;
        --bs-table-hover-color: #FFFFFF;
        --bs-table-hover-bg: #334155;

        color: #F1F5F9 !important;
        background: #1E293B !important;
    }

    [data-theme="dark"] .report-page .table thead th {
        background: #334155 !important;
        color: #CBD5E1 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .report-page .table tbody td {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .report-page .table-hover tbody tr:hover td {
        background: #334155 !important;
        color: #FFFFFF !important;
    }

    /* =====================================
       STATUS BADGES
    ===================================== */

    .report-page .status-diterima,
    .report-page .status-diproses,
    .report-page .status-selesai,
    .report-page .status-ditolak {
        display: inline-block !important;
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        white-space: nowrap;
    }

    .report-page .status-diterima {
        background: #DBEAFE !important;
        color: #1D4ED8 !important;
    }

    .report-page .status-diproses {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .report-page .status-selesai {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .report-page .status-ditolak {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* =====================================
       PRIORITY BADGES
    ===================================== */

    .report-page .priority-rendah,
    .report-page .priority-sedang,
    .report-page .priority-tinggi {
        display: inline-block !important;
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        white-space: nowrap;
    }

    .report-page .priority-rendah {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .report-page .priority-sedang {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .report-page .priority-tinggi {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* BUTTON */
    .report-page .btn {
        transition: all .2s ease;
    }

    .report-page .btn:hover {
        transform: translateY(-1px);
    }

    /* PRINT */
    @media print {
        .report-page .filter-card,
        .report-page .export-actions {
            display: none !important;
        }

        .report-page .report-card {
            box-shadow: none !important;
        }

        .report-page .table thead th,
        .report-page .table tbody td {
            background: #FFFFFF !important;
            color: #000000 !important;
        }
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .report-page h1 {
            font-size: 21px;
        }

        .report-page .card-header {
            flex-wrap: wrap;
            gap: 12px;
        }

        .report-page .export-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .report-page .card-body {
            padding: 12px;
        }

        .report-page .table {
            min-width: 900px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid report-page">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3 mb-0">
            Laporan Pengaduan
        </h1>

    </div>

    <!-- FILTER LAPORAN -->
    <div class="card report-card shadow-sm mb-4 filter-card">

        <div class="card-header">

            <h6 class="m-0 fw-bold">
                <i class="fas fa-filter me-2"></i>
                Filter Laporan
            </h6>

        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.reports.index') }}"
                  class="row g-3">

                <!-- DARI TANGGAL -->
                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        Dari Tanggal
                    </label>

                    <input type="date"
                           name="start_date"
                           class="form-control"
                           value="{{ request('start_date') }}">

                </div>

                <!-- SAMPAI TANGGAL -->
                <div class="col-md-3">

                    <label class="form-label fw-semibold">
                        Sampai Tanggal
                    </label>

                    <input type="date"
                           name="end_date"
                           class="form-control"
                           value="{{ request('end_date') }}">

                </div>

                <!-- KATEGORI -->
                <div class="col-md-2">

                    <label class="form-label fw-semibold">
                        Kategori
                    </label>

                    <select name="category" class="form-select">

                        <option value="">Semua</option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- STATUS -->
                <div class="col-md-2">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select name="status" class="form-select">

                        <option value="">Semua</option>

                        <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>
                            Diterima
                        </option>

                        <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>
                            Diproses
                        </option>

                        <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                        <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
                            Ditolak
                        </option>

                    </select>

                </div>

                <!-- PRIORITAS -->
                <div class="col-md-2">

                    <label class="form-label fw-semibold">
                        Prioritas
                    </label>

                    <select name="priority" class="form-select">

                        <option value="">Semua</option>

                        <option value="Rendah" {{ request('priority') == 'Rendah' ? 'selected' : '' }}>
                            Rendah
                        </option>

                        <option value="Sedang" {{ request('priority') == 'Sedang' ? 'selected' : '' }}>
                            Sedang
                        </option>

                        <option value="Tinggi" {{ request('priority') == 'Tinggi' ? 'selected' : '' }}>
                            Tinggi
                        </option>

                    </select>

                </div>

                <!-- BUTTON FILTER -->
                <div class="col-12">

                    <button type="submit" class="btn btn-primary">

                        <i class="fas fa-search me-2"></i>
                        Tampilkan

                    </button>

                    <a href="{{ route('admin.reports.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-undo me-2"></i>
                        Reset

                    </a>

                </div>

            </form>

        </div>

    </div>

    <!-- HASIL LAPORAN -->
    <div class="card report-card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-3">

            <h6 class="m-0 fw-bold">

                <i class="fas fa-file-alt me-2"></i>
                Hasil Laporan ({{ $complaints->count() }} data)

            </h6>

            <!-- EXPORT ACTIONS -->
            <div class="export-actions">

                <a href="{{ route('admin.reports.export-pdf', request()->query()) }}"
                   class="btn btn-sm btn-danger"
                   target="_blank">

                    <i class="fas fa-file-pdf me-2"></i>
                    Export PDF

                </a>

                <a href="{{ route('admin.reports.export-excel', request()->query()) }}"
                   class="btn btn-sm btn-success">

                    <i class="fas fa-file-excel me-2"></i>
                    Export Excel

                </a>

                <button onclick="window.print()"
                        class="btn btn-sm btn-info text-white">

                    <i class="fas fa-print me-2"></i>
                    Cetak

                </button>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover table-bordered align-middle">

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

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $complaint->ticket_number }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $complaint->created_at->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ $complaint->user->name }}
                                </td>

                                <td>
                                    {{ $complaint->category->name }}
                                </td>

                                <td>
                                    {{ $complaint->title }}
                                </td>

                                <!-- PRIORITAS -->
                                <td>

                                    <span class="priority-{{ strtolower($complaint->priority) }}">
                                        {{ $complaint->priority }}
                                    </span>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <span class="status-{{ strtolower($complaint->status) }}">
                                        {{ $complaint->status }}
                                    </span>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8" class="text-center py-4">

                                    <i class="fas fa-inbox fa-2x text-muted d-block mb-2"></i>

                                    <span class="text-muted">
                                        Tidak ada data.
                                    </span>

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
