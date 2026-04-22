<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale_Detail extends Model
{
    protected $table = 'sale__details';
    protected $fillable = ['id_penjualan', 'id_barang', 'harga_jual', 'jumlah_jual', 'subtotal'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'id_penjualan');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_barang');
    }
}
