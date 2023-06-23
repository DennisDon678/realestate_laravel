<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit_address extends Model
{
    use HasFactory;
    protected $fillable = [
        'coin',
        'wallet'
    ];
}
