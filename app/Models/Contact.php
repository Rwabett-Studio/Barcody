<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'phone',
        'event_id',
        'invitation_token',
        'invited',
        'status',
        'guests_count',
        'qr_path',
        'invited_at',
        'responded_at'
    ];

    // Status constants
    const STATUS_PENDING  = 'pending';
    const STATUS_ACCEPTED = 'accepted';   // سيحضر
    const STATUS_MAYBE    = 'maybe';       // احتمال يحضر
    const STATUS_DECLINED = 'declined';    // لن يحضر
    const STATUS_CANCELED = 'canceled';

    protected static function booted()
    {
        static::creating(function ($contact) {
            if (empty($contact->invitation_token)) {
                $contact->invitation_token = Str::random(40);
            }
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function markAsInvited()
    {
        $this->update([
            'invited' => true,
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

    public function markAsMaybe()
    {
        $this->update([
            'status' => self::STATUS_MAYBE,
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

    public function markAsCanceled()
    {
        $this->update([
            'status' => self::STATUS_CANCELED,
            'responded_at' => now()
        ]);
    }

    /**
     * Will this contact receive a QR code? (attending or maybe attending)
     */
    public function shouldReceiveQr(): bool
    {
        return in_array($this->status, [self::STATUS_ACCEPTED, self::STATUS_MAYBE]);
    }
}
