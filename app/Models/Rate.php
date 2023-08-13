<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    use HasFactory;
    protected $table = "rate";
    protected $fillable = [
        'rate',
        'user_id',
        'movie_id',
    ];
    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
