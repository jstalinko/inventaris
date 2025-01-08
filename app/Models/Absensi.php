<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'user_id',
        'karyawan_id',
        'note',
        'signature',
        'tanggal',
        'jam',
        'status'
    ];
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
