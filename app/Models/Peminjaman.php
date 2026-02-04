<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_peminjaman',
        'nama_peminjam',
        'jenis_peminjam',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'user_id',
    ];

    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'detail_peminjaman')
            ->withPivot('jumlah', 'kondisi_sebelum', 'kondisi_sesudah');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
