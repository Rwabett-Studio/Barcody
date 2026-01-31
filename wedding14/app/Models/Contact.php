<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'phone',
        'event_id',
        'invited',
        'status',
        'invited_at',
        'responded_at'
    ];

    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_DECLINED = 'declined';

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function markAsInvited()
    {
        $this->update([
            'status' => self::STATUS_PENDING,
            'invited_at' => now()
        ]);
    }

    public function markAsAccepted()
    {
        $this->update([
            'status' => self::STATUS_ACCEPTED,
            'responded_at' => now()
        ]);
    }

    public function markAsDeclined()
    {
        $this->update([
            'status' => self::STATUS_DECLINED,
            'responded_at' => now()
        ]);
    }
}