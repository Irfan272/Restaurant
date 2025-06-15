<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Rating;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $rating = Rating::with(['User', 'Menu'])->get();
        return view('rating.index', compact('rating'));
    }


    public function create()
    {
        $users = User::all();
        $menus = Menu::all();

        return view('rating.create', compact('users', 'menus'));
    }


    public function store(Request $request)
    {
        try {
                // Ambil user yang sedang login
        $userId = Auth::guard('user')->user()->id;

            $request->validate([
                // 'user_id' => 'required',
                'menu_id' => 'required',
                'nilai' => 'required|numeric',
                'komentar' => 'string|max:255',

            ]);

            $data = [

                'user_id' => $userId,
                'menu_id' => $request->input('menu_id'),
                'nilai' => $request->input('nilai'),
                'komentar' => $request->input('komentar'),
            ];

            Rating::create($data);

            return redirect()->back()->with('status', 'Data berhasil ditambah.');


        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }


  
}
