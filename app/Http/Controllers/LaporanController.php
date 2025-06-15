<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view("laporan.index");
    }

    public function printPenjualan($tanggal_awal, $tanggal_akhir)
    {
        $tanggal_mulai = Carbon::parse($tanggal_awal)->startOfDay()->format('Y-m-d');
        $tanggal_terakhir = Carbon::parse($tanggal_akhir)->endOfDay()->format('Y-m-d');

        $pesanan = Pesanan::with(['user', 'detailPesanan.menu'])
            ->whereBetween('tanggal_pesanan', [$tanggal_mulai, $tanggal_terakhir])
            ->get();

        $total = $pesanan->count();
        $tanggal_cetak = Carbon::today()->format('d-m-Y');

        return view('laporan.cetak', compact('pesanan', 'total', 'tanggal_mulai', 'tanggal_terakhir', 'tanggal_cetak'));
    }

}
