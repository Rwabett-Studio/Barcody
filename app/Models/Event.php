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
        'wa_template_name',
        'wa_template_language',
        'wa_template_params',
        'wa_template_header_image',
        'confirmed',
        'canceled',
        'failed',
        'scanned',
        'user_id' // Add this to track which user created the event
    ];

    protected $casts = [
        'wa_template_params' => 'array',
    ];

    /**
     * Does this event have a WhatsApp template configured?
     */
    public function hasWaTemplate(): bool
    {
        return !empty($this->wa_template_name);
    }

    /**
     * Build the ordered template parameters for a given contact,
     * replacing placeholders like {contact_name}, {invite_link}, etc.
     */
    public function buildTemplateParams(Contact $contact, string $inviteLink): array
    {
        $map = [
            '{contact_name}'   => $contact->name,
            '{event_name}'     => $this->name,
            '{event_date}'     => $this->date,
            '{event_time}'     => $this->time,
            '{event_location}' => $this->location,
            '{invite_link}'    => $inviteLink,
            '{guests_count}'   => $contact->guests_count,
        ];

        $params = $this->wa_template_params ?: [];

        return array_map(function ($p) use ($map) {
            return strtr((string) $p, $map);
        }, $params);
    }

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