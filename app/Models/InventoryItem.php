<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'outlet_id',
        'name',
        'stock',
        'min_stock',
        'unit',
        'status',
    ];

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }
}
