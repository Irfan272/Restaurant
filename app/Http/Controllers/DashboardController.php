<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();

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

        return view('dashboard', compact(
            'totalPending',
            'totalProcessing',
            'totalCompleted',
            'totalCancelled'
        ));
    }
    public function indexCustomer()
    {
        return view('dashboardCustomer');
    }

}
