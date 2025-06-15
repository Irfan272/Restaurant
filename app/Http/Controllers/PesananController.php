<?php

namespace App\Http\Controllers;

use App\Models\Detail_Pesanan;
use App\Models\Meja;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use DB;


class PesananController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::with('User')->get();
        return view("pesanan.index", compact("pesanans"));
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
}
