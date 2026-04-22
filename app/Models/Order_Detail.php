<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $table = 'order__details';
    protected $fillable = ['id_pemesanan', 'id_barang', 'harga_jual', 'jumlah_jual', 'subtotal'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_pemesanan');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_barang');
    }
}
