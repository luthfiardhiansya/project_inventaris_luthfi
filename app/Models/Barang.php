<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori_id',
        'lokasi_id',
        'kondisi',
        'jumlah',
        'satuan',
        'tanggal_beli',
        'harga',
        'deskripsi',
        'foto'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}

