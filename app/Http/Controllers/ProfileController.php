<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan formulir edit profil pengguna.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Perbarui informasi profil pengguna.
     */
    public function update(Request $request): RedirectResponse
    {
        // Mendapatkan pengguna yang sedang terautentikasi
        $user = $request->user();

        // Validasi data yang masuk dari formulir, termasuk validasi unik untuk 'name' dan 'nim'
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'full_name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'current_password' => ['required', 'string'],
        ]);

        // Memeriksa apakah kata sandi yang dimasukkan cocok dengan kata sandi pengguna
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            // Jika kata sandi tidak cocok, kembalikan dengan pesan error
            return back()->withErrors(['current_password' => 'Kata sandi yang Anda masukkan salah.']);
        }

        // Perbarui data pengguna di database
        $user->fill([
            'name' => $validatedData['name'],
            'full_name' => $validatedData['full_name'],
            'nim' => $validatedData['nim'],
            'birth_place' => $validatedData['birth_place'],
            'birth_date' => $validatedData['birth_date'],
        ]);
        
        // Simpan perubahan ke database
        $user->save();

        // Kembalikan ke halaman edit profil dengan pesan sukses
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
