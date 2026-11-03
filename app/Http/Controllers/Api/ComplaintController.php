<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $complaints = Complaint::with(['user', 'category'])
                ->latest()
                ->get();
        } else {
            $complaints = Complaint::with(['user', 'category'])
                ->where('user_id', $user->id)
                ->latest()
                ->get();
        }

        return response()->json([
            'success' => true,
            'data' => $complaints,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = $request->user();

        // Generate ticket number otomatis
        $todayCount = Complaint::whereDate('created_at', today())->count();
        $ticketNumber = 'SLP-' . date('Ymd') . '-' . str_pad($todayCount + 1, 3, '0', STR_PAD_LEFT);

        // Upload foto
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints', 'public');
        }

        // Buat pengaduan
        $complaint = Complaint::create([
            'ticket_number' => $ticketNumber,
            'user_id' => $user->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'photo' => $photoPath,
            'status' => 'Diterima',
            'priority' => 'Rendah',
        ]);

        // Simpan riwayat status
        ComplaintStatusHistory::create([
            'complaint_id' => $complaint->id,
            'status' => 'Diterima',
            'note' => 'Pengaduan berhasil dikirim',
            'changed_by' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pengaduan berhasil dikirim',
            'data' => $complaint,
        ], 201);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();

        $complaint = Complaint::with(['user', 'category', 'histories.changer', 'rating'])
            ->where('id', $id)
            ->where(function ($q) use ($user) {
                if (!$user->isAdmin()) {
                    $q->where('user_id', $user->id);
                }
            })
            ->first();

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Pengaduan tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $complaint,
        ]);
    }
}