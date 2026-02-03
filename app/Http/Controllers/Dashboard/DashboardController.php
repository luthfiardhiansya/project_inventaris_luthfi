<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::select(
                DB::raw('DATE(tanggal_pinjam) as tanggal'),
                DB::raw('COUNT(*) as total')
            )
            ->where('tanggal_pinjam', '>=', Carbon::now()->subDays(6))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        $labels = [];
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');

            $labels[] = Carbon::now()->subDays($i)->format('d M');
            $found = $peminjaman->firstWhere('tanggal', $date);

            $data[] = $found ? $found->total : 0;
        }

        return view('dashboard.index', compact('labels', 'data'));
    }
}
