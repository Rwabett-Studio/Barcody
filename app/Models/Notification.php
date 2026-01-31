<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_id',
        'event_id',
        'type',
        'message',
        'status',
        'read_at'
    ];

    // Notification types
    const TYPE_INVITATION = 'invitation';
    const TYPE_RESPONSE = 'response';
    const TYPE_REMINDER = 'reminder';

    // Relationships
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Helper methods
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }
}