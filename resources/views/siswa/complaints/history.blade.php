
@extends('layouts.dashboard')

@section('title', 'Riwayat Pengaduan')

@push('styles')
<style>
    /* =====================================
       RIWAYAT PENGADUAN - THEME SUPPORT
    ===================================== */

    .complaints-history {
        color: var(--text-dark);
    }

    /* JUDUL */
    .complaints-history h1 {
        color: var(--text-dark) !important;
        font-weight: 700;
    }

    /* CARD */
    .complaints-history .history-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }

    .complaints-history .card-body {
        background: var(--bg-card);
        padding: 20px;
    }

    /* TABEL LIGHT MODE */
    .complaints-history .table {
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

    .complaints-history .table th {
        background: #F8FAFC !important;
        color: #475569 !important;
        font-weight: 700;
        font-size: 13px;
        padding: 15px 12px;
        white-space: nowrap;
        border-color: #E5E7EB !important;
    }

    .complaints-history .table td {
        background: #FFFFFF;
        color: #1F2937 !important;
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #E5E7EB !important;
    }

    .complaints-history .table-hover tbody tr:hover td {
        background: #F1F5F9 !important;
        color: #1F2937 !important;
    }

    /* =====================================
       DARK MODE TABLE
    ===================================== */

    [data-theme="dark"] .complaints-history .history-card,
    [data-theme="dark"] .complaints-history .card-body {
        background: #1E293B !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .complaints-history .table {
        --bs-table-color: #F1F5F9;
        --bs-table-bg: #1E293B;
        --bs-table-border-color: #334155;
        --bs-table-hover-color: #FFFFFF;
        --bs-table-hover-bg: #334155;

        color: #F1F5F9 !important;
        background: #1E293B !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .complaints-history .table thead th {
        background: #334155 !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .complaints-history .table tbody td {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .complaints-history .table-hover tbody tr:hover td {
        background: #334155 !important;
        color: #FFFFFF !important;
    }

    [data-theme="dark"] .complaints-history h1 {
        color: #F1F5F9 !important;
    }

    /* =====================================
       STATUS BADGES
    ===================================== */

    .complaints-history .badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        white-space: nowrap;
    }

    /* DITERIMA - BIRU */
    .complaints-history .status-diterima {
        background: #DBEAFE !important;
        color: #1D4ED8 !important;
    }

    /* DIPROSES - KUNING */
    .complaints-history .status-diproses {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    /* SELESAI - HIJAU */
    .complaints-history .status-selesai {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    /* DITOLAK - MERAH */
    .complaints-history .status-ditolak {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* =====================================
       PRIORITY BADGES
    ===================================== */

    .complaints-history .priority-rendah {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .complaints-history .priority-sedang {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .complaints-history .priority-tinggi {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* =====================================
       RATING
    ===================================== */

    .complaints-history .rating-stars {
        color: #F59E0B !important;
        font-size: 18px;
        letter-spacing: 1px;
        white-space: nowrap;
    }

    .complaints-history .rating-empty {
        color: #94A3B8 !important;
    }

    /* =====================================
       BUTTON
    ===================================== */

    .complaints-history .btn-info {
        background: #06B6D4;
        border-color: #06B6D4;
        color: #FFFFFF !important;
    }

    .complaints-history .btn-info:hover {
        background: #0891B2;
        border-color: #0891B2;
        color: #FFFFFF !important;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .complaints-history h1 {
            font-size: 21px;
        }

        .complaints-history .card-body {
            padding: 12px;
        }

        .complaints-history .table {
            min-width: 950px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid complaints-history">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3 mb-0">
            Riwayat Pengaduan
        </h1>

        <a href="{{ route('siswa.complaints.create') }}"
           class="btn btn-primary rounded-pill px-3">

            <i class="fas fa-plus-circle me-2"></i>
            Buat Pengaduan

        </a>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <!-- HISTORY TABLE -->
    <div class="card history-card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No. Tiket</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Rating</th>
                            <th>Aksi</th>
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
                                    {{ $complaint->category->name }}
                                </td>

                                <td>
                                    {{ Str::limit($complaint->title, 30) }}
                                </td>

                                <!-- PRIORITAS -->
                                <td>
                                    <span class="badge priority-{{ strtolower($complaint->priority) }}">
                                        {{ $complaint->priority }}
                                    </span>
                                </td>

                                <!-- STATUS -->
                                <td>
                                    <span class="badge status-{{ strtolower($complaint->status) }}">
                                        {{ $complaint->status }}
                                    </span>
                                </td>

                                <!-- RATING -->
                                <td>

                                    @if($complaint->rating)

                                        <span class="rating-stars">
                                            @for($i = 1; $i <= 5; $i++)

                                                @if($i <= $complaint->rating->rating)
                                                    ★
                                                @else
                                                    ☆
                                                @endif

                                            @endfor
                                        </span>

                                    @else

                                        <span class="rating-empty">
                                            -
                                        </span>

                                    @endif

                                </td>

                                <!-- AKSI -->
                                <td>

                                    <a href="{{ route('siswa.complaints.show', $complaint->id) }}"
                                       class="btn btn-sm btn-info">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center py-4">

                                    <i class="fas fa-inbox fa-2x text-muted d-block mb-2"></i>

                                    <span class="text-muted">
                                        Belum ada pengaduan. Silakan buat pengaduan!
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
