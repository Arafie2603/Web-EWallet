<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksis";
    protected $primaryKey = "id_transaksi";
    protected $fillable = ['id_transaksi','total_item', 'total_harga', 'akun_id'];
    public $timestamps = true;
    public $incrementing = false;

    public function akuns()
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'id_akun');
    }

    public function transaksidetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
