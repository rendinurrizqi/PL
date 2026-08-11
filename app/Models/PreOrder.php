<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'outlet_id',
        'customer_name',
        'whatsapp',
        'total_amount',
        'pay_method',
        'is_paid',
        'is_taken',
        'cancel_status',
        'cancel_reason',
        'points_awarded',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class);
    }

    public function items()
    {
        return $this->hasMany(PreOrderItem::class);
    }
}
