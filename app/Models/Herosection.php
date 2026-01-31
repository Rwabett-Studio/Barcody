<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Herosection extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'main_image',
        'image1',
        'image2',
    ];
}
