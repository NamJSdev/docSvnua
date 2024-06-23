<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'desc', 'RoleID'];

    public function accounts()
    {
        return $this->hasMany(Account::class, 'infoID');
    }
}