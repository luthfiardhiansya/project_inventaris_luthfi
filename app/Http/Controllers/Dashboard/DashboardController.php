<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /* ===============================
           GRAFIK PEMINJAMAN 7 HARI
        =============================== */
        $peminjaman = Peminjaman::select(
                DB::raw('DATE(tanggal_pinjam) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_pinjam', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labels = [];
        $data   = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            $labels[] = Carbon::now()->subDays($i)->format('d M');
            $found = $peminjaman->firstWhere('tanggal', $date);

            $data[] = $found ? $found->total : 0;
        }

        /* ===============================
           STATISTIK DASHBOARD
        =============================== */
        $totalBarang = Barang::count();

        $barangBaik = Barang::where('kondisi', 'baik')->count();

        $barangRusak = Barang::whereIn('kondisi', [
            'rusak_ringan',
            'rusak_berat'
        ])->count();

        $barangHilang = Barang::where('kondisi', 'hilang')->count();

        $barangDipinjam = Peminjaman::where('status', 'dipinjam')->count();

        $totalPeminjaman = Peminjaman::count();

        $peminjamanHariIni = Peminjaman::whereDate(
            'tanggal_pinjam',
            today()
        )->count();

        return view('dashboard.index', compact(
            'labels',
            'data',
            'totalBarang',
            'barangBaik',
            'barangRusak',
            'barangHilang',
            'barangDipinjam',
            'totalPeminjaman',
            'peminjamanHariIni'
        ));
    }
}
