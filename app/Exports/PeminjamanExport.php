<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $rows = [];

        $peminjaman = Peminjaman::with(['barang', 'user'])->get();

        foreach ($peminjaman as $pinjam) {
            foreach ($pinjam->barang as $barang) {
                $rows[] = [
                    'kode_peminjaman' => $pinjam->kode_peminjaman,
                    'nama_peminjam'  => $pinjam->nama_peminjam,
                    'jenis_peminjam' => $pinjam->jenis_peminjam,
                    'nama_barang'    => $barang->nama_barang,
                    'jumlah'         => $barang->pivot->jumlah,
                    'kondisi_awal'   => $barang->pivot->kondisi_sebelum,
                    'tanggal_pinjam' => $pinjam->tanggal_pinjam,
                    'tanggal_kembali'=> $pinjam->tanggal_kembali,
                    'status'         => $pinjam->status,
                    'petugas'        => $pinjam->user->name ?? '-',
                ];
            }
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return [
            'Kode Peminjaman',
            'Nama Peminjam',
            'Jenis Peminjam',
            'Nama Barang',
            'Jumlah',
            'Kondisi Awal',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
            'User',
        ];
    }
}
