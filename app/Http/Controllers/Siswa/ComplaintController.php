<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ComplaintController extends Controller
{
    // Form Buat Pengaduan
    public function create()
    {
        $categories = Category::all();
        return view('siswa.complaints.create', compact('categories'));
    }

    // Simpan Pengaduan
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'location' => 'required|string',
            'description' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Generate nomor tiket otomatis
        $ticketNumber = 'SLP-' . date('Ymd') . '-' . str_pad(Complaint::count() + 1, 3, '0', STR_PAD_LEFT);

        // Upload foto jika ada
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints', 'public');
        }

        // Simpan pengaduan
        $complaint = Complaint::create([
            'ticket_number' => $ticketNumber,
            'user_id' => Auth::id(),
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
            'changed_by' => Auth::id(),
        ]);

        return redirect()->route('siswa.complaints.history')
            ->with('success', 'Pengaduan berhasil dikirim! Nomor tiket: ' . $ticketNumber);
    }

    // Riwayat Pengaduan
    public function history()
    {
        $complaints = Complaint::where('user_id', Auth::id())
            ->with(['category', 'rating'])
            ->latest()
            ->get();

        return view('siswa.complaints.history', compact('complaints'));
    }

    // Detail Pengaduan
    public function show($id)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->with(['category', 'histories.changer', 'rating'])
            ->findOrFail($id);

        return view('siswa.complaints.show', compact('complaint'));
    }

    // Rating Pengaduan
    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $complaint = Complaint::where('user_id', Auth::id())
            ->where('status', 'Selesai')
            ->findOrFail($id);

        // Cek apakah sudah pernah rating
        if ($complaint->rating) {
            return back()->with('error', 'Anda sudah memberikan rating untuk pengaduan ini.');
        }

        Rating::create([
            'complaint_id' => $complaint->id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Terima kasih atas rating Anda!');
    }
}