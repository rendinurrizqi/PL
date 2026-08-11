<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointRedemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'point_reward_id',
        'points_used',
        'redemption_code',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function reward()
    {
        return $this->belongsTo(PointReward::class, 'point_reward_id');
    }
}
