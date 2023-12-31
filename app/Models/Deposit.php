<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'user_id',
        'wallet_address',
        'coin',
        'coin_amount',
        'usd_amount',
        'url',
        'status',
        'expiration'
    ];
}
