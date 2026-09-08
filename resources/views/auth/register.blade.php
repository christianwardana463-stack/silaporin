@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card card-login">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h1 class="logo-text">Si<span>Laporin</span></h1>
                        <p class="text-muted">Daftar Akun Baru</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <small>{{ $error }}</small><br>
                            @endforeach
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="kelas" class="form-label fw-semibold">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" value="{{ old('kelas') }}" placeholder="Contoh: XII RPL">
                        </div>

                        <div class="mb-3">
                            <label for="no_hp" class="form-label fw-semibold">No HP</label>
                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="08123456789">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100 text-white">
                            <i class="fas fa-user-plus me-2"></i> Daftar
                        </button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            Sudah punya akun? <a href="{{ route('login') }}" class="text-primary fw-semibold">Login</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection