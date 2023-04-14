<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\TransaksiDetail;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'customer_id',
        'kode_transaksi',
    ];

    /**
     * Get the user that owns the Transaksi
     *
     *
     */

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id' , 'id');
    }
    public function transaksi_detail(){
        return $this->hasOne(TransaksiDetail::class, 'transaksi_id', 'id');
    }
}
