<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'category',
        'age_group',
        'ingredients',
        'stock',
        'initial_stock',
        'image',
        'status',
        'custom_points',
    ];

    public function preOrderItems()
    {
        return $this->hasMany(PreOrderItem::class);
    }
}
