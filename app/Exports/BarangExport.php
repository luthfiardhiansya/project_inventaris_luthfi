<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BarangExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Barang::with(['kategori', 'lokasi'])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Lokasi',
            'Jumlah',
            'Satuan',
            'Kondisi',
        ];
    }

    public function map($barang): array
    {
        return [
            $barang->kode_barang,
            $barang->nama_barang,
            $barang->kategori?->nama ?? '-',
            $barang->lokasi?->nama ?? '-',
            $barang->jumlah,
            $barang->satuan,
            ucfirst(str_replace('_', ' ', $barang->kondisi)),
        ];
    }
}
