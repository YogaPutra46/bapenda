<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Menyaring berdasarkan username dengan pencarian yang diberikan
        $users = User::where('email', 'like', '%' . $request->get('q') . '%')
            ->paginate(5)
            ->withQueryString();

        // Kirim data ke view
        return view('kelola_user.index', [
            'users' => $users, // Pastikan menggunakan 'admins' sebagai nama variabel
            'q' => $request->get('q') // Pastikan $q ada
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola_admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_user' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'telepon' => 'required|integer|min:8',
        ]);

        Admin::create([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('kelola_user.index')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_user)
    {
        $admin = Admin::findOrFail($id_user);
        return view('kelola_user.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_user)
    {
        $admin = Admin::findOrFail($id_user);
        return view('kelola_user.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_user)
    {
        $user = Admin::findOrFail($id_user);

        $request->validate([
            'nama_user' => 'required|string',
            'email' => 'required|string|unique:users,email,' . $user->id_user,
            'telepon' => 'required|string|',
            'password' => 'nullable|string|',
        ]);

        $user->update([
            'nama_user' => $request->nama_user,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        return redirect()->route('kelola_user.index')->with('success', 'Admin berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_user)
    {
        $id_user = User::findOrFail($id_user);
        $id_user->delete();

        return redirect()->route('kelola_user.index')->with('success', 'Admin berhasil dihapus');
    }
    
}
