<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    use HasFactory;
    protected $fillable = [
        'movieId',
        'average',
        'star1',
        'star2',
        'star3',
        'star4',
        'star5',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
}
