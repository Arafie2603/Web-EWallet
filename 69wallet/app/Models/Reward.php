<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $table = "rewards";
    protected $primaryKey = "id_reward";

    public function rewarddetail()
    {
        return $this->hasMany(RewardDetail::class, 'reward_id', 'id_reward');
    }

    public function akun()
    {
        return $this->hasMany(Akun::class, 'akun_id', 'id_akun');
    }
}
