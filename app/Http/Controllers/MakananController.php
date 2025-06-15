<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MakananController extends Controller
{
    public function index()
    {
        $menuBest = Menu::with('category')
            ->withAvg('rating', 'nilai') // ambil rata-rata rating
            ->whereHas('category', function ($query) {
                $query->where('nama_category', 'Makanan')
                    ->where('status', 'Aktif');
            })
            ->orderByDesc('rating_avg_nilai') // gunakan alias bawaan Laravel
            ->limit(3)
            ->get();

        $menu = Menu::with('category')
            ->withAvg('rating', 'nilai') // ambil rata-rata rating
            ->whereHas('category', function ($query) {
                $query->where('nama_category', 'Makanan')
                    ->where('status', 'Aktif');
            })
            ->orderByDesc('rating_avg_nilai') // gunakan alias bawaan Laravel
            // ->limit(3)
            ->get();

        return view('customer.makanan.index', compact('menuBest', 'menu'));
    }



    public function detail($id)
    {
        $menu = Menu::with('category')
            ->withAvg('rating', 'nilai')
            ->with('rating.user') // supaya kita bisa ambil komentar + nama user
            ->findOrFail($id);

        return view('customer.makanan.detail', compact('menu'));
    }



}
