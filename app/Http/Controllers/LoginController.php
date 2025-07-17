<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

   public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:50',
            'password' => 'required|string|max:50',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('user')->attempt($credentials)) {
            $user = Auth::guard('user')->user();

            $redirectTo = match ($user->role) {
                'Admin', 'Kasir', 'Koki', 'Pelayan', 'Owner' => '/dashboard',
                'Customer' => '/makanan',
                default => null,
            };

            if ($redirectTo) {
                return redirect('/')->with([
                    'success' => 'Berhasil Login',
                    'redirect_to' => $redirectTo,
                ]);
            } else {
                Auth::guard('user')->logout();
                return redirect('/')->withErrors(['role' => 'Role tidak valid'])->withInput();
            }
        } else {
            return redirect('/')->with('error', 'Email atau Password salah')->withInput();
        }
    }


    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
