@extends('layouts.dashboard')

@section('title', 'Detail Pengaduan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Detail Pengaduan</h1>
        <a href="{{ route('admin.complaints.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-7">
            <!-- Informasi Pengaduan -->
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
                            <small class="text-muted">Pelapor</small>
                            <p class="fw-semibold">{{ $complaint->user->name }}</p>
                            <small class="text-muted">Kelas</small>
                            <p class="fw-semibold">{{ $complaint->user->kelas ?? '-' }}</p>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted">Tanggal</small>
                            <p class="fw-semibold">{{ $complaint->created_at->format('d F Y H:i') }}</p>
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

                    <!-- ========================================================== -->
                    <!-- SECTION RATING DARI SISWA -->
                    <!-- ========================================================== -->
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
                                        <strong>{{ $complaint->rating->rating }}/5</strong>
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
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <!-- Form Admin -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cog me-2"></i> Kelola Pengaduan
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.complaints.update', $complaint->id) }}"
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="Diterima" {{ $complaint->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Diproses" {{ $complaint->status == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ $complaint->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Ditolak" {{ $complaint->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label fw-semibold">Prioritas</label>
                            <select class="form-select" id="priority" name="priority">
                                <option value="Rendah" {{ $complaint->priority == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ $complaint->priority == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ $complaint->priority == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="admin_response" class="form-label fw-semibold">Tanggapan Admin</label>
                            <textarea class="form-control" id="admin_response"
                                      name="admin_response" rows="3">{{ $complaint->admin_response }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="repair_photo" class="form-label fw-semibold">Foto Hasil Perbaikan</label>
                            <input type="file" class="form-control" id="repair_photo"
                                   name="repair_photo" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, JPEG. Maks: 2MB</small>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Riwayat Status -->
            <div class="card shadow">
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
        </div>
    </div>
</div>
@endsection