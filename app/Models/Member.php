<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'whatsapp',
        'email',
        'password',
        'points_balance',
        'last_login_at',
    ];

    protected $casts = [
        'last_login_at' => 'datetime',
    ];

    public function preOrders()
    {
        return $this->hasMany(PreOrder::class);
    }

    public function pointRedemptions()
    {
        return $this->hasMany(PointRedemption::class);
    }
}
