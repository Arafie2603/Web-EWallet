<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akun extends Model
{
    use HasFactory;
    protected $table = "akuns";
    protected $primaryKey = "id_akun";
    protected $fillable = ['id_akun','no_telp', 'poin', 'saldo'];
    public $timestamps = true;
    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
    public function rewarddetail()
    {
        return $this->hasMany(RewardDetail::class, 'akun_id', 'id_akun');
    }
    public function reward()
    {
        return $this->hasMany(Reward::class, 'akun_id', 'id_akun');
    }
}
