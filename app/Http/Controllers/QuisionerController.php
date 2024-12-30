<?php

namespace App\Http\Controllers;

use App\Models\Responden;
use App\Models\Pelayanan;
use App\Models\Penilaian;
use App\Models\Quisioner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuisionerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $quisioners = Quisioner::with(['responden', 'pelayanan', 'penilaian'])->get();
        $data['title'] = 'Daftar Quisioner';
        $data['quisioners'] = $quisioners;
        $user = Auth::user();
        return view('quisioner', $data, compact('user'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = 'Tambah Quisioner';
        return view('quisioner', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'gender' => 'required|string',
            'age' => 'required|integer',
            'education' => 'required|string',
            'employment' => 'required|string',
            'tempat_kerja' => 'required|string',
            'jenis_layanan' => 'required|string',
            'soal1_A' => 'required|integer',
            'soal2_A' => 'required|integer',
            'soal3_A' => 'required|integer',
            'soal4_A' => 'required|integer',
            'soal5_A' => 'required|integer',
            'soal6_A' => 'required|integer',
            'soal7_A' => 'required|integer',
            'soal8_A' => 'required|integer',
            'soal1_B' => 'required|integer',
            'soal2_B' => 'required|integer',
            'soal3_B' => 'required|integer',
            'soal4_B' => 'required|integer',
            'soal5_B' => 'required|integer',
            'komentar' => 'nullable|string',
        ]);

        try {
            // Menyimpan data responden
            $responden = Responden::create([
                'gender' => $validatedData['gender'],
                'age' => $validatedData['age'],
                'education' => $validatedData['education'],
                'employment' => $validatedData['employment'],
            ]);

            // Menyimpan data pelayanan
            $pelayanan = Pelayanan::create([
                'tempat_kerja' => $validatedData['tempat_kerja'],
                'jenis_layanan' => $validatedData['jenis_layanan'],
            ]);

            // Menyimpan data penilaian
            $penilaian = Penilaian::create([
                'soal1_A' => $validatedData['soal1_A'],
                'soal2_A' => $validatedData['soal2_A'],
                'soal3_A' => $validatedData['soal3_A'],
                'soal4_A' => $validatedData['soal4_A'],
                'soal5_A' => $validatedData['soal5_A'],
                'soal6_A' => $validatedData['soal6_A'],
                'soal7_A' => $validatedData['soal7_A'],
                'soal8_A' => $validatedData['soal8_A'],
                'soal1_B' => $validatedData['soal1_B'],
                'soal2_B' => $validatedData['soal2_B'],
                'soal3_B' => $validatedData['soal3_B'],
                'soal4_B' => $validatedData['soal4_B'],
                'soal5_B' => $validatedData['soal5_B'],
                'komentar' => $validatedData['komentar'],
            ]);

            // Menyimpan data quisioner
            Quisioner::create([
                'id_responden' => $responden->id_responden,
                'id_pelayanan' => $pelayanan->id_pelayanan,
                'id_penilaian' => $penilaian->id_penilaian,
            ]);

            return redirect()->route('home')->with('success', 'Quisioner berhasil dikirim');
        } catch (\Exception $e) {
            Log::error('Error saving quisioner: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Quisioner $quisioner)
    {
        // Logic untuk menampilkan detail quisioner
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quisioner $quisioner)
    {
        // Logic untuk menampilkan form edit quisioner
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quisioner $quisioner)
    {
        // Logic untuk memperbarui quisioner
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quisioner $quisioner)
    {
        // Logic untuk menghapus quisioner
    }
}
