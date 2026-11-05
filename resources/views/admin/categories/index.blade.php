
@extends('layouts.dashboard')

@section('title', 'Kelola Kategori')

@push('styles')
<style>
    /* =====================================
       KELOLA KATEGORI - LIGHT MODE
    ===================================== */

    .category-page {
        color: var(--text-dark);
    }

    .category-page h1 {
        color: var(--text-dark) !important;
        font-weight: 700;
    }

    .category-page .category-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
    }

    .category-page .card-body {
        background: var(--bg-card);
        padding: 20px;
    }

    .category-page .table {
        --bs-table-color: #1F2937;
        --bs-table-bg: #FFFFFF;
        --bs-table-border-color: #E5E7EB;
        --bs-table-hover-color: #1F2937;
        --bs-table-hover-bg: #F1F5F9;

        color: #1F2937;
        background: #FFFFFF;
        margin-bottom: 0;
    }

    .category-page .table thead th {
        background: #F8FAFC !important;
        color: #475569 !important;
        font-size: 13px;
        font-weight: 700;
        padding: 15px 12px;
        border-color: #E5E7EB !important;
        white-space: nowrap;
    }

    .category-page .table tbody td {
        background: #FFFFFF;
        color: #1F2937 !important;
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #E5E7EB !important;
    }

    .category-page .table-hover tbody tr:hover td {
        background: #F1F5F9 !important;
        color: #1F2937 !important;
    }

    /* =====================================
       DARK MODE
    ===================================== */

    [data-theme="dark"] .category-page .category-card,
    [data-theme="dark"] .category-page .card-body {
        background: #1E293B !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .category-page h1 {
        color: #F1F5F9 !important;
    }

    [data-theme="dark"] .category-page .table {
        --bs-table-color: #F1F5F9;
        --bs-table-bg: #1E293B;
        --bs-table-border-color: #475569;
        --bs-table-hover-color: #FFFFFF;
        --bs-table-hover-bg: #334155;

        color: #F1F5F9 !important;
        background: #1E293B !important;
    }

    [data-theme="dark"] .category-page .table thead th {
        background: #334155 !important;
        color: #CBD5E1 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .category-page .table tbody td {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .category-page .table-hover tbody tr:hover td {
        background: #334155 !important;
        color: #FFFFFF !important;
    }

    /* BADGE JUMLAH PENGADUAN */
    .category-page .badge.bg-info {
        background: #CFFAFE !important;
        color: #0E7490 !important;
        padding: 7px 12px;
        border-radius: 20px;
        font-weight: 700;
    }

    /* BUTTON */
    .category-page .btn {
        transition: all .2s ease;
    }

    .category-page .btn-warning {
        color: #1F2937 !important;
    }

    .category-page .btn-info {
        color: #FFFFFF !important;
    }

    .category-page .btn-danger {
        color: #FFFFFF !important;
    }

    .category-page .btn:hover {
        transform: translateY(-1px);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .category-page h1 {
            font-size: 21px;
        }

        .category-page .card-body {
            padding: 12px;
        }

        .category-page .table {
            min-width: 650px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid category-page">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3 mb-0">
            Kelola Kategori Sarana
        </h1>

        <a href="{{ route('admin.categories.create') }}"
           class="btn btn-primary rounded-pill px-3">

            <i class="fas fa-plus-circle me-2"></i>
            Tambah Kategori

        </a>

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

    <!-- ERROR MESSAGE -->
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif

    <!-- CATEGORY TABLE -->
    <div class="card category-card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th>Total Pengaduan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($categories as $index => $category)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $category->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $category->description ?? '-' }}
                                </td>

                                <td>
                                    <span class="badge bg-info">
                                        {{ $category->complaints()->count() }}
                                    </span>
                                </td>

                                <td>

                                    <a href="{{ route('admin.categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-warning"
                                       title="Edit Kategori">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus Kategori">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5" class="text-center py-4">

                                    <i class="fas fa-inbox fa-2x text-muted d-block mb-2"></i>

                                    <span class="text-muted">
                                        Belum ada kategori. Silakan tambahkan!
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
