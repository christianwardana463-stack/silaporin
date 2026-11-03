<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Complaint;
use App\Models\ComplaintStatusHistory;
use App\Models\Notification;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('siswa.complaints.create', compact('categories'));
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

        $ticketNumber = 'SLP-' . date('Ymd') . '-' . str_pad(Complaint::count() + 1, 3, '0', STR_PAD_LEFT);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('complaints', 'public');
        }

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

        ComplaintStatusHistory::create([
            'complaint_id' => $complaint->id,
            'status' => 'Diterima',
            'note' => 'Pengaduan berhasil dikirim',
            'changed_by' => Auth::id(),
        ]);

        // KIRIM NOTIFIKASI KE ADMIN (Tanpa Link)
        $admins = User::where('role', 'Admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Pengaduan Baru: ' . $ticketNumber,
                'message' => Auth::user()->name . ' baru saja membuat pengaduan: "' . $request->title . '".',
            ]);
        }

        return redirect()->route('siswa.complaints.history')
            ->with('success', 'Pengaduan berhasil dikirim! Nomor tiket: ' . $ticketNumber);
    }

    public function history()
    {
        $complaints = Complaint::where('user_id', Auth::id())
            ->with(['category', 'rating'])
            ->latest()
            ->get();

        return view('siswa.complaints.history', compact('complaints'));
    }

    public function show($id)
    {
        $complaint = Complaint::where('user_id', Auth::id())
            ->with(['category', 'histories.changer', 'rating'])
            ->findOrFail($id);

        return view('siswa.complaints.show', compact('complaint'));
    }

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $complaint = Complaint::where('user_id', Auth::id())
            ->where('status', 'Selesai')
            ->findOrFail($id);

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