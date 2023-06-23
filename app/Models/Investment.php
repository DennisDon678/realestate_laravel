<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'user_id',
        'amount',
        'status',
        'plan_percent',
        'start_date',
        'end_date',
        'last_check',
        'earned',
        'duration'
    ];
}
