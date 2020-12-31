<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'user_id',
        'content',
        'rating',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function CommentRating()
    {
        return $this->hasMany(CommentRating::class);
    }
}
