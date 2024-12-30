<form>
    @csrf
    <h2 class="text-2xl font-bold text-center text-red-800 mb-6">Detail Permohonan Keberatan Pajak Daerah</h2>

    <button id="backBtn" type="button" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-300 mb-4">
        Back
    </button>

    @foreach($permohonan as $item)
        <!-- Input Field -->
        @foreach([
            ['id' => 'nama_pemohon', 'label' => 'Nama Pemohon', 'value' => $item->nama_pemohon],
            ['id' => 'npwpd', 'label' => 'NPWPD', 'value' => $item->npwpd],
            ['id' => 'nopd', 'label' => 'NOPD', 'value' => $item->nopd],
            ['id' => 'tanggal_pengajuan', 'label' => 'Tanggal Pengajuan', 'value' => $item->tanggal_pengajuan->format('Y-m-d')],
            ['id' => 'tanggal_penerbitan', 'label' => 'Tanggal Penerbitan', 'value' => $item->tanggal_penerbitan->format('Y-m-d')],
        ] as $field)
            <div class="mb-4">
                <label for="{{ $field['id'] }}" class="block text-sm font-medium text-gray-700">
                    {{ $field['label'] }}
                </label>
                <input type="text" id="{{ $field['id'] }}" value="{{ $field['value'] }}" 
                    class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800" readonly>
            </div>
        @endforeach

        <!-- File Fields -->
        @foreach([
            ['id' => 'file_surat_permohonan', 'label' => 'File Surat Permohonan', 'file' => $item->file_surat_permohonan],
            ['id' => 'file_sktpd', 'label' => 'File SKTPD', 'file' => $item->file_sktpd],
            ['id' => 'file_sspd', 'label' => 'File SSPPD', 'file' => $item->file_sspd],
            ['id' => 'file_laporan_keuangan', 'label' => 'File Laporan Keuangan', 'file' => $item->file_laporan_keuangan],
            ['id' => 'file_bukti_pendukung', 'label' => 'File Bukti Pendukung', 'file' => $item->file_bukti_pendukung],
        ] as $fileField)
            <div class="mb-4">
                <label for="{{ $fileField['id'] }}" class="block text-sm font-medium text-gray-700">
                    {{ $fileField['label'] }}
                </label>
                <a href="{{ asset('storage/' . $fileField['file']) }}" target="_blank" 
                    class="block mt-1 text-blue-600 underline">
                    {{ $fileField['file'] }}
                </a>
            </div>
        @endforeach
    @endforeach
</form>
