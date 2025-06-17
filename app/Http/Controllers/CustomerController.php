<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $akun = User::with('detailUser')->whereIn('role', ['Customer'])->get();
        return view('customer.list-customer', compact('akun'));
    }

    public function edit($id)
    {
        $akun = User::with('detailUser')->findOrFail($id);

        return view('customer.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        try {
            $akun = User::with('detailUser')->findOrFail($id);

            // Validasi utama user
            $validatedUser = $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($akun->id)],
                'password' => 'sometimes|nullable|string|max:20',
                // 'role' => 'required|string|max:255',
            ]);

            // Enkripsi password jika diisi
            if ($request->filled('password')) {
                $validatedUser['password'] = Hash::make($request->password);
            } else {
                unset($validatedUser['password']);
            }

            // Update user
            $akun->update($validatedUser);

            // Validasi dan update/insert detail user
            $validatedDetail = $request->validate([
                'alamat' => 'nullable|string|max:255',
                'no_hp' => 'nullable|string|max:20',
                'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
                'tanggal_lahir' => 'nullable|date',
            ]);

            // Update or create detail user
            $akun->detailUser()->updateOrCreate(
                ['user_id' => $akun->id],
                $validatedDetail
            );

            return redirect('/makanan')->with('status', 'Data akun berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

}
