<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_name',
        'product_ids',
    ];

    protected $casts = [
        'product_ids' => 'array',
    ];
}
