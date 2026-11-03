<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiLaporin - Daftar Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { margin: 0; padding: 0; background: #0F172A; }
        .register-container { display: flex; min-height: 100vh; }
        
        /* === KIRI (FOTO & BENEFITS) === */
        .register-left {
            flex: 1; 
            background: #1F2937;
            padding: 60px; 
            color: white; 
            position: relative; 
            overflow: hidden;
            display: flex; 
            flex-direction: column; 
            justify-content: space-between;
        }

        .register-left::before {
            content: ''; 
            position: absolute; 
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('https://www.smkn5surakarta.sch.id/wp-content/uploads/2023/02/smkn5solodepan.jpg'); 
            background-size: cover; 
            background-position: center; 
            z-index: 1;
            box-shadow: inset 0 0 0 2000px rgba(15, 23, 42, 0.65); 
        }

        .register-left > * { 
            position: relative; 
            z-index: 2; 
            text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
        }

        /* LIST BENEFITS */
        .benefits-list { margin: 40px 0; }
        .benefit-item {
            display: flex; align-items: flex-start; gap: 16px;
            margin-bottom: 20px; background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px; padding: 20px; transition: all 0.3s ease;
        }
        .benefit-item:hover { background: rgba(255, 255, 255, 0.2); transform: translateX(5px); }
        .benefit-icon {
            width: 44px; height: 44px; min-width: 44px;
            background: rgba(255, 255, 255, 0.2); border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 18px;
        }
        .benefit-content h4 { font-size: 15px; font-weight: 600; margin: 0 0 4px 0; }
        .benefit-content p { font-size: 13px; opacity: 0.85; margin: 0; line-height: 1.4; }

        /* === KANAN (FORM DARK) === */
        .register-right { 
            flex: 1; 
            /* Warna dasar gelap elegan */
            background: #0F172A; 
            padding: 60px; 
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            overflow-y: auto;
            position: relative;
        }

        /* Ornamen Glow di belakang form */
        .register-right::before {
            content: ''; position: absolute; width: 300px; height: 300px;
            background: rgba(37, 99, 235, 0.3); filter: blur(100px);
            top: 10%; right: 10%; border-radius: 50%; z-index: 0;
        }

        .register-form-container { 
            max-width: 480px; width: 100%; margin: 0 auto; 
            position: relative; z-index: 1; 
        }

        /* Teks Putih */
        .register-form-container h2, 
        .register-form-container p, 
        .register-form-container label { color: #F1F5F9; }
        .text-muted { color: #94A3B8 !important; }

        /* === KOMPONEN FORM (GLASSMORPHISM) === */
        .form-control { 
            border-radius: 12px; 
            padding: 14px 16px; 
            background: rgba(255, 255, 255, 0.05); /* Transparan */
            border: 1px solid rgba(255, 255, 255, 0.1); 
            color: #F1F5F9;
        }
        .form-control:focus { 
            background: rgba(255, 255, 255, 0.1); 
            border-color: #3B82F6; 
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.25); 
            color: #FFF;
        }
        .form-control::placeholder { color: #64748B; }

        /* Tombol */
        .btn-primary { 
            background: #2563EB; 
            border: none; 
            padding: 15px; 
            border-radius: 12px; 
            font-weight: 700; 
            letter-spacing: 0.5px;
            transition: all 0.3s; 
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.4);
        }
        .btn-primary:hover { 
            background: #1D4ED8; 
            transform: translateY(-2px); 
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.5); 
        }

        /* Info Box (Kuning gelap transparan) */
        .info-box {
            background: rgba(245, 158, 11, 0.15);
            border: 1px solid rgba(245, 158, 11, 0.3);
            color: #FCD34D;
            border-radius: 12px;
            padding: 16px;
            font-size: 13px;
        }

        /* Link Daftar/Masuk */
        .auth-link { color: #60A5FA; font-weight: 700; text-decoration: none; transition: 0.2s; }
        .auth-link:hover { color: #93C5FD; text-decoration: underline; }

        /* === RESPONSIVE (MOBILE) === */
        @media (max-width: 992px) {
            .register-container { flex-direction: column; }
            .register-left { padding: 40px 20px; min-height: auto; }
            .register-right { padding: 40px 20px; }
        }
        @media (max-width: 576px) {
            .register-left, .register-right { padding: 30px 20px; }
        }
    </style>
</head>
<body>

<div class="register-container">
    <!-- SISI KIRI (FOTO) -->
    <div class="register-left">
        <div>
            <div class="brand-logo mb-4">
                <h1 class="fw-bold m-0" style="font-size: 32px;">Si<span style="color: #93C5FD;">Laporin</span></h1>
                <p class="mt-2 opacity-75">Sistem Pengaduan Sarana Sekolah</p>
            </div>
        </div>

        <!-- List Keunggulan -->
        <div class="benefits-list">
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-bolt"></i></div>
                <div class="benefit-content">
                    <h4>Lapor Cepat & Mudah</h4>
                    <p>Buat laporan kerusakan hanya dalam hitungan detik</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-chart-line"></i></div>
                <div class="benefit-content">
                    <h4>Pantau Real-time</h4>
                    <p>Lihat status penanganan laporan kapan saja</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon"><i class="fas fa-shield-alt"></i></div>
                <div class="benefit-content">
                    <h4>Data Aman</h4>
                    <p>Informasi pribadi terlindungi dengan enkripsi</p>
                </div>
            </div>
        </div>

        <div>
            <p class="fs-5 fw-semibold mb-0">"Bergabung sekarang dan bantu jaga kualitas sarana sekolah kita bersama."</p>
        </div>
    </div>

    <!-- SISI KANAN (FORM REGISTER) -->
    <div class="register-right">
        <div class="register-form-container">
            <h2 class="fw-bold mb-2" style="font-size: 28px;">Daftar Akun Baru</h2>
            <p class="text-muted mb-4">Isi data diri kamu dengan lengkap.</p>

            <!-- INFO BOX -->
            <div class="info-box mb-4">
                <i class="fas fa-info-circle me-2"></i> 
                Pendaftaran ini hanya untuk <b>Siswa</b>. Untuk akun Admin, hubungi petugas sekolah.
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3" style="font-size: 14px; background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.3); color: #FCA5A5;">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Christian Wardana" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Email Sekolah <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" placeholder="nama@sekolah.sch.id" value="{{ old('email') }}" required>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label class="form-label fw-semibold" style="font-size: 13px;">Kelas</label>
                        <input type="text" name="kelas" class="form-control" placeholder="XII RPL" value="{{ old('kelas') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="font-size: 13px;">No HP</label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08123456789" value="{{ old('no_hp') }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size: 13px;">Konfirmasi Password <span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 text-white">
                    <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                </button>
            </form>

            <p class="text-center text-muted small mt-4">
                Sudah punya akun? <a href="{{ route('login') }}" class="auth-link">Masuk di sini</a>
            </p>

        </div>
    </div>
</div>

</body>
</html>