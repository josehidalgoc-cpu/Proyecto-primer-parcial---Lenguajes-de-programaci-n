<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'cardholder_name',
        'card_number_encrypted',
        'expiry_month',
        'expiry_year',
        'cvv_encrypted',
        'brand',
        'notes',
    ];

    protected $casts = [
        'card_number_encrypted' => 'encrypted',
        'cvv_encrypted'         => 'encrypted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
