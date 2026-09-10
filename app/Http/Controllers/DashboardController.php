<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

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

        return view('dashboard.admin', compact(
            'totalComplaints',
            'diterima',
            'diproses',
            'selesai',
            'ditolak',
            'totalUsers',
            'totalSiswa',
            'totalKategori',
            'recentComplaints'
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