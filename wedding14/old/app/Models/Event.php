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
    ];


    


        // Relationship with Categories (Many-to-Many)
        public function category()
        {
            return $this->belongsTo(Category::class);
        }
    
        // Relationship with Attendees (One-to-Many)
        public function attendees()
        {
            return $this->hasMany(Attendee::class);
        }


}
