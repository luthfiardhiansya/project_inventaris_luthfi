<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $table = 'lokasi';

    protected $fillable = ['nama', 'deskripsi'];

    public function barang()
    {
        return $this->hasMany(Barang::class);
    }
}

