@extends('layouts.dashboard')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Siswa</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Selamat Datang, {{ Auth::user()->name }}!</h6>
                </div>
                <div class="card-body">
                    <p>Silakan buat pengaduan jika menemukan kerusakan sarana sekolah.</p>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i> Buat Pengaduan
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection