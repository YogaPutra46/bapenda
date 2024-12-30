<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    // Menampilkan form login admin
    public function showLoginForm()
    {
        return view('signin'); // Ganti dengan view form login admin Anda
    }

    // Proses login admin
    public function loginAdmin(Request $request)
    {
        // Validasi input dari form login
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Mencari admin berdasarkan username yang diinputkan
        $admin = Admin::where('username', $request->username)->first();

        // Jika admin ditemukan dan password yang dimasukkan valid
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Logout admin sebelumnya jika ada
            if (Auth::guard('admin')->check()) {
                $previousAdmin = Auth::guard('admin')->user();
                $previousAdmin->is_online = false;
                $previousAdmin->save();
                Log::info('Admin sebelumnya logout: ' . $previousAdmin->username);
            }

            // Login menggunakan guard 'admin'
            Auth::guard('admin')->login($admin);

            // Set admin sebagai online dan update waktu login terakhir
            $admin->is_online = true;
            $admin->last_login_at = now();
            $admin->save();

            // Log info bahwa admin berhasil login
            Log::info('Admin logged in successfully: ' . $admin->username);

            // Redirect ke dashboard admin atau halaman lain setelah login berhasil
            return redirect()->route('kelola_admin.index')->with('success', 'Berhasil Login');
        }

        // Log peringatan jika login gagal
        Log::warning('Login failed for: ' . $request->username);

        // Jika login gagal, kembalikan ke halaman login dengan error message
        return back()->withErrors(['username' => 'Username atau password salah'])->withInput();
    }

    // Logout admin
    public function Adminlogout(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if ($admin) {
            Log::info('Sebelum logout: ' . $admin->username . ' - Status Online: ' . $admin->is_online);

            // Set admin offline
            $admin->is_online = false;
            $admin->save();

            Log::info('Setelah logout: ' . $admin->username . ' - Status Online: ' . $admin->is_online);
        }

        // Logout tanpa DB transaction
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.signin')->with('success', 'Berhasil Logout');
    }
}
