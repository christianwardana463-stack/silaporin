
@extends('layouts.dashboard')

@section('title', 'Kelola Pengguna')

@push('styles')
<style>
    /* =================================
       KELOLA PENGGUNA
    ================================= */

    .users-page h1 {
        color: var(--text-dark, #1F2937) !important;
        font-weight: 700;
    }

    .users-page .users-card {
        background: var(--bg-card, #FFFFFF);
        border: 1px solid var(--border, #E5E7EB);
        border-radius: 16px;
        overflow: hidden;
    }

    .users-page .card-body {
        padding: 20px;
        background: var(--bg-card, #FFFFFF);
    }

    /* TABLE LIGHT MODE */
    .users-page .table {
        --bs-table-color: #1F2937;
        --bs-table-bg: #FFFFFF;
        --bs-table-border-color: #E5E7EB;
        --bs-table-hover-color: #1F2937;
        --bs-table-hover-bg: #F1F5F9;

        color: #1F2937;
        background: #FFFFFF;
        margin-bottom: 0;
    }

    .users-page .table thead th {
        background: #F1F5F9 !important;
        color: #475569 !important;
        font-weight: 700;
        padding: 15px 12px;
        white-space: nowrap;
        border-color: #E2E8F0 !important;
    }

    .users-page .table tbody td {
        background: #FFFFFF;
        color: #1F2937 !important;
        padding: 14px 12px;
        vertical-align: middle;
        border-color: #E5E7EB !important;
    }

    .users-page .table-hover tbody tr:hover td {
        background: #F1F5F9 !important;
        color: #1F2937 !important;
    }

    /* =================================
       DARK MODE
    ================================= */

    [data-theme="dark"] .users-page h1 {
        color: #F1F5F9 !important;
    }

    [data-theme="dark"] .users-page .users-card,
    [data-theme="dark"] .users-page .card-body {
        background: #1E293B !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .users-page .table {
        --bs-table-color: #F1F5F9;
        --bs-table-bg: #1E293B;
        --bs-table-border-color: #475569;
        --bs-table-hover-color: #FFFFFF;
        --bs-table-hover-bg: #334155;

        color: #F1F5F9 !important;
        background: #1E293B !important;
    }

    [data-theme="dark"] .users-page .table thead th {
        background: #334155 !important;
        color: #E2E8F0 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .users-page .table tbody td {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .users-page .table-hover tbody tr:hover td {
        background: #334155 !important;
        color: #FFFFFF !important;
    }

    /* BADGE */
    .users-page .badge {
        padding: 7px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 11px;
    }

    /* ALERT */
    [data-theme="dark"] .users-page .alert {
        border: 1px solid transparent;
    }

    [data-theme="dark"] .users-page .alert-success {
        background: #064E3B;
        color: #D1FAE5;
        border-color: #047857;
    }

    [data-theme="dark"] .users-page .alert-danger {
        background: #7F1D1D;
        color: #FEE2E2;
        border-color: #B91C1C;
    }

    /* BUTTON */
    .users-page .btn {
        transition: all .2s ease;
    }

    .users-page .btn:hover {
        transform: translateY(-1px);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .users-page h1 {
            font-size: 21px;
        }

        .users-page .card-body {
            padding: 12px;
        }

        .users-page .table {
            min-width: 750px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid users-page">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h1 class="h3 mb-0">
            Kelola Pengguna
        </h1>

        <a href="{{ route('admin.users.create') }}"
           class="btn btn-primary">

            <i class="fas fa-plus-circle me-2"></i>
            Tambah Pengguna

        </a>

    </div>

    <!-- ALERT SUCCESS -->
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

    <!-- ALERT ERROR -->
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

    <!-- TABLE PENGGUNA -->
    <div class="card users-card shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Kelas</th>
                            <th>No HP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $index => $user)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $user->name }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $user->email }}
                                </td>

                                <td>

                                    <span class="badge {{ $user->role == 'Admin' ? 'bg-danger' : 'bg-primary' }}">
                                        {{ $user->role }}
                                    </span>

                                </td>

                                <td>
                                    {{ $user->kelas ?? '-' }}
                                </td>

                                <td>
                                    {{ $user->no_hp ?? '-' }}
                                </td>

                                <td>

                                    <a href="{{ route('admin.users.edit', $user->id) }}"
                                       class="btn btn-sm btn-warning">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    @if($user->id != auth()->id())

                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-danger">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-4">

                                    <i class="fas fa-users fa-2x text-muted d-block mb-2"></i>

                                    <span class="text-muted">
                                        Belum ada pengguna.
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
