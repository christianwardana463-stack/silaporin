<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(10);
        
        // Tandai sudah dibaca
        Auth::user()->notifications()->where('is_read', false)->update(['is_read' => true]);

        return view('notifications.index', compact('notifications'));
    }
}