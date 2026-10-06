<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Pengaduan - {{ $complaint->ticket_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(135deg, #EFF6FF 0%, #DBEAFE 100%);
            min-height: 100vh;
            padding: 24px 12px;
        }
        .track-container { max-width: 720px; margin: 0 auto; }
        .track-header {
            background: linear-gradient(135deg, #2563EB 0%, #1D4ED8 100%);
            color: white;
            padding: 32px;
            border-radius: 20px 20px 0 0;
            text-align: center;
        }
        .track-header .logo {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 8px;
        }
        .track-header .logo span { color: #93C5FD; }
        .track-header p { margin: 0; opacity: 0.9; font-size: 14px; }
        .track-card {
            background: white;
            border-radius: 0 0 20px 20px;
            padding: 32px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        .ticket-number {
            background: #EFF6FF;
            border: 2px dashed #2563EB;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            margin-bottom: 24px;
        }
        .ticket-number .label {
            font-size: 12px;
            color: #6B7280;
            text-transform: uppercase;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .ticket-number .value {
            font-size: 24px;
            font-weight: 800;
            color: #2563EB;
            margin-top: 4px;
        }
        .info-row {
            display: flex;
            padding: 12px 0;
            border-bottom: 1px solid #F3F4F6;
        }
        .info-row:last-child { border-bottom: none; }
        .info-row .label {
            width: 140px;
            color: #6B7280;
            font-size: 14px;
            flex-shrink: 0;
        }
        .info-row .value {
            color: #1F2937;
            font-size: 14px;
            font-weight: 500;
            flex-grow: 1;
        }
        .status-badge {
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
        }
        .status-diterima { background: #DBEAFE; color: #1D4ED8; }
        .status-diproses { background: #FEF3C7; color: #B45309; }
        .status-selesai { background: #D1FAE5; color: #065F46; }
        .status-ditolak { background: #FEE2E2; color: #991B1B; }
        .priority-rendah { background: #D1FAE5; color: #065F46; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .priority-sedang { background: #FEF3C7; color: #B45309; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .priority-tinggi { background: #FEE2E2; color: #991B1B; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .section-title {
            font-size: 16px;
            font-weight: 700;
            color: #1F2937;
            margin: 24px 0 12px 0;
            padding-bottom: 8px;
            border-bottom: 2px solid #F3F4F6;
        }
        .timeline-item { display: flex; gap: 16px; margin-bottom: 16px; }
        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
            position: relative;
        }
        .timeline-dot::after {
            content: '';
            position: absolute;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: calc(100% + 4px);
            background: #E5E7EB;
        }
        .timeline-item:last-child .timeline-dot::after { display: none; }
        .dot-diterima { background: #3B82F6; }
        .dot-diproses { background: #F59E0B; }
        .dot-selesai { background: #10B981; }
        .dot-ditolak { background: #EF4444; }
        .timeline-content small { display: block; color: #6B7280; font-size: 12px; }
        .timeline-content p { margin: 2px 0; font-size: 14px; color: #1F2937; }
        .footer-text {
            text-align: center;
            margin-top: 24px;
            color: #6B7280;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="track-container">
    <div class="track-header">
        <div class="logo">
            <i class="fas fa-bullhorn"></i>
            Si<span>Laporin</span>
        </div>
        <p>Tracking Status Pengaduan</p>
    </div>

    <div class="track-card">
        <div class="ticket-number">
            <div class="label">Nomor Tiket</div>
            <div class="value">{{ $complaint->ticket_number }}</div>
        </div>

        <div class="info-row">
            <div class="label">Status</div>
            <div class="value">
                <span class="status-badge status-{{ strtolower($complaint->status) }}">
                    {{ $complaint->status }}
                </span>
            </div>
        </div>
        <div class="info-row">
            <div class="label">Prioritas</div>
            <div class="value">
                <span class="priority-{{ strtolower($complaint->priority) }}">
                    {{ $complaint->priority }}
                </span>
            </div>
        </div>
        <div class="info-row">
            <div class="label">Pelapor</div>
            <div class="value">{{ $complaint->user->name }} ({{ $complaint->user->kelas ?? '-' }})</div>
        </div>
        <div class="info-row">
            <div class="label">Kategori</div>
            <div class="value">{{ $complaint->category->name }}</div>
        </div>
        <div class="info-row">
            <div class="label">Lokasi</div>
            <div class="value">{{ $complaint->location }}</div>
        </div>
        <div class="info-row">
            <div class="label">Judul</div>
            <div class="value">{{ $complaint->title }}</div>
        </div>
        <div class="info-row">
            <div class="label">Tanggal</div>
            <div class="value">{{ $complaint->created_at->format('d F Y, H:i') }}</div>
        </div>
        <div class="info-row">
            <div class="label">Deskripsi</div>
            <div class="value">{{ $complaint->description }}</div>
        </div>

        @if($complaint->photo)
            <div class="section-title">
                <i class="fas fa-camera me-2"></i> Foto Kerusakan
            </div>
            <img src="{{ asset('storage/' . $complaint->photo) }}"
                 alt="Foto Kerusakan"
                 class="img-fluid rounded mb-3"
                 style="max-height: 300px;">
        @endif

        @if($complaint->repair_photo)
            <div class="section-title">
                <i class="fas fa-check-circle me-2 text-success"></i> Foto Hasil Perbaikan
            </div>
            <img src="{{ asset('storage/' . $complaint->repair_photo) }}"
                 alt="Foto Perbaikan"
                 class="img-fluid rounded mb-3"
                 style="max-height: 300px;">
        @endif

        @if($complaint->admin_response)
            <div class="section-title">
                <i class="fas fa-comment-dots me-2"></i> Tanggapan Admin
            </div>
            <div class="alert alert-info">{{ $complaint->admin_response }}</div>
        @endif

        <div class="section-title">
            <i class="fas fa-history me-2"></i> Riwayat Status
        </div>
        @forelse($complaint->histories as $history)
            <div class="timeline-item">
                <div class="timeline-dot dot-{{ strtolower($history->status) }}"></div>
                <div class="timeline-content">
                    <small>{{ $history->created_at->format('d/m/Y H:i') }}</small>
                    <p><strong>{{ $history->status }}</strong> — {{ $history->note }}</p>
                    <small>oleh: {{ $history->changer->name ?? 'Sistem' }}</small>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada riwayat.</p>
        @endforelse

        <div class="footer-text">
            © {{ date('Y') }} SiLaporin · Sistem Pengaduan Sarana Sekolah
        </div>
    </div>
</div>

</body>
</html>
