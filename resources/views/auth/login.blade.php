<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiLaporin - Masuk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body { margin: 0; padding: 0; overflow-x: hidden; }
        .login-container { display: flex; min-height: 100vh; }
        .login-left {
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
        .login-left::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1562774053-701939374585?w=1200');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: 1;
        }
        .login-left > * { position: relative; z-index: 2; }
        .brand-logo { display: flex; align-items: center; gap: 12px; margin-bottom: 8px; }
        .brand-logo .logo-icon {
            width: 48px; height: 48px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 24px;
        }
        .brand-logo h1 { font-size: 32px; font-weight: 800; margin: 0; letter-spacing: -0.5px; }
        .brand-logo h1 span { color: #93C5FD; }
        .brand-subtitle { font-size: 14px; opacity: 0.85; margin-left: 60px; font-weight: 400; }
        .stats-container { display: flex; gap: 20px; margin: 60px 0; }
        .stat-card {
            flex: 1;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
        }
        .stat-card:hover { transform: translateY(-5px); background: rgba(255, 255, 255, 0.18); }
        .stat-card .stat-number { font-size: 28px; font-weight: 800; margin-bottom: 8px; display: block; }
        .stat-card .stat-label { font-size: 13px; opacity: 0.85; line-height: 1.4; }
        .quote-section { margin-bottom: 30px; }
        .quote-section .quote-text { font-size: 24px; font-weight: 600; line-height: 1.4; margin-bottom: 24px; letter-spacing: -0.3px; }
        .quote-section .quote-footer { font-size: 14px; opacity: 0.8; }
        .login-right {
            flex: 1;
            background: #FFFFFF;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }
        .login-form-container { max-width: 420px; width: 100%; margin: 0 auto; }
        .login-title { font-size: 32px; font-weight: 800; color: #1F2937; margin-bottom: 8px; letter-spacing: -0.5px; }
        .login-subtitle { color: #6B7280; font-size: 15px; margin-bottom: 32px; }
        .demo-box { background: #EFF6FF; border: 1px solid #DBEAFE; border-radius: 12px; padding: 16px 20px; margin-bottom: 28px; }
        .demo-box .demo-title { font-size: 13px; font-weight: 600; color: #2563EB; margin-bottom: 8px; }
        .demo-box .demo-item { font-size: 13px; color: #1E40AF; margin-bottom: 4px; }
        .demo-box .demo-item strong { color: #1D4ED8; }
        .form-label { font-weight: 500; color: #374151; font-size: 14px; margin-bottom: 8px; }
        .form-control {
            border-radius: 12px;
            padding: 14px 16px;
            border: 1.5px solid #E5E7EB;
            font-size: 14px;
            transition: all 0.3s ease;
            background: #F9FAFB;
        }
        .form-control:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: #FFFFFF;
        }
        .password-wrapper { position: relative; }
        .password-toggle {
            position: absolute;
            right: 16px; top: 50%;
            transform: translateY(-50%);
            color: #6B7280;
            cursor: pointer;
            font-size: 16px;
        }
        .password-toggle:hover { color: #2563EB; }
        .forgot-link { color: #2563EB; font-size: 14px; text-decoration: none; font-weight: 500; }
        .forgot-link:hover { text-decoration: underline; }
        .btn-login {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            color: white; border: none;
            padding: 16px;
            font-weight: 600;
            border-radius: 12px;
            width: 100%;
            font-size: 15px;
            transition: all 0.3s ease;
            margin-top: 8px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.4);
            color: white;
        }
        .register-link {
            text-align: center;
            margin-top: 20px;
            color: #6B7280;
            font-size: 14px;
        }
        .register-link a {
            color: #2563EB;
            font-weight: 600;
            text-decoration: none;
        }
        .register-link a:hover { text-decoration: underline; }
        .copyright { text-align: center; color: #9CA3AF; font-size: 13px; margin-top: 24px; }
        .alert { border-radius: 12px; font-size: 14px; padding: 14px 16px; }
        @media (max-width: 992px) {
            .login-container { flex-direction: column; }
            .login-left { min-height: auto; padding: 40px 30px; }
            .login-right { padding: 40px 30px; }
            .stats-container { flex-direction: column; gap: 12px; margin: 30px 0; }
            .quote-section .quote-text { font-size: 20px; }
        }
        @media (max-width: 576px) {
            .login-left, .login-right { padding: 30px 20px; }
            .brand-logo h1 { font-size: 26px; }
            .login-title { font-size: 26px; }
        }
    </style>
</head>
<body>

<div class="login-container">
    <!-- LEFT SIDE -->
    <div class="login-left">
        <div>
            <div class="brand-logo">
                <div class="logo-icon"><i class="fas fa-bullhorn"></i></div>
                <h1>Si<span>Laporin</span></h1>
            </div>
            <p class="brand-subtitle">Sistem Pengaduan Sarana Sekolah</p>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <span class="stat-number">120+</span>
                <span class="stat-label">Pengaduan Terselesaikan</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">98%</span>
                <span class="stat-label">Tingkat Respon</span>
            </div>
            <div class="stat-card">
                <span class="stat-number">&lt; 3 hari</span>
                <span class="stat-label">Rata-rata Penanganan</span>
            </div>
        </div>

        <div class="quote-section">
            <p class="quote-text">"Laporkan kerusakan sarana sekolah dengan mudah dan pantau progres perbaikannya secara real-time."</p>
            <p class="quote-footer">
                <i class="fas fa-school me-2"></i>
                SMAN 1 Contoh · Sistem Manajemen Fasilitas
            </p>
        </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="login-right">
        <div class="login-form-container">
            <h2 class="login-title">Masuk ke Akun</h2>
            <p class="login-subtitle">Gunakan akun sekolah kamu untuk masuk.</p>

            <div class="demo-box">
                <div class="demo-title"><i class="fas fa-info-circle me-1"></i> Demo Akun:</div>
                <div class="demo-item">Siswa: <strong>christian@student.com</strong> / <strong>password</strong></div>
                <div class="demo-item">Admin: <strong>admin@silaporin.com</strong> / <strong>password</strong></div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="form-label">Email Sekolah</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email"
                           value="{{ old('email') }}"
                           placeholder="nama@sekolah.sch.id"
                           required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password"
                               placeholder="Masukkan password"
                               required>
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </span>
                    </div>
                </div>

            

                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <p class="register-link">
                Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
            </p>

            <p class="copyright">
                © {{ date('Y') }} SiLaporin · Dibuat oleh Christian Wardana · XII RPL
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');

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