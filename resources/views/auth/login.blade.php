
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SiLaporin - Masuk</title>

    <!-- FAVICON LOGO SEKOLAH -->
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * { font-family: 'Poppins', sans-serif; }

        body {
            margin: 0;
            padding: 0;
            background: #0F172A;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        /* === KIRI (FOTO & BRANDING) === */
        .login-left {
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

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;

            background-image: url('{{ asset('images/sekolah.jpeg') }}');
            background-size: cover;
            background-position: center;

            z-index: 1;
            box-shadow: inset 0 0 0 2000px rgba(15, 23, 42, 0.65);
        }

        .login-left > * {
            position: relative;
            z-index: 2;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.8);
        }

        /* === KANAN (FORM DARK) === */
        .login-right {
            flex: 1;
            background: #0F172A;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
            position: relative;
        }

        .login-right::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(37, 99, 235, 0.3);
            filter: blur(100px);
            bottom: 10%;
            left: 10%;
            border-radius: 50%;
            z-index: 0;
        }

        .login-form-container {
            max-width: 420px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .login-form-container h3,
        .login-form-container p,
        .login-form-container label {
            color: #F1F5F9;
        }

        .text-muted { color: #94A3B8 !important; }

        .form-control {
            border-radius: 12px;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.05);
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

        .demo-box {
            background: rgba(37, 99, 235, 0.1);
            border: 1px solid rgba(37, 99, 235, 0.3);
            border-radius: 12px;
            padding: 16px;
        }

        .demo-box small { color: #93C5FD; }
        .demo-box b { color: #F1F5F9; }

        .auth-link {
            color: #60A5FA;
            font-weight: 700;
            text-decoration: none;
            transition: 0.2s;
        }

        .auth-link:hover {
            color: #93C5FD;
            text-decoration: underline;
        }

        @media (max-width: 992px) {
            .login-container { flex-direction: column; }
            .login-left { padding: 40px 20px; min-height: auto; }
            .login-right { padding: 40px 20px; }
        }

        @media (max-width: 576px) {
            .login-left, .login-right {
                padding: 30px 20px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <!-- SISI KIRI (FOTO & LOGO) -->
    <div class="login-left">
        <div>
            <div class="brand-logo mb-4 d-flex align-items-center gap-3">

                <!-- LOGO SEKOLAH -->
                <img
                    src="{{ asset('images/logo.jpeg') }}"
                    alt="Logo SMKN 5 Surakarta"
                    style="width: 75px; height: auto; filter: drop-shadow(2px 4px 6px rgba(0,0,0,0.5)); background: rgba(255, 255, 255, 0.9); border-radius: 12px; padding: 5px;"
                >

                <div>
                    <h1 class="fw-bold m-0" style="font-size: 36px;">
                        Si<span style="color: #93C5FD;">Laporin</span>
                    </h1>
                    <p class="mt-1 opacity-75 m-0">
                        Sistem Pengaduan Sarana Sekolah
                    </p>
                </div>
            </div>
        </div>

        <div>
            <p class="d-none d-md-block fs-5 fw-semibold mb-0">
                "Laporkan kerusakan sarana sekolah dengan mudah dan pantau progres perbaikannya secara real-time."
            </p>
        </div>
    </div>

    <!-- SISI KANAN (FORM LOGIN) -->
    <div class="login-right">
        <div class="login-form-container">

            <h3 class="fw-bold mb-2" style="font-size: 28px;">
                Masuk ke Akun
            </h3>

            <p class="text-muted mb-4">
                Gunakan akun sekolah kamu untuk masuk.
            </p>

            <div class="demo-box mb-4">
                <small class="fw-bold d-block mb-1">
                    <i class="fas fa-info-circle me-1"></i> Demo Akun:
                </small>

                <small class="d-block">
                    Admin: <b>admin@silaporin.com</b> / admin123
                </small>

                <small class="d-block">
                    Siswa: <b>christian@student.com</b> / siswa123
                </small>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-3"
                     style="font-size: 14px; background: rgba(239, 68, 68, 0.1); border-color: rgba(239, 68, 68, 0.3); color: #FCA5A5;">

                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach

                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size: 13px;">
                        Email Sekolah
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="nama@sekolah.sch.id"
                        required
                        autofocus
                    >
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold" style="font-size: 13px;">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100 text-white mb-3">
                    Masuk
                </button>
            </form>

            <p class="text-center text-muted small mt-3">
                Belum punya akun?
                <a href="{{ route('register') }}" class="auth-link">
                    Daftar di sini
                </a>
            </p>

            <p class="text-center text-muted small mt-4" style="font-size: 11px;">
                © 2026 SiLaporin · Christian Wardana · XII RPL
            </p>

        </div>
    </div>

</div>

</body>
</html>
