<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = "transaksi_details";
    protected $primaryKey = "id_transaksi_detail";
    protected $fillable = ['id_transaksi_detail','transaksi_id', 'produk_id', 'harga_satuan', 'jumlah'];
    public $timestamps = true;
    public $incrementing = false;

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id_produk');
    }
}
