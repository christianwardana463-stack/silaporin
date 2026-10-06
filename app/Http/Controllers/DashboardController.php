<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $totalComplaints = Complaint::count();
        $diterima = Complaint::where('status', 'Diterima')->count();
        $diproses = Complaint::where('status', 'Diproses')->count();
        $selesai = Complaint::where('status', 'Selesai')->count();
        $ditolak = Complaint::where('status', 'Ditolak')->count();

        $totalUsers = User::count();
        $totalSiswa = User::where('role', 'Siswa')->count();
        $totalKategori = Category::count();

        $recentComplaints = Complaint::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        // ==========================================================
        // DATA CHART 1: Pengaduan per Kategori (Bar Chart)
        // ==========================================================
        $categories = Category::withCount('complaints')->get();
        $chartCategoriesLabels = $categories->pluck('name')->toArray();
        $chartCategoriesData = $categories->pluck('complaints_count')->toArray();

        // ==========================================================
        // DATA CHART 2: Pengaduan per Status (Doughnut Chart)
        // ==========================================================
        $chartStatusLabels = ['Diterima', 'Diproses', 'Selesai', 'Ditolak'];
        $chartStatusData = [$diterima, $diproses, $selesai, $ditolak];

        // ==========================================================
        // DATA CHART 3: Tren Pengaduan 7 Hari Terakhir (Line Chart)
        // ==========================================================
        $chartTrendLabels = [];
        $chartTrendData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $chartTrendLabels[] = $date->format('d M');
            $chartTrendData[] = Complaint::whereDate('created_at', $date->format('Y-m-d'))->count();
        }

        return view('dashboard.admin', compact(
            'totalComplaints',
            'diterima',
            'diproses',
            'selesai',
            'ditolak',
            'totalUsers',
            'totalSiswa',
            'totalKategori',
            'recentComplaints',
            'chartCategoriesLabels',
            'chartCategoriesData',
            'chartStatusLabels',
            'chartStatusData',
            'chartTrendLabels',
            'chartTrendData'
        ));
    }

    public function siswaDashboard()
    {
        $userId = Auth::id();

        $totalComplaints = Complaint::where('user_id', $userId)->count();
        $diproses = Complaint::where('user_id', $userId)->where('status', 'Diproses')->count();
        $selesai = Complaint::where('user_id', $userId)->where('status', 'Selesai')->count();
        $ditolak = Complaint::where('user_id', $userId)->where('status', 'Ditolak')->count();

        $recentComplaints = Complaint::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.siswa', compact(
            'totalComplaints',
            'diproses',
            'selesai',
            'ditolak',
            'recentComplaints'
        ));
    }
}