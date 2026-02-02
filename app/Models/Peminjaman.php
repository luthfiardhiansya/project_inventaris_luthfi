<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $fillable = [
        'kode_peminjaman',
        'nama_peminjam',
        'jenis_peminjam',
        'barang_id',
        'jumlah',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'user_id'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

