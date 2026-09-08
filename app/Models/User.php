<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'kelas',
        'no_hp',
        'foto_profil',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === 'Admin';
    }

    public function isSiswa()
    {
        return $this->role === 'Siswa';
    }

    // Relasi
    public function complaints()
    {
        return $this->hasMany(Complaint::class, 'user_id');
    }

    public function processedComplaints()
    {
        return $this->hasMany(Complaint::class, 'admin_id');
    }
}