<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $table = 'movies';

    //thêm các trường cần upload
    protected $fillable = [
        'image',
        'title',
        'descriptions',
        'status',
        'country_id',
        'category_id',
        'genres_id',
        'perfomers',
        'views',
        'user_id',
        'year',
        'version',
    ];
    public function rates()
    {
        return $this->hasMany(Rate::class, 'movie_id');
    }
}
