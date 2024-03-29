<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieRating extends Model
{
    protected $primaryKey = 'movie_id';
    public $incrementing = false;
    protected $keyType = 'integer';

    use HasFactory;
    protected $fillable = [
        'movie_id',
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
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
    public function ratings(){
        return $this->hasMany(Rating::class);
    }
}
