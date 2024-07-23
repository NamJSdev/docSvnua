<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = ['postID', 'accountID'];

    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postID');
    }
}