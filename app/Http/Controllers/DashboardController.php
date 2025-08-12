<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\Detail_Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

        // Statistik status pesanan hari ini
        $totalPending = Pesanan::where('status', 'Pending')
            ->whereDate('tanggal_pesanan', $today)
            ->count();

        $totalProcessing = Pesanan::where('status', 'Processing')
            ->whereDate('tanggal_pesanan', $today)
            ->count();

        $totalCompleted = Pesanan::where('status', 'Completed')
            ->whereDate('tanggal_pesanan', $today)
            ->count();

        $totalCancelled = Pesanan::where('status', 'Cancelled')
            ->whereDate('tanggal_pesanan', $today)
            ->count();

        // Grafik 1: Top 5 Menu Terjual dalam 7 Hari
        $tanggalMulai = Carbon::now()->subDays(6)->toDateString(); // dari 6 hari lalu sampai hari ini
        $topMenus = Detail_Pesanan::select('menu_id', DB::raw('SUM(jumlah) as total_terjual'))
            ->whereHas('pesanan', function ($query) use ($tanggalMulai) {
                $query->where('tanggal_pesanan', '>=', $tanggalMulai);
            })
            ->groupBy('menu_id')
            ->orderByDesc('total_terjual')
            ->with('menu')
            ->limit(5)
            ->get();

        $menuLabels = $topMenus->pluck('menu.nama_menu')->toArray();
        $menuJumlah = $topMenus->pluck('total_terjual')->toArray();

        // var_dump($menuJumlah);
        // dd([
        //     'menuLabels' => $menuLabels,
        //     'menuJumlah' => $menuJumlah,
        //     'topMenus' => $topMenus,
        // ]);

        // Grafik 2: Menu Rating Tertinggi
        $menuRating = Menu::withAvg('rating', 'nilai')
            ->orderByDesc('rating_avg_nilai')
            ->limit(5)
            ->get();

        $ratingLabels = $menuRating->pluck('nama_menu')->toArray();
        $ratingNilai = $menuRating->pluck('rating_avg_nilai')->map(fn($v) => round($v, 2))->toArray();

        return view('dashboard', compact(
            'totalPending',
            'totalProcessing',
            'totalCompleted',
            'totalCancelled',
            'menuLabels',
            'menuJumlah',
            'ratingLabels',
            'ratingNilai'
        ));
    }

    public function indexCustomer()
    {
        return view('dashboardCustomer');
    }
}
