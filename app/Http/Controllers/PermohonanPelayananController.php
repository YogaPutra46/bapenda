<?php

namespace App\Http\Controllers;

use App\Models\PermohonanPelayanan;
use Illuminate\Http\Request;

class PermohonanPelayananController extends Controller
{
    public function create()
    {
        return view('permohonan.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'npwpd' => 'required|string|max:255',
            'nopd' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'tanggal_penerbitan' => 'required|date',
            'file_surat_permohonan' => 'nullable|file|mimes:pdf,jpeg,jpg,png',
            'file_sktpd' => 'nullable|file|mimes:pdf,jpeg,jpg,png',
            'file_sspd' => 'nullable|file|mimes:pdf,jpeg,jpg,png',
            'file_laporan_keuangan' => 'nullable|file|mimes:pdf,jpeg,jpg,png',
            'file_bukti_pendukung' => 'nullable|file|mimes:pdf,jpeg,jpg,png',
        ]);

        // Simpan file jika ada
        $files = [];
        foreach (['file_surat_permohonan', 'file_sktpd', 'file_sspd', 'file_laporan_keuangan', 'file_bukti_pendukung'] as $file) {
            if ($request->hasFile($file)) {
                $files[$file] = $request->file($file)->store('documents');
            }
        }

        // Menambahkan user_id dari pengguna yang sedang login
        $validated['user_id'] = auth()->user()->id_user;

        // Simpan data permohonan ke database
        PermohonanPelayanan::create(array_merge($validated, $files));

        // Redirect ke halaman permohonan.create dengan pesan sukses
        return back()->with('success', 'Permohonan berhasil diajukan');
    }


    // Display list of permohonan (for admin validation)
    public function index()
    {
        // Mengambil data permohonan yang belum divalidasi
        $permohonans = PermohonanPelayanan::with('user')->where('status', '!=', 'divalidasi')->get();


        // Kirimkan data ke view
        return view('SPTPD', compact('permohonans'));
    }

    // Update status permohonan menjadi 'divalidasi' setelah ditinjau oleh admin
    public function validatePermohonan($id)
    {
        $permohonan = PermohonanPelayanan::find($id);

        if (!$permohonan) {
            return redirect()->back()->withErrors('Data tidak ditemukan.');
        }

        // Cek apakah ini admin atau user yang melakukan validasi
        if (auth('admin')->check()) {
            // Jika admin, set status menjadi divalidasi
            $permohonan->status = 'divalidasi';
        } else {
            // Jika user, lakukan proses validasi sesuai dengan aturan
            $permohonan->status = 'user_divalidasi';
        }

        $permohonan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.sptpd')->with('success', 'Permohonan berhasil divalidasi');
    }




    // Mencari permohonan berdasarkan NPWPD
    public function search($npwpd)
    {
        // Cari data berdasarkan NPWPD
        $data = PermohonanPelayanan::where('npwpd', $npwpd)->first();

        if ($data) {
            // Jika data ditemukan, kirimkan data tersebut dalam format JSON
            return response()->json([
                'nama' => $data->nama_pemohon,
                'npwpd' => $data->npwpd,
                'nopd' => $data->nopd,
                'alamat' => $data->alamat, // Pastikan ada kolom alamat di tabel
                'catatan' => $data->catatan, // Pastikan ada kolom catatan di tabel
            ]);
        } else {
            // Jika data tidak ditemukan, kirimkan response 404
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    public function detailPermohonan($id)
    {
        // Ambil permohonan berdasarkan id
        $permohonan = PermohonanPelayanan::find($id); // Mengambil data berdasarkan id permohonan

        // Jika data tidak ditemukan
        if (!$permohonan) {
            return redirect()->route('home')->with('error', 'Data permohonan tidak ditemukan');
        }

        // Kirimkan data ke view
        return view('permohonan.detail-permohonan', compact('permohonan'));
    }
}
