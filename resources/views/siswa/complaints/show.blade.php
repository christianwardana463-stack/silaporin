@extends('layouts.dashboard')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Detail Pengaduan</h1>
        <a href="{{ route('siswa.complaints.history') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-ticket-alt me-2"></i> {{ $complaint->ticket_number }}
                        </h6>
                        <span class="badge status-{{ strtolower($complaint->status) }} fs-6">
                            {{ $complaint->status }}
                        </span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Tanggal</small>
                            <p class="fw-semibold">{{ $complaint->created_at->format('d F Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Kategori</small>
                            <p class="fw-semibold">{{ $complaint->category->name }}</p>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <small class="text-muted">Prioritas</small>
                            <p>
                                <span class="badge priority-{{ strtolower($complaint->priority) }}">
                                    {{ $complaint->priority }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Lokasi</small>
                            <p class="fw-semibold">{{ $complaint->location }}</p>
                        </div>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Judul</small>
                        <p class="fw-bold">{{ $complaint->title }}</p>
                    </div>
                    <div class="mb-3">
                        <small class="text-muted">Deskripsi</small>
                        <p class="text-justify">{{ $complaint->description }}</p>
                    </div>
                    @if($complaint->photo)
                        <div class="mb-3">
                            <small class="text-muted">Foto Kerusakan</small>
                            <div>
                                <img src="{{ asset('storage/' . $complaint->photo) }}"
                                     alt="Foto Kerusakan"
                                     class="img-fluid rounded"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    @endif
                    @if($complaint->repair_photo)
                        <div class="mb-3">
                            <small class="text-muted">Foto Hasil Perbaikan</small>
                            <div>
                                <img src="{{ asset('storage/' . $complaint->repair_photo) }}"
                                     alt="Foto Perbaikan"
                                     class="img-fluid rounded"
                                     style="max-height: 300px;">
                            </div>
                        </div>
                    @endif
                    @if($complaint->admin_response)
                        <div class="mb-3">
                            <small class="text-muted">Tanggapan Admin</small>
                            <div class="alert alert-info">
                                {{ $complaint->admin_response }}
                            </div>
                        </div>
                    @endif

                    <!-- QR CODE SECTION -->
                    <div class="text-center mt-4 pt-3 border-top">
                        <small class="text-muted d-block mb-2">Scan QR Code untuk tracking:</small>
                        <div class="d-inline-block p-2 bg-white border rounded">
                            {!! QrCode::size(130)->generate(route('public.track', $complaint->ticket_number)) !!}
                        </div>
                        <div class="mt-2">
                            <small class="text-muted">
                                <i class="fas fa-link me-1"></i>
                                {{ route('public.track', $complaint->ticket_number) }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Riwayat Status -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-history me-2"></i> Riwayat Status
                    </h6>
                </div>
                <div class="card-body">
                    @forelse($complaint->histories as $history)
                        <div class="d-flex mb-3">
                            <div class="me-3">
                                <span class="badge status-{{ strtolower($history->status) }} p-2">
                                    {{ $history->status }}
                                </span>
                            </div>
                            <div>
                                <small class="text-muted d-block">
                                    {{ $history->created_at->format('d/m/Y H:i') }}
                                </small>
                                <small>{{ $history->note }}</small>
                                <small class="text-muted d-block">
                                    oleh: {{ $history->changer->name ?? 'Sistem' }}
                                </small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">Belum ada riwayat.</p>
                    @endforelse
                </div>
            </div>

            <!-- Rating -->
            @if($complaint->status == 'Selesai')
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-star me-2"></i> Beri Rating
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($complaint->rating)
                            <div class="text-center">
                                <div class="text-warning fs-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $complaint->rating->rating)
                                            ★
                                        @else
                                            ☆
                                        @endif
                                    @endfor
                                </div>
                                <p class="text-muted mt-2">{{ $complaint->rating->comment ?? 'Tidak ada komentar' }}</p>
                            </div>
                        @else
                            <form action="{{ route('siswa.complaints.rate', $complaint->id) }}" method="POST">
                                @csrf
                                <div class="mb-3 text-center">
                                    <label class="form-label fw-semibold">Rating</label>
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" required>
                                                <label class="form-check-label" for="star{{ $i }}">
                                                    @for($j = 1; $j <= $i; $j++)
                                                        ★
                                                    @endfor
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="2"
                                              placeholder="Bagaimana pelayanan kami?"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Rating
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection