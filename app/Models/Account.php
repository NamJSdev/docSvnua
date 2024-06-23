<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'email', 'password', 'roleID', 'infoID', 'status', 'email_verified_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleID');
    }

    public function info()
    {
        return $this->belongsTo(Info::class, 'infoID');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'accountID');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'accountID');
    }
}