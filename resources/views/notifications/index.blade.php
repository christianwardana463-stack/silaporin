@extends('layouts.dashboard')

@section('title', 'Notifikasi')

@section('content')
<div class="card p-4">
    <h5 class="fw-bold mb-4">Notifikasi Anda</h5>
    
    @forelse($notifications as $notif)
        <div class="d-flex gap-3 p-3 mb-2 rounded-3 border" style="background: var(--bg-input); border-color: var(--border) !important;">
            <div class="fs-3 text-primary"><i class="fas fa-info-circle"></i></div>
            <div class="flex-grow-1">
                <h6 class="fw-bold m-0">{{ $notif->title }}</h6>
                <small class="text-muted d-block mb-2">{{ $notif->created_at->diffForHumans() }}</small>
                <p class="m-0">{{ $notif->message }}</p>
                @if($notif->link)
                    <a href="{{ $notif->link }}" class="btn btn-sm btn-outline-primary mt-2">Lihat Detail</a>
                @endif
            </div>
        </div>
    @empty
        <div class="text-center py-5 text-muted">
            <i class="fas fa-bell-slash fs-1 mb-3 opacity-50"></i>
            <h5>Belum ada notifikasi</h5>
        </div>
    @endforelse

    <div class="mt-3">
        {{ $notifications->links() }}
    </div>
</div>
@endsection