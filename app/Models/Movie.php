<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'genre',
        'release_date',
        'duration',
        'director',
        'actors',
        'about',
        'image',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
        ];
}
