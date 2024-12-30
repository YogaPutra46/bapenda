<!-- resources/views/permohonan/form.blade.php -->

<form action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h2 class="text-2xl font-bold text-center text-red-800 mb-6">Form Permohonan Keberatan Pajak Daerah</h2>

    <button id="backBtn" class="px-4 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-300 mb-4">Back</button>
    <!-- Form permohonan -->
    <div class="mb-4">
        <label for="nama_pemohon" class="block text-sm font-medium text-gray-700">Nama Pemohon</label>
        <input type="text" name="nama_pemohon" id="nama_pemohon" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800" required>
    </div>

    <div class="mb-4">
        <label for="npwpd" class="block text-sm font-medium text-gray-700">NPWPD</label>
        <input type="text" name="npwpd" id="npwpd" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800" required>
    </div>

    <div class="mb-4">
        <label for="nopd" class="block text-sm font-medium text-gray-700">NOPD</label>
        <input type="text" name="nopd" id="nopd" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800" required>
    </div>

    <div class="mb-4">
        <label for="tanggal_pengajuan" class="block text-sm font-medium text-gray-700">Tanggal Pengajuan</label>
        <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800" required>
    </div>

    <div class="mb-4">
        <label for="tanggal_penerbitan" class="block text-sm font-medium text-gray-700">Tanggal Penerbitan</label>
        <input type="date" name="tanggal_penerbitan" id="tanggal_penerbitan" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800" required>
    </div>

    <div class="mb-4">
        <label for="file_surat_permohonan" class="block text-sm font-medium text-gray-700">File Surat Permohonan</label>
        <input type="file" name="file_surat_permohonan" id="file_surat_permohonan" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800">
    </div>

    <div class="mb-4">
        <label for="file_sktpd" class="block text-sm font-medium text-gray-700">File SKTPD</label>
        <input type="file" name="file_sktpd" id="file_sktpd" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800">
    </div>

    <div class="mb-4">
        <label for="file_sspd" class="block text-sm font-medium text-gray-700">File SSPPD</label>
        <input type="file" name="file_sspd" id="file_sspd" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800">
    </div>

    <div class="mb-4">
        <label for="file_laporan_keuangan" class="block text-sm font-medium text-gray-700">File Laporan Keuangan</label>
        <input type="file" name="file_laporan_keuangan" id="file_laporan_keuangan" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800">
    </div>

    <div class="mb-4">
        <label for="file_bukti_pendukung" class="block text-sm font-medium text-gray-700">File Bukti Pendukung</label>
        <input type="file" name="file_bukti_pendukung" id="file_bukti_pendukung" class="mt-1 block w-full border-2 border-red-800 rounded-md focus:outline-none focus:ring-2 focus:ring-red-800">
    </div>

    <div class="mb-4">
        <button type="submit" class="px-4 py-2 bg-red-800 text-white rounded-md hover:bg-red-700">Ajukan Permohonan</button>
    </div>
</form>