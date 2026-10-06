<?php

namespace App\Providers\Composers;

use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SidebarComposer
{
    public function compose(View $view)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->isAdmin()) {
                $pendingComplaints = Complaint::where('status', 'Diterima')->count();
                $view->with('pendingComplaints', $pendingComplaints);
            } else {
                $myActiveComplaints = Complaint::where('user_id', $user->id)
                    ->whereIn('status', ['Diterima', 'Diproses'])
                    ->count();
                $view->with('myActiveComplaints', $myActiveComplaints);
            }
        }
    }
}