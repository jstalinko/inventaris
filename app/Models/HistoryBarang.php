<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'barang_id',
        'total',
        'type',
        'note',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function karyawan()
    {
        return $this->hasOneThrough(Karyawan::class, User::class, 'id', 'user_id', 'user_id', 'id');
    }
}
