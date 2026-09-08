<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'user_id',
        'category_id',
        'title',
        'location',
        'description',
        'photo',
        'status',
        'priority',
        'admin_id',
        'admin_response',
        'repair_photo',
        'processed_at',
        'completed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function histories()
    {
        return $this->hasMany(ComplaintStatusHistory::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }
}