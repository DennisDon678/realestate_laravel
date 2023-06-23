<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paid_buy extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_id',
        'property_id',
        'paid_id',
        'paid_amount',
        'full_amount'
    ];
}
