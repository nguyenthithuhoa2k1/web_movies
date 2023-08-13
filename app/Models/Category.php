<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    //thêm các trường cần upload
    protected $fillable = [
        'category',
        'level',
        'version'
    ];
}



