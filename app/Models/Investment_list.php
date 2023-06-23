<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment_list extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'basic_min',
        'basic_max',
        'basic_percent',
        'elite_min',
        'elite_max',
        'elite_percent',
        'pro_min',
        'pro_percent',
        'image',
        'size',
        'rooms'
    ];
}
