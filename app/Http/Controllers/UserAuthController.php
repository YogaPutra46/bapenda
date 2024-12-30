<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    // Form registrasi
    public function RegisForm()
    {
        return view('register');
    }

    // Menangani registrasi
    public function RegisAction(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_user' => 'required',
            'email' => 'required|unique:tb_user',
            'telepon' => 'required',
            'password' => 'required'
        ]);

        // Menyimpan data user
        $user = new User([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('login')->with('msg', 'Data berhasil ditambah');
    }

    // Menampilkan form login
    function loginFrom()
    {
        return view('login');
    }

    // Menangani login
    function loginAction(Request $request)
    {
        // Mencoba login user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Regenerasi session setelah login
            $request->session()->regenerate();
            return redirect()->route('home');  // Redirect ke halaman home setelah login
        } else {
            return back()->withErrors(['Kombinasi Username dan Password SALAH!!!']);
        }
    }

    // Logout
    function logout(Request $request)
    {
        Auth::logout();  // Logout user
        $request->session()->invalidate();  // Hapus session user
        return redirect()->route('home');  // Redirect setelah logout
    }

    // Menampilkan form untuk mengganti password
    public function changePassword()
    {
        return view('change-password');
    }

    /**
     * Proses permintaan ganti password.
     */
    public function processChangePassword(Request $request)
    {
        // Validasi input password
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|different:oldPassword', // Minimal 8 karakter dan berbeda dari password lama
            'repeatPassword' => 'required|same:newPassword', // Harus sama dengan newPassword
        ], [
            'oldPassword.required' => 'Kata sandi lama harus diisi.',
            'newPassword.required' => 'Kata sandi baru harus diisi.',
            'newPassword.different' => 'Kata sandi baru tidak boleh sama dengan kata sandi lama.',
            'repeatPassword.required' => 'Konfirmasi kata sandi harus diisi.',
            'repeatPassword.same' => 'Konfirmasi kata sandi tidak cocok dengan kata sandi baru.',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Periksa apakah password lama cocok
        if (!Hash::check($request->oldPassword, Auth::user()->password)) {
            return back()->withErrors(['oldPassword' => 'Kata sandi lama salah.'])->withInput();
        }

        // Update password
        $user = Auth::user();
        $user->password = Hash::make($request->newPassword);
        $user->save();

        // Redirect ke profil dengan pesan sukses
        return redirect()->route('home')->with('success', 'Kata sandi berhasil diubah!');
    }

    // Halaman home setelah login
    public function home()
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
        $permohonan = $user->permohonan;  // Ambil permohonan yang terkait dengan pengguna yang sedang login

        // Mengubah tanggal_pengajuan menjadi objek Carbon
        $permohonan = $permohonan->map(function ($item) {
            $item->tanggal_pengajuan = Carbon::parse($item->tanggal_pengajuan); // Mengubah menjadi objek Carbon
            return $item;
        });

        return view('home', compact('user', 'permohonan'));  // Mengirimkan variabel user dan permohonan ke view
    }

    // Halaman quisioner
    public function quisioner()
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
        return view('quisioner', compact('user'));  // Mengirimkan variabel user ke view
    }

    public function pelayanan()
    {
        $user = Auth::user();  // Mendapatkan pengguna yang sedang login
        return view('pelayanan', compact('user'));  // Mengirimkan variabel user ke view
    }

    
}
