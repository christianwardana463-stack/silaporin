<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SiLaporin - @yield('title')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f3f4f6;
            min-height: 100vh;
        }

        .card-login {
            max-width: 420px;
            margin: 60px auto;
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        }

        .card-login .card-body {
            padding: 40px 32px;
        }

        .btn-primary-custom {
            background-color: #2563EB;
            border: none;
            padding: 12px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: #1D4ED8;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .logo-text {
            color: #2563EB;
            font-weight: 700;
            font-size: 28px;
        }

        .logo-text span {
            color: #1F2937;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 16px;
            border: 1.5px solid #e5e7eb;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2563EB;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }
    </style>

    @stack('styles')
</head>
<body>

    @yield('content')

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>