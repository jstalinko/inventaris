<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'stock',
        'sisa_stock',
        'warna'
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
