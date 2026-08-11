<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointReward extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'points_cost',
        'description',
        'is_active',
    ];
}
