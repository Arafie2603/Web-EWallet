<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardDetail extends Model
{
    use HasFactory;

    public function reward()
    {
        return $this->belongsTo(Reward::class, 'reward_id', 'id_reward');
    }

    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'id_akun');
    }
}
