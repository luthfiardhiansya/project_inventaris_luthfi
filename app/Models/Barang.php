<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; 

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

    protected $casts = [
        'tanggal_beli' => 'date',
    ];

    protected static function booted()
    {
        static::creating(function ($barang) {
            if (!$barang->tanggal_beli) {
                $barang->tanggal_beli = Carbon::today();
            }
        });
    }

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
        return $this->belongsToMany(Peminjaman::class, 'detail_peminjaman')
            ->withPivot('jumlah', 'kondisi_sebelum', 'kondisi_sesudah');
    }
}
