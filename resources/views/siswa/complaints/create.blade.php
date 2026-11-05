@extends('layouts.dashboard')

@section('title', 'Buat Pengaduan')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Buat Pengaduan Baru</h1>
        <a href="{{ route('dashboard.siswa') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> Ada kesalahan dalam form:
            <ul class="mb-0 mt-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('siswa.complaints.store') }}" method="POST" enctype="multipart/form-data" id="form-pengaduan">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label fw-semibold">Judul Pengaduan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title') }}"
                           placeholder="Contoh: AC Ruang Kelas X IPA Rusak" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label fw-semibold">Kategori Tempat <span class="text-danger">*</span></label>
                    <select class="form-select @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label fw-semibold">Lokasi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror"
                           id="location" name="location" value="{{ old('location') }}"
                           placeholder="Contoh: Gedung Utama Lantai 2, Ruang 205">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-semibold">Deskripsi Kerusakan <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description" rows="5"
                              placeholder="Jelaskan secara detail kerusakan yang terjadi...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="photo" class="form-label fw-semibold">
                        Foto Kerusakan <span class="text-danger">*</span>
                    </label>
                    <input type="file" class="form-control @error('photo') is-invalid @enderror"
                           id="photo" name="photo" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, JPEG. Maks: 2MB. <b>(Wajib diisi)</b></small>
                    @error('photo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('dashboard.siswa') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary" id="btn-submit">
                        <span id="btn-text"><i class="fas fa-paper-plane me-2"></i> Kirim Pengaduan</span>
                        <span id="btn-loading" style="display: none;">
                            <i class="fas fa-spinner fa-spin me-2"></i> Mengirim...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Animasi Loading saat tombol submit diklik
    document.getElementById('form-pengaduan').addEventListener('submit', function() {
        document.getElementById('btn-text').style.display = 'none';
        document.getElementById('btn-loading').style.display = 'inline-block';
        document.getElementById('btn-submit').disabled = true;
    });
</script>
@endpush