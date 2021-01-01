<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $fillable = [
        'rate',
        'movie_id',
        'user_id',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function movieRating(){
        return $this->belongsTo(MovieRating::class);
    }
}
