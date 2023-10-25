<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = "kategoris";
    protected $primaryKey = "id_kategori";
    protected $fillable = ['id_kategori', 'nama_kategori', 'foto_kategori'];
    public $incrementing = false;
    public $timestamps = true;

    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
}
