<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'title',
        'description',
        'icon1',
        'title1',
        'icon2',
        'title2',
        'icon3',
        'title3',
        'icon4',
        'title4',
        'image_app1',
        'image_app2',
        'main_image',
    ];
}
