<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
    $totalPending = Pesanan::where('status', 'Pending')->count();
    $totalProcessing = Pesanan::where('status', 'Processing')->count();
    $totalCompleted = Pesanan::where('status', 'Completed')->count();
    $totalCancelled = Pesanan::where('status', 'Cancelled')->count();

    return view('dashboard', compact('totalPending', 'totalProcessing', 'totalCompleted', 'totalCancelled'));
}

}
