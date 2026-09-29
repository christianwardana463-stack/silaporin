<?php

namespace App\Exports;

use App\Models\Complaint;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ComplaintsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection(): Collection
    {
        $query = Complaint::with(['user', 'category']);

        if (!empty($this->filters['start_date']) && !empty($this->filters['end_date'])) {
            $query->whereBetween('created_at', [
                $this->filters['start_date'] . ' 00:00:00',
                $this->filters['end_date'] . ' 23:59:59'
            ]);
        }
        if (!empty($this->filters['category'])) {
            $query->where('category_id', $this->filters['category']);
        }
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        if (!empty($this->filters['priority'])) {
            $query->where('priority', $this->filters['priority']);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'No. Tiket',
            'Tanggal',
            'Pelapor',
            'Kelas',
            'Kategori',
            'Judul',
            'Lokasi',
            'Deskripsi',
            'Prioritas',
            'Status',
            'Tanggapan Admin',
        ];
    }

    public function map($complaint): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $complaint->ticket_number,
            $complaint->created_at->format('d/m/Y H:i'),
            $complaint->user->name,
            $complaint->user->kelas ?? '-',
            $complaint->category->name,
            $complaint->title,
            $complaint->location,
            $complaint->description,
            $complaint->priority,
            $complaint->status,
            $complaint->admin_response ?? '-',
        ];
    }

    public function styles(Worksheet $sheet): ?array
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['rgb' => '2563EB']
                ],
            ],
        ];
    }
}