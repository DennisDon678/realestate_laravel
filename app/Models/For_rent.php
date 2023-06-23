<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class For_rent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'property_id',
        'address',
        'price',
        'size',
        'bedrooms',
        'image1',
        'image2',
        'image3'
    ];
}
