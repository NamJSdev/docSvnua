<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory;

    protected $fillable = ['docLink'];

    public function posts()
    {
        return $this->hasMany(Post::class, 'docID');
    }
}