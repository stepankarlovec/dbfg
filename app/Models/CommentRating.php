<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'movie_id',
        'value',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }
}
