<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags', 'tagID', 'postID');
    }
}