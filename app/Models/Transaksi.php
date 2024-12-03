<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    // Menonaktifkan pengelolaan otomatis timestamp (created_at, updated_at)
    public $timestamps = false;

    protected $fillable = [
        'tanggal_pembelian',
        'total_harga',
        'bayar',
        'kembalian',
    ];

    public function transaksidetail()
    {
        // Relasi one-to-many dengan TransaksiDetail
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi', 'id');
    }
}

