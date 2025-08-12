<?php

namespace App\Http\Controllers;

use App\Models\Detail_Pesanan;
use App\Models\Menu;
use App\Models\Pesanan;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Tampilkan halaman keranjang
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        return view('customer.order.index', compact('keranjang'));
    }

    // Fungsi tambah ke keranjang
    public function tambah(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $jumlah = intval($request->input('jumlah', 1)); // support jumlah dinamis

        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$menu->id])) {
            $keranjang[$menu->id]['jumlah'] += $jumlah;
        } else {
            $keranjang[$menu->id] = [
                'id' => $menu->id,
                'nama' => $menu->nama_menu,
                'harga' => $menu->harga,
                'jumlah' => $jumlah,
                'gambar' => $menu->foto_menu,
            ];
        }

        session()->put('keranjang', $keranjang);

        return response()->json([
            'message' => "{$menu->nama_menu} berhasil ditambahkan ke keranjang"
        ]);
    }


    // Fungsi hapus item
    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect()->route('order.index')->with('status', 'Item berhasil dihapus');
    }

    // Fungsi reset keranjang
    public function reset()
    {
        session()->forget('keranjang');
        return redirect()->route('order.index')->with('status', 'Keranjang berhasil dikosongkan');
    }

    public function checkout()
    {
        $keranjang = session()->get('keranjang', []);

        if (count($keranjang) == 0) {
            return redirect()->route('order.index')->with('status', 'Keranjang masih kosong!');
        }

        $grandTotal = 0;
        foreach ($keranjang as $item) {
            $grandTotal += $item['harga'] * $item['jumlah'];
        }

        return view('customer.order.checkout', compact('keranjang', 'grandTotal'));
    }

    public function prosesCheckout(Request $request)
    {
        $keranjang = session()->get('keranjang', []);

        if (count($keranjang) == 0) {
            return redirect()->route('order.index')->with('status', 'Keranjang kosong!');
        }

        // Validasi dasar
        $request->validate([
            'jenis_pesanan' => 'required',
            'metode_pembayaran' => 'required',
            'uang_diterima' => 'nullable', // hanya diperlukan jika metode cash
            'catatan' => 'nullable|string',
            'nomor_meja' => 'required_if:jenis_pesanan,Dine In|nullable|string',
            'nama_pelanggan' => 'required_if:jenis_pesanan,Take Away|nullable|string',
        ]);

        $totalKeseluruhan = 0;
        foreach ($keranjang as $item) {
            $totalKeseluruhan += $item['harga'] * $item['jumlah'];
        }

        // Ambil user_id hanya jika jenis delivery
        $userId = $request->jenis_pesanan === 'Delivery'
            ? Auth::guard('user')->user()->id
            : null;

        // Simpan pesanan
        $pesanan = Pesanan::create([
            'user_id' => $userId,
            'tanggal_pesanan' => Carbon::now()->toDateString(),
            'waktu_pesanan' => Carbon::now()->toTimeString(),
            'status' => 'Pending',
            'jenis_pesanan' => $request->jenis_pesanan,
            'total_pesanan' => $totalKeseluruhan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'uang_diterima' => $this->convertRupiahToInt($request->uang_diterima),
            'catatan' => $request->catatan,
            'nomor_meja' => $request->jenis_pesanan === 'Dine In' ? $request->nomor_meja : null,
            'nama_pelanggan' => $request->jenis_pesanan === 'Take Away' ? $request->nama_pelanggan : null,
        ]);

        // Simpan detail pesanan
        foreach ($keranjang as $item) {
            Detail_Pesanan::create([
                'pesanan_id' => $pesanan->id,
                'menu_id' => $item['id'],
                'jumlah' => $item['jumlah'],
                'total' => $item['harga'] * $item['jumlah'],
            ]);
        }

        // Bersihkan keranjang
        session()->forget('keranjang');

        return redirect()->route('order.index')->with('status', 'Pesanan berhasil diproses!');
    }

    // Helper function (tambahkan di dalam controller)
    private function convertRupiahToInt($rupiah)
    {
        if (!$rupiah) {
            return 0;
        }

        return (int) preg_replace('/[^0-9]/', '', $rupiah);
    }
}


