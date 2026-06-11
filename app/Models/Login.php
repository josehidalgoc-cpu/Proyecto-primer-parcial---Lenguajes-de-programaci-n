<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'username',
        'password_encrypted',
        'url',
        'notes',
    ];
    protected $casts = [
        'password_encrypted' => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
