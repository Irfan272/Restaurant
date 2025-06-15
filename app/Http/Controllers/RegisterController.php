<?php

namespace App\Http\Controllers;

use App\Models\Detail_User;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
   public function showRegisterForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'alamat' => 'required|string',
            'no_hp' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
        ]);

        // Simpan data ke tabel users
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Customer', // default role bisa diubah sesuai kebutuhan
        ]);

        // Simpan data ke tabel detail_users
        Detail_User::create([
            'user_id' => $user->id,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->route('showlogin')->with('status', 'Registrasi berhasil! Silakan login.');
    }
}
