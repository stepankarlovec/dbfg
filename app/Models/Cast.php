<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;
    protected $fillable = [
        'movie',
        'person',
        'role',
    ];
    protected $hidden = [
        'created_at', 'updated_at',
        ];
    public function movie(){
        return $this->belongsTo(Movie::class);
    }
}
