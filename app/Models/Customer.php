<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = [
        'nama_lengkap',
        'alamat_lengkap',
        'email',
        'no_hp',
        'password',
    ];

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi', 'id', 'transaksi_id');
    }
}
