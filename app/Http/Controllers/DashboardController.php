<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('dashboard.admin');
    }

    public function siswaDashboard()
    {
        return view('dashboard.siswa');
    }
}