<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ComplaintsExport;
use App\Models\Category;
use App\Models\Complaint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Complaint::with(['user', 'category']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $complaints = $query->latest()->get();
        $categories = Category::all();

        return view('admin.reports.index', compact('complaints', 'categories'));
    }

    public function exportPdf(Request $request)
    {
        $query = Complaint::with(['user', 'category']);

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [
                $request->start_date . ' 00:00:00',
                $request->end_date . ' 23:59:59'
            ]);
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $complaints = $query->latest()->get();

        $pdf = Pdf::loadView('admin.reports.pdf', compact('complaints'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('laporan-pengaduan-' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ComplaintsExport($request->all()),
            'laporan-pengaduan-' . date('Y-m-d') . '.xlsx'
        );
    }
}