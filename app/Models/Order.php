<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['tgl_pemesanan', 'id_user', 'status_pemesanan', 'status', 'metode_pembayaran', 'total_bayar', 'keterangan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function details()
    {
        return $this->hasMany(Order_Detail::class, 'id_order');
    }
}
