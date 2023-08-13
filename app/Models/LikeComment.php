<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    use HasFactory;
    Protected $table = 'like_comment';
    protected $fillable = [
        'like',
        'dislike',
        'comment_id',
        'user_id',
    ];
}
