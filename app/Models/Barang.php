<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'supplier_id',
        'nama_barang',
        'satuan',
        'stock',
        'price_modal',
        'price_sell',
        'code',
        'note',
        'gudang',
        'nomor_rak',
        'sisa_stock'
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
