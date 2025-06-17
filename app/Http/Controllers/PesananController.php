<?php

namespace App\Http\Controllers;

use App\Models\Detail_Pesanan;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use DB;
use Barryvdh\DomPDF\Facade\Pdf;


class PesananController extends Controller
{
    public function index()
    {
        // Ambil user yang sedang login
        $user = Auth::guard('user')->user();

        if ($user->role === 'Customer') {
            $pesanans = Pesanan::with('User')
                ->where('user_id', $user->id)
                ->orderBy('tanggal_pesanan', 'desc')
                ->orderBy('waktu_pesanan', 'desc')
                ->get();

            return view("pesanan.index", compact("pesanans"));
        } else if ($user->role === 'Koki') {
            $pesanans = Pesanan::with('User')
                // ->where('jenis_pesanan', 'Delivery')
                ->where('status', 'Processing')
                ->orderBy('tanggal_pesanan', 'desc')
                ->orderBy('waktu_pesanan', 'desc')
                ->get();

            return view("pesanan.index", compact("pesanans"));
        } else if ($user->role === 'Pelayan') {
            $pesanans = Pesanan::with('User')
                ->where('jenis_pesanan', 'Delivery')
                ->where('status', 'Delivered')
                ->orderBy('tanggal_pesanan', 'desc')
                ->orderBy('waktu_pesanan', 'desc')
                ->get();

            return view("pesanan.index", compact("pesanans"));
        } else {
            $pesanans = Pesanan::with('User')->orderBy('tanggal_pesanan', 'desc')
                ->orderBy('waktu_pesanan', 'desc')
                ->get();
            return view("pesanan.index", compact("pesanans"));
        }


    }



    public function edit($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanan'])->findOrFail($id);


        return view("pesanan.edit", compact("pesanan"));
    }

    public function update(Request $request, $id)
    {
        // Validasi hanya untuk field status
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        // Cari pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);

        // Update status saja
        $pesanan->update([
            'status' => $request->status,
        ]);

        return redirect('/pesanan')->with('status', 'Status pesanan berhasil diperbarui.');
    }

    public function view($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanan'])->findOrFail($id);


        return view("pesanan.view", compact("pesanan"));
    }

    public function cetakStruk($id)
    {
        $pesanan = Pesanan::with(['user', 'detailPesanan.menu'])->findOrFail($id);

        $pdf = Pdf::loadView('pesanan.struk', compact('pesanan'))->setPaper('A4', 'portrait');

        return $pdf->download('struk-pesanan-' . $pesanan->id . '.pdf');
    }
}
