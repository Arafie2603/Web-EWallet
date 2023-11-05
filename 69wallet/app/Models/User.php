<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class User extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public function isAdmin()
    {
        return $this->role_id === 1; // Menggunakan kolom role untuk menandai status admin
    }

    public function accounts()
    {
        return $this->hasMany(Accounts::class);
    }

    public function akun()
    {
        return $this->hasOne(Akun::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function getAuthPassword()
    {
        return $this->password;
    }
}
