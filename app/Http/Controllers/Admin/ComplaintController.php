<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    // Daftar semua pengaduan
    public function index(Request $request)
    {
        $query = Complaint::with(['user', 'category']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan prioritas
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search berdasarkan tiket atau judul
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_number', 'LIKE', "%$search%")
                  ->orWhere('title', 'LIKE', "%$search%");
            });
        }

        $complaints = $query->latest()->paginate(10);
        $categories = \App\Models\Category::all();

        return view('admin.complaints.index', compact('complaints', 'categories'));
    }

    // Detail pengaduan
    public function show($id)
    {
        $complaint = Complaint::with(['user', 'category', 'histories.changer', 'rating'])
            ->findOrFail($id);

        return view('admin.complaints.show', compact('complaint'));
    }

    // Update status, prioritas, tanggapan, foto perbaikan
    public function update(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        $request->validate([
            'status' => 'required|in:Diterima,Diproses,Selesai,Ditolak',
            'priority' => 'required|in:Rendah,Sedang,Tinggi',
            'admin_response' => 'nullable|string',
            'repair_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $oldStatus = $complaint->status;

        // Upload foto perbaikan
        $repairPhotoPath = $complaint->repair_photo;
        if ($request->hasFile('repair_photo')) {
            $repairPhotoPath = $request->file('repair_photo')->store('repairs', 'public');
        }

        // Update data
        $complaint->update([
            'status' => $request->status,
            'priority' => $request->priority,
            'admin_id' => Auth::id(),
            'admin_response' => $request->admin_response,
            'repair_photo' => $repairPhotoPath,
            'processed_at' => in_array($request->status, ['Diproses', 'Selesai']) ? now() : $complaint->processed_at,
            'completed_at' => $request->status == 'Selesai' ? now() : null,
        ]);

        // Simpan riwayat status jika berubah
        if ($oldStatus != $request->status) {
            ComplaintStatusHistory::create([
                'complaint_id' => $complaint->id,
                'status' => $request->status,
                'note' => 'Status diubah oleh Admin: ' . $request->status,
                'changed_by' => Auth::id(),
            ]);
        }

        return redirect()->route('admin.complaints.show', $complaint->id)
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }
}