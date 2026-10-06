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
        * {
            font-family: 'Poppins', sans-serif;
        }
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .register-container {
            display: flex;
            min-height: 100vh;
        }
        /* LEFT SIDE - BRANDING */
        .register-left {
            flex: 1;
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 50%, #1E40AF 100%);
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
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?w=1200');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: 1;
        }
        .register-left > * {
            position: relative;
            z-index: 2;
        }
        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 8px;
        }
        .brand-logo .logo-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        .brand-logo h1 {
            font-size: 32px;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.5px;
        }
        .brand-logo h1 span {
            color: #93C5FD;
        }
        .brand-subtitle {
            font-size: 14px;
            opacity: 0.85;
            margin-left: 60px;
            font-weight: 400;
        }
        /* BENEFITS */
        .benefits-list {
            margin: 60px 0;
        }
        .benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 24px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            padding: 20px;
            transition: all 0.3s ease;
        }
        .benefit-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }
        .benefit-icon {
            width: 44px;
            height: 44px;
            min-width: 44px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        .benefit-content h4 {
            font-size: 15px;
            font-weight: 600;
            margin: 0 0 4px 0;
        }
        .benefit-content p {
            font-size: 13px;
            opacity: 0.8;
            margin: 0;
            line-height: 1.4;
        }
        /* QUOTE */
        .quote-section {
            margin-bottom: 20px;
        }
        .quote-section .quote-text {
            font-size: 20px;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 16px;
            letter-spacing: -0.3px;
        }
        .quote-section .quote-footer {
            font-size: 14px;
            opacity: 0.8;
        }
        /* RIGHT SIDE - REGISTER FORM */
        .register-right {
            flex: 1;
            background: #FFFFFF;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }
        .register-form-container {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
        }
        .register-title {
            font-size: 30px;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }
        .register-subtitle {
            color: #6B7280;
            font-size: 15px;
            margin-bottom: 28px;
        }
        /* INFO BOX */
        .info-box {
            background: #FEF3C7;
            border: 1px solid #FDE68A;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #92400E;
        }
        .info-box i {
            color: #D97706;
        }
        /* FORM */
        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 13px;
            margin-bottom: 6px;
        }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1.5px solid #E5E7EB;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #F9FAFB;
        }
        .form-control:focus, .form-select:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: #FFFFFF;
        }
        .password-wrapper {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            cursor: pointer;
            font-size: 16px;
            z-index: 10;
        }
        .password-toggle:hover {
            color: #2563EB;
        }
        .btn-register {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            color: white;
            border: none;
            padding: 14px;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
            font-size: 15px;
            transition: all 0.3s ease;
            margin-top: 8px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
            color: white;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #6B7280;
            font-size: 14px;
        }
        .login-link a {
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .copyright {
            text-align: center;
            color: #9CA3AF;
            font-size: 13px;
            margin-top: 24px;
        }
        /* ALERT */
        .alert {
            border-radius: 12px;
            font-size: 14px;
            padding: 14px 16px;
        }
        /* RESPONSIVE */
        @media (max-width: 992px) {
            .register-container {
                flex-direction: column;
            }
            .register-left {
                min-height: auto;
                padding: 40px 30px;
            }
            .register-right {
                padding: 40px 30px;
            }
            .quote-section .quote-text {
                font-size: 18px;
            }
        }
        @media (max-width: 576px) {
            .register-left, .register-right {
                padding: 30px 20px;
            }
            .brand-logo h1 {
                font-size: 26px;
            }
            .register-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <!-- LEFT SIDE - BRANDING -->
    <div class="register-left">
        <div>
            <div class="brand-logo">
                <div class="logo-icon">
                    <i class="fas fa-bullhorn"></i>
                </div>
                <h1>Si<span>Laporin</span></h1>
            </div>
            <p class="brand-subtitle">Sistem Pengaduan Sarana Sekolah</p>
        </div>

        <div class="benefits-list">
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <div class="benefit-content">
                    <h4>Lapor Cepat & Mudah</h4>
                    <p>Buat laporan kerusakan hanya dalam hitungan detik</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="benefit-content">
                    <h4>Pantau Real-time</h4>
                    <p>Lihat status penanganan laporan kapan saja</p>
                </div>
            </div>
            <div class="benefit-item">
                <div class="benefit-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="benefit-content">
                    <h4>Data Aman</h4>
                    <p>Informasi pribadi terlindungi dengan enkripsi</p>
                </div>
            </div>
        </div>

        <div class="quote-section">
            <p class="quote-text">"Bergabung sekarang dan bantu jaga kualitas sarana sekolah kita bersama."</p>
            <p class="quote-footer">
                <i class="fas fa-school me-2"></i>
                SMAN 1 Contoh · Sistem Manajemen Fasilitas
            </p>
        </div>
    </div>

    <!-- RIGHT SIDE - REGISTER FORM -->
    <div class="register-right">
        <div class="register-form-container">
            <h2 class="register-title">Daftar Akun Baru</h2>
            <p class="register-subtitle">Isi data diri kamu dengan lengkap.</p>

            <!-- INFO BOX -->
            <div class="info-box">
                <i class="fas fa-info-circle me-2"></i>
                Pendaftaran ini hanya untuk <strong>Siswa</strong>. Untuk akun Admin, hubungi petugas sekolah.
            </div>

            <!-- ERROR ALERT -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- REGISTER FORM -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Christian Wardana"
                           required autofocus>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Sekolah <span class="text-danger">*</span></label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="nama@sekolah.sch.id"
                           required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <input type="text"
                               class="form-control @error('kelas') is-invalid @enderror"
                               id="kelas" name="kelas"
                               value="{{ old('kelas') }}"
                               placeholder="XII RPL">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label">No HP</label>
                        <input type="text"
                               class="form-control @error('no_hp') is-invalid @enderror"
                               id="no_hp" name="no_hp"
                               value="{{ old('no_hp') }}"
                               placeholder="08123456789">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                    <div class="password-wrapper">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Minimal 8 karakter"
                               required>
                        <span class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="fas fa-eye" id="toggleIcon1"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <div class="password-wrapper">
                        <input type="password"
                               class="form-control"
                               id="password_confirmation" name="password_confirmation"
                               placeholder="Ulangi password"
                               required>
                        <span class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                            <i class="fas fa-eye" id="toggleIcon2"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus me-2"></i> Daftar Sekarang
                </button>
            </form>

            <p class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
            </p>

            <p class="copyright">
                © {{ date('Y') }} SiLaporin · Dibuat oleh Christian Wardana · XII RPL
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>

</body>
</html>