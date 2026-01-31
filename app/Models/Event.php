<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'thumbnail_image',
        'date',
        'time',
        'location',
        'maps',
        'category_id',
        'qr_code',
        'status',
        'confirmed',
        'canceled',
        'failed',
        'scanned',
        'user_id' // Add this to track which user created the event
    ];

// Relationship with User (Many-to-One)
public function user()
{
    return $this->belongsTo(User::class);
}

// Relationship with Category (Many-to-One)
public function category()
{
    return $this->belongsTo(Category::class);
}

    // Relationship with Attendees (One-to-Many)
    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}