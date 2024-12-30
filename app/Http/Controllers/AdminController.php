<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Sinkronkan data online jika perlu
        $admins = Admin::all(); // Ambil semua admin

        // Pastikan status online diperbarui
        foreach ($admins as $admin) {
            if (!$admin->is_online && $admin->last_activity_at && Carbon::now()->diffInMinutes($admin->last_activity_at) > 5) {
                $admin->update(['is_online' => false]); // Atur offline jika lebih dari 5 menit
            }
        }

        // Tetap gunakan pencarian jika ada
        $admins = Admin::where('username', 'like', '%' . $request->get('q') . '%')
            ->paginate(5)
            ->withQueryString();

        return view('kelola_admin.index', [
            'admins' => $admins,
            'q' => $request->get('q'),
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
            'name' => 'required|string',
            'username' => 'required|string|unique:admins,username',
            'password' => 'required|string|min:6',
        ]);

        Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('kelola_admin.index')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        return view('kelola_admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        return view('kelola_admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_admin)
    {
        $admin = Admin::findOrFail($id_admin);

        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:admins,username,' . $admin->id_admin,
            'password' => 'nullable|string|',
        ]);

        $admin->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('kelola_admin.index')->with('success', 'Admin berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_admin)
    {
        $admin = Admin::findOrFail($id_admin);
        $admin->delete();

        return redirect()->route('kelola_admin.index')->with('success', 'Admin berhasil dihapus');
    }
}
