<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecureNote extends Model
{
    protected $fillable = [
        'user_id',
        'folder_id',
        'title',
        'content_encrypted',
    ];

    protected $casts = [
        'content_encrypted' => 'encrypted',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
