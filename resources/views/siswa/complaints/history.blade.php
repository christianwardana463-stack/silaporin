@extends('layouts.dashboard')

@section('title', 'Riwayat Pengaduan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Riwayat Pengaduan</h1>
        <a href="{{ route('siswa.complaints.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i> Buat Pengaduan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
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
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $complaint->ticket_number }}</strong></td>
                                <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                                <td>{{ $complaint->category->name }}</td>
                                <td>{{ Str::limit($complaint->title, 30) }}</td>
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
                                <td>
                                    @if($complaint->rating)
                                        <span class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $complaint->rating->rating)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
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
                                    <span class="text-muted">Belum ada pengaduan. Silakan buat pengaduan!</span>
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