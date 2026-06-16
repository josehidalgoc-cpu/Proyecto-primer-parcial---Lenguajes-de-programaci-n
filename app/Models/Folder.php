<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $fillable = [
        'user_id',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function secureNotes()
    {
        return $this->hasMany(SecureNote::class);
    }

    public function identities()
    {
        return $this->hasMany(Identity::class);
    }
}