<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $primaryKey = 'movie_id'; // or null

    public $incrementing = false;

    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'integer';

    use HasFactory;
    protected $fillable = [
        'rate',
        'movie_id',
        'userId',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
    ];
    public function phone()
    {
        return $this->hasOne(Phone::class);
    }
}
