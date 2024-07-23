<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'desc', 'docID', 'privacy', 'accountID', 'categoryID','view', 'status'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID');
    }

    public function doc()
    {
        return $this->belongsTo(Doc::class, 'docID');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'postID', 'categoryID');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'postID', 'tagID');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'postID');
    }
}