<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

   protected $fillable = [
        'name',
        'fav_icon',
        'header_logo',
        'footer_logo',
        'location',
        'maps',
    ];


}
