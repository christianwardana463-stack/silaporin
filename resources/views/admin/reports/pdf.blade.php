<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan Sarana Sekolah</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #2563EB;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #2563EB;
            font-size: 18px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #2563EB;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>SiLaporin - Sistem Pengaduan Sarana Sekolah</h1>
        <p>Laporan Data Pengaduan Sarana & Prasarana</p>
        <p>Dicetak: {{ date('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">No. Tiket</th>
                <th style="width: 10%;">Tanggal</th>
                <th style="width: 15%;">Pelapor</th>
                <th style="width: 12%;">Kategori</th>
                <th style="width: 20%;">Judul</th>
                <th style="width: 8%;">Prioritas</th>
                <th style="width: 10%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($complaints as $index => $complaint)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $complaint->ticket_number }}</td>
                    <td>{{ $complaint->created_at->format('d/m/Y') }}</td>
                    <td>{{ $complaint->user->name }}</td>
                    <td>{{ $complaint->category->name }}</td>
                    <td>{{ $complaint->title }}</td>
                    <td>{{ $complaint->priority }}</td>
                    <td>{{ $complaint->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Total: {{ $complaints->count() }} pengaduan</p>
    </div>

</body>
</html>