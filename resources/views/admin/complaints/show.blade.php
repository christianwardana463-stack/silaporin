
@extends('layouts.dashboard')

@section('title', 'Detail Pengaduan')

@push('styles')
<style>
    /* =====================================
       DETAIL PENGADUAN - THEME SUPPORT
    ===================================== */

    .complaint-detail {
        color: var(--text-dark);
    }

    .complaint-detail .card {
        background: var(--bg-card);
        color: var(--text-dark);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
    }

    .complaint-detail .card-header {
        background: var(--bg-card);
        color: var(--text-dark);
        border-bottom: 1px solid var(--border);
        padding: 15px 20px;
    }

    .complaint-detail .card-body {
        background: var(--bg-card);
        color: var(--text-dark);
    }

    .complaint-detail h1,
    .complaint-detail h6,
    .complaint-detail p,
    .complaint-detail label {
        color: var(--text-dark);
    }

    .complaint-detail .text-muted {
        color: var(--text-muted, #64748b) !important;
    }

    .complaint-detail .form-control,
    .complaint-detail .form-select {
        background-color: var(--bg-input, var(--bg-card));
        color: var(--text-dark);
        border-color: var(--border);
    }

    .complaint-detail .form-control:focus,
    .complaint-detail .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(220, 38, 38, 0.15);
    }

    /* =====================================
       STATUS BADGES
    ===================================== */

    .complaint-detail .status-diterima,
    .complaint-detail .status-diproses,
    .complaint-detail .status-selesai,
    .complaint-detail .status-ditolak {
        display: inline-block !important;
        padding: 7px 14px !important;
        border-radius: 20px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        white-space: nowrap;
        opacity: 1 !important;
        border: none !important;
    }

    .complaint-detail .status-diterima {
        background: #DBEAFE !important;
        color: #1D4ED8 !important;
    }

    .complaint-detail .status-diproses {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .complaint-detail .status-selesai {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .complaint-detail .status-ditolak {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* =====================================
       PRIORITY BADGES
    ===================================== */

    .complaint-detail .priority-rendah,
    .complaint-detail .priority-sedang,
    .complaint-detail .priority-tinggi {
        display: inline-block;
        padding: 7px 13px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }

    .complaint-detail .priority-rendah {
        background: #D1FAE5 !important;
        color: #065F46 !important;
    }

    .complaint-detail .priority-sedang {
        background: #FEF3C7 !important;
        color: #92400E !important;
    }

    .complaint-detail .priority-tinggi {
        background: #FEE2E2 !important;
        color: #991B1B !important;
    }

    /* =====================================
       ALERT
    ===================================== */

    .complaint-detail .alert {
        border-radius: 10px;
    }

    /* =====================================
       DARK MODE
    ===================================== */

    [data-theme="dark"] .complaint-detail .card,
    [data-theme="dark"] .complaint-detail .card-header,
    [data-theme="dark"] .complaint-detail .card-body {
        background: #1E293B !important;
        color: #F1F5F9 !important;
        border-color: #334155 !important;
    }

    [data-theme="dark"] .complaint-detail h1,
    [data-theme="dark"] .complaint-detail h6,
    [data-theme="dark"] .complaint-detail p,
    [data-theme="dark"] .complaint-detail label,
    [data-theme="dark"] .complaint-detail small:not(.text-muted) {
        color: #F1F5F9;
    }

    [data-theme="dark"] .complaint-detail .text-muted {
        color: #94A3B8 !important;
    }

    [data-theme="dark"] .complaint-detail .form-control,
    [data-theme="dark"] .complaint-detail .form-select {
        background-color: #0F172A !important;
        color: #F1F5F9 !important;
        border-color: #475569 !important;
    }

    [data-theme="dark"] .complaint-detail .form-select option {
        background: #1E293B;
        color: #F1F5F9;
    }

    [data-theme="dark"] .complaint-detail .form-control::placeholder {
        color: #94A3B8;
    }

    /* QR CODE */
    .complaint-detail .qr-container {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 10px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .complaint-detail h1 {
            font-size: 21px;
        }

        .complaint-detail .card-header,
        .complaint-detail .card-body {
            padding: 14px;
        }
    }
</style>
@endpush

@section('content')

<div class="container-fluid complaint-detail">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Detail Pengaduan</h1>

        <a href="{{ route('admin.complaints.index') }}"
           class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            Ada kesalahan:
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">

        <!-- INFORMASI PENGADUAN -->
        <div class="col-md-7">

            <div class="card shadow mb-4">

                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">

                        <h6 class="m-0 fw-bold text-primary">
                            <i class="fas fa-ticket-alt me-2"></i>
                            {{ $complaint->ticket_number }}
                        </h6>

                        <span class="status-{{ strtolower($complaint->status) }}">
                            {{ $complaint->status }}
                        </span>

                    </div>
                </div>

                <div class="card-body">

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <small class="text-muted">Pelapor</small>
                            <p class="fw-semibold">{{ $complaint->user->name }}</p>

                            <small class="text-muted">Kelas</small>
                            <p class="fw-semibold">
                                {{ $complaint->user->kelas ?? '-' }}
                            </p>
                        </div>

                        <div class="col-md-6">
                            <small class="text-muted">Tanggal</small>
                            <p class="fw-semibold">
                                {{ $complaint->created_at->format('d F Y H:i') }}
                            </p>

                            <small class="text-muted">Kategori</small>
                            <p class="fw-semibold">
                                {{ $complaint->category->name }}
                            </p>
                        </div>

                    </div>

                    <div class="row mb-3">

                        <div class="col-md-6">
                            <small class="text-muted">Prioritas</small>
                            <p>
                                <span class="priority-{{ strtolower($complaint->priority) }}">
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
                        <p>{{ $complaint->description }}</p>
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

                    <!-- RATING -->
                    @if($complaint->rating)
                        <div class="mb-3">
                            <small class="text-muted">Rating dari Siswa</small>

                            <div class="alert alert-warning">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="text-warning fs-3">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $complaint->rating->rating)
                                                    ★
                                                @else
                                                    ☆
                                                @endif
                                            @endfor
                                        </span>
                                    </div>

                                    <div>
                                        <strong>
                                            {{ $complaint->rating->rating }}/5
                                        </strong>
                                        <br>

                                        <small class="text-muted">
                                            {{ $complaint->rating->comment ?? 'Tidak ada komentar' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @elseif($complaint->status == 'Selesai')

                        <div class="mb-3">
                            <small class="text-muted">Rating dari Siswa</small>
                            <div class="alert alert-secondary">
                                <i class="fas fa-clock me-2"></i>
                                Siswa belum memberikan rating.
                            </div>
                        </div>

                    @endif

                    <!-- QR CODE -->
                    <div class="text-center mt-4 pt-3 border-top">

                        <small class="text-muted d-block mb-2">
                            Scan QR Code untuk tracking pengaduan:
                        </small>

                        <div class="d-inline-block p-3 qr-container">
                            {!! QrCode::size(150)->generate(route('public.track', $complaint->ticket_number)) !!}
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

        <!-- KELOLA PENGADUAN -->
        <div class="col-md-5">

            <div class="card shadow mb-4">

                <div class="card-header">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-cog me-2"></i>
                        Kelola Pengaduan
                    </h6>
                </div>

                <div class="card-body">

                    <form action="{{ route('admin.complaints.update', $complaint->id) }}"
                          method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">
                                Status
                            </label>

                            <select class="form-select" id="status" name="status">
                                <option value="Diterima" {{ $complaint->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Diproses" {{ $complaint->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $complaint->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak" {{ $complaint->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label fw-semibold">
                                Prioritas
                            </label>

                            <select class="form-select" id="priority" name="priority">
                                <option value="Rendah" {{ $complaint->priority == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ $complaint->priority == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ $complaint->priority == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_response" class="form-label fw-semibold">
                                Tanggapan Admin
                            </label>

                            <textarea class="form-control"
                                      id="admin_response"
                                      name="admin_response"
                                      rows="3">{{ $complaint->admin_response }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="repair_photo" class="form-label fw-semibold">
                                Foto Hasil Perbaikan

                                <span class="text-danger"
                                      id="repair_photo_required_mark"
                                      style="display: none;">*</span>
                            </label>

                            <input type="file"
                                   class="form-control @error('repair_photo') is-invalid @enderror"
                                   id="repair_photo"
                                   name="repair_photo"
                                   accept="image/*">

                            <small class="text-muted">
                                Format: JPG, PNG. Maks: 2MB.

                                <span id="repair_photo_info"
                                      class="text-danger fw-bold"
                                      style="display: none;">
                                    (Wajib diunggah jika status diubah menjadi Selesai!)
                                </span>
                            </small>

                            @error('repair_photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i>
                            Simpan Perubahan
                        </button>

                    </form>

                </div>
            </div>

            <!-- RIWAYAT STATUS -->
            <div class="card shadow">

                <div class="card-header">
                    <h6 class="m-0 fw-bold text-primary">
                        <i class="fas fa-history me-2"></i>
                        Riwayat Status
                    </h6>
                </div>

                <div class="card-body">

                    @forelse($complaint->histories as $history)

                        <div class="d-flex mb-3">

                            <div class="me-3">
                                <span class="status-{{ strtolower($history->status) }}">
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

        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {

    const statusSelect = document.getElementById('status');
    const requiredMark = document.getElementById('repair_photo_required_mark');
    const photoInfo = document.getElementById('repair_photo_info');

    if (statusSelect && requiredMark && photoInfo) {

        function updateRepairPhotoRequirement() {
            if (statusSelect.value === 'Selesai') {
                requiredMark.style.display = 'inline';
                photoInfo.style.display = 'inline';
            } else {
                requiredMark.style.display = 'none';
                photoInfo.style.display = 'none';
            }
        }

        statusSelect.addEventListener('change', updateRepairPhotoRequirement);
        updateRepairPhotoRequirement();
    }

});
</script>
@endpush
