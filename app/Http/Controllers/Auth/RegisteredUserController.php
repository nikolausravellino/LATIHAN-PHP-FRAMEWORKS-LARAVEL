<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage; // WAJIB: Tambahkan facade Storage

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi Input Data & Foto
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'nim' => ['required', 'string', 'max:20', 'unique:' . User::class],
            'full_name' => ['required', 'string', 'max:255'],
            'birth_place' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'date'],
            'password' => ['required', 'confirmed', 'min:8'],
            
            // VALIDASI FOTO TAMBAHAN
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Wajib, format gambar, maks 2MB
        ]);

        $photo_path = null;

        // 2. Proses Upload Foto
        if ($request->hasFile('photo')) {
            // Simpan file ke direktori 'public/photos'
            // Laravel secara otomatis memberi nama file unik
            $path = $request->file('photo')->store('public/photos');
            
            // Simpan path relatif yang bisa diakses publik (storage/photos/namafile.jpg)
            // Kita perlu menghapus "public/" dari path agar URL publiknya benar
            $photo_path = str_replace('public/', '', $path);
        }

        // 3. Buat Pengguna Baru di Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'full_name' => $request->full_name,
            'birth_place' => $request->birth_place,
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
            'photo' => $photo_path, // SIMPAN PATH FOTO DI KOLOM BARU
        ]);

        event(new Registered($user));

        // Pendaftaran berhasil, arahkan ke login dengan pesan sukses
        return redirect(route('login'))->with('status', 'Pendaftaran berhasil! Silakan login.');
    }
}