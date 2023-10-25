<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = "produks";
    protected $primaryKey = "id_produk";

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id','id_kategori');
    }

    public function transaksidetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
