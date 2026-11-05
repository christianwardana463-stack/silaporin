
@extends('layouts.dashboard')

@section('title', 'Kelola Pengaduan')

@push('styles')
<style>
    /* =========================================
       KELOLA PENGADUAN - LIGHT MODE
    ========================================= */

    .complaint-admin-page {
        color: var(--text-dark);
    }

    .complaint-admin-page h1 {
        color: var(--text-dark) !important;
        font-weight: 700;
    }

    .complaint-admin-page .complaint-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }

    .complaint-admin-page .card-body {
        background: var(--bg-card);
        padding: 20px;
    }

    /* FORM FILTER */
    .complaint-admin-page .form-control,
    .complaint-admin-page .form-select {
        background-color: #FFFFFF;
        color: #1F2937;
        border: 1px solid #CBD5E1;
        border-radius: 9px;
        padding: 10px 12px;
    }

    .complaint-admin-page .form-control::placeholder {
        color: #94A3B8;
    }

    .complaint-admin-page .form-control:focus,
    .complaint-admin-page .form-select:focus {
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59,130,246,.15);
    }

    /* TABLE */
    .complaint-admin-page .table {
        --bs-table-color: #1F2937;
        --bs-table-bg: #FFFFFF;
        --bs-table-border-color: #E5E7EB;
        --bs-table-hover-color: #1F2937;
        --bs-table-hover-bg: #F1F5F9;

        color: #1F2937;
        background: #FFFFFF;
        margin-bottom: 0;
    }

    .complaint-admin-page .table thead th {
        background: #F1F5F9 !important;
        color: #475569 !important;
        font-size: 13px;
        font-weight: 700;
        padding: 15px 12px;
        white-space: nowrap;
        border-color: #E5E7EB !important;
    }

    .complaint-admin-page .table tbody td {
        background: #FFFFFF;
        color: #1F2937 !important;
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #E5E7EB !important;
    }

    .complaint-admin-page .table-hover tbody tr:hover td {
        background: #F1F5F9 !important;
        color: #1F2937 !important;
    }

    /* =========================================
       DARK MODE
    ========================================= */

    [data-theme="dark"] .complaint-admin-page h1 {
        color: #F1F5F9 !important;
    }

    [data-theme="dark"] .complaint-admin-page .complaint-card,
    [data-theme="dark"] .complaint-admin-page .card-body {
        background: #1E293B !important;
        border-color: #334155 !important;
    }

    /* FORM DARK MODE */
    [data-theme="dark"] .complaint-admin-page .form-control,
    [data-theme="dark"] .complaint-admin-page .form-select {
        background-color: #0F172A !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .complaint-admin-page .form-control::placeholder {
        color: #94A3B8 !important;
    }

    [data-theme="dark"] .complaint-admin-page .form-select option {
        background: #1E293B;
        color: #F1F5F9;
    }

    [data-theme="dark"] .complaint-admin-page .form-control:focus,
    [data-theme="dark"] .complaint-admin-page .form-select:focus {
        border-color: #3B82F6 !important;
        box-shadow: 0 0 0 3px rgba(59,130,246,.2) !important;
    }

    /* TABLE DARK MODE */
    [data-theme="dark"] .complaint-admin-page .table {
        --bs-table-color: #F1F5F9;
        --bs-table-bg: #1E293B;
        --bs-table-border-color: #475569;
        --bs-table-hover-color: #FFFFFF;
        --bs-table-hover-bg: #334155;

        color: #F1F5F9 !important;
        background: #1E293B !important;
    }

    [data-theme="dark"] .complaint-admin-page .table thead th {
        background: #334155 !important;
        color: #CBD5E1 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .complaint-admin-page .table tbody td {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .complaint-admin-page .table-hover tbody tr:hover td {
        background: #334155 !important;
        color: #FFFFFF !important;
    }

    /* =========================================
       STATUS BADGES
    ========================================= */

    .complaint-admin-page .status-diterima,
    .complaint-admin-page .status-diproses,
    .complaint-admin-page .status-selesai,
    .complaint-admin-page .status-ditolak {
        display: inline-block !important;
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        white-space: nowrap;
    }

    .complaint-admin-page .status-diterima {
        background: #DBEAFE !important;
        color: #1D4ED8 !important;
    }

    .complaint-admin-page .status-diproses {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .complaint-admin-page .status-selesai {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .complaint-admin-page .status-ditolak {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* =========================================
       PRIORITY BADGES
    ========================================= */

    .complaint-admin-page .priority-rendah,
    .complaint-admin-page .priority-sedang,
    .complaint-admin-page .priority-tinggi {
        display: inline-block !important;
        padding: 6px 12px !important;
        border-radius: 20px !important;
        font-size: 11px !important;
        font-weight: 700 !important;
        white-space: nowrap;
    }

    .complaint-admin-page .priority-rendah {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .complaint-admin-page .priority-sedang {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .complaint-admin-page .priority-tinggi {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* TOTAL BADGE */
    .complaint-admin-page .total-badge {
        background: #DBEAFE !important;
        color: #1D4ED8 !important;
        padding: 8px 14px;
        border-radius: 20px;
        font-weight: 700;
    }

    /* PAGINATION */
    .complaint-admin-page .pagination {
        gap: 4px;
    }

    .complaint-admin-page .page-link {
        border-radius: 7px !important;
        color: #2563EB;
    }

    [data-theme="dark"] .complaint-admin-page .page-link {
        background: #1E293B;
        color: #CBD5E1;
        border-color: #475569;
    }

    [data-theme="dark"] .complaint-admin-page .page-item.active .page-link {
        background: #2563EB !important;
        color: #FFFFFF !important;
        border-color: #2563EB !important;
    }

    [data-theme="dark"] .complaint-admin-page .page-item.disabled .page-link {
        background: #0F172A;
        color: #64748B;
        border-color: #334155;
    }

    /* BUTTON */
    .complaint-admin-page .btn {
        transition: all .2s ease;
    }

    .complaint-admin-page .btn:hover {
        transform: translateY(-1px);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .complaint-admin-page h1 {
            font-size: 21px;
        }

        .complaint-admin-page .card-body {
            padding: 12px;
        }

        .complaint-admin-page .table {
            min-width: 950px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid complaint-admin-page">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3 mb-0">
            Kelola Pengaduan
        </h1>

        <span class="total-badge">
            Total: {{ $complaints->total() }}
        </span>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <!-- FILTER -->
    <div class="card complaint-card shadow-sm mb-4">

        <div class="card-body">

            <form method="GET"
                  action="{{ route('admin.complaints.index') }}"
                  class="row g-3">

                <!-- SEARCH -->
                <div class="col-md-3">

                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Cari tiket/judul..."
                           value="{{ request('search') }}">

                </div>

                <!-- STATUS -->
                <div class="col-md-2">

                    <select name="status" class="form-select">

                        <option value="">Semua Status</option>

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

                    <select name="priority" class="form-select">

                        <option value="">Semua Prioritas</option>

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

                <!-- KATEGORI -->
                <div class="col-md-2">

                    <select name="category" class="form-select">

                        <option value="">Semua Kategori</option>

                        @foreach($categories as $category)

                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- ACTION FILTER -->
                <div class="col-md-3">

                    <button type="submit" class="btn btn-primary">

                        <i class="fas fa-search me-2"></i>
                        Filter

                    </button>

                    <a href="{{ route('admin.complaints.index') }}"
                       class="btn btn-secondary">

                        <i class="fas fa-undo me-2"></i>
                        Reset

                    </a>

                </div>

            </form>

        </div>

    </div>

    <!-- TABEL PENGADUAN -->
    <div class="card complaint-card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Tiket</th>
                            <th>Pelapor</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($complaints as $index => $complaint)

                            <tr>

                                <td>
                                    {{ $complaints->firstItem() + $index }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $complaint->ticket_number }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $complaint->user->name }}
                                </td>

                                <td>
                                    {{ $complaint->category->name }}
                                </td>

                                <td>
                                    {{ Str::limit($complaint->title, 30) }}
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

                                <td>
                                    {{ $complaint->created_at->format('d/m/Y') }}
                                </td>

                                <!-- AKSI -->
                                <td>

                                    <a href="{{ route('admin.complaints.show', $complaint->id) }}"
                                       class="btn btn-sm btn-info text-white"
                                       title="Lihat Detail">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center py-4">

                                    <i class="fas fa-inbox fa-2x text-muted d-block mb-2"></i>

                                    <span class="text-muted">
                                        Belum ada pengaduan.
                                    </span>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- PAGINATION -->
            <div class="d-flex justify-content-end mt-3">

                {{ $complaints->links() }}

            </div>

        </div>

    </div>

</div>

@endsection
