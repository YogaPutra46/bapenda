<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPTPD Dashboard</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100" x-data="{
        npwpd: '', 
        searchData: null,
        sidebarOpen: false,
        async search() {
            if (this.npwpd.trim()) {
                try {
                    const response = await fetch(`/api/search/${this.npwpd}`);
                    if (!response.ok) throw new Error('Data tidak ditemukan');
                    const data = await response.json();
                    this.searchData = data;
                } catch (error) {
                    console.error(error.message);
                    alert(error.message || 'Terjadi kesalahan saat mencari data.');
                    this.searchData = null;
                }
            } else {
                alert('Harap isi NPWPD untuk melakukan pencarian.');
            }
        }
    }">

    <!-- Container Utama -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="bg-white w-64 h-screen fixed z-50 transform transition-transform duration-300 shadow-lg"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="p-4 text-blue-600 font-bold text-lg border-b">
                DASHBOARD
            </div>
            <nav class="mt-4">
                <a href="/admin/SPTPD" class="block py-2 px-4 text-blue-600 font-semibold hover:bg-gray-200">SPTPD</a>
                <a href="/admin/user" class="block py-2 px-4  hover:bg-gray-200">KELOLA USER</a>
                <a href="/admin" class="block py-2 px-4 hover:bg-gray-200">KELOLA ADMIN</a>
                <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Anda yakin ingin logout?')">
                    @csrf
                    <button type="submit" class="btn bg-blue-600 text-white text-lg w-full">Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col transition-all duration-300" :class="sidebarOpen ? 'ml-64' : 'ml-0'">

            <!-- Header -->
            <header class="bg-gray-100 shadow p-4 flex items-center justify-between">
                <button @click="sidebarOpen = !sidebarOpen" class="text-blue-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="text-blue-600 font-semibold text-lg">BAPENDA Kab. Badung</div>
            </header>

            <!-- Kontainer Form -->
            <section class="p-4">
                <div class="bg-white rounded shadow p-6">
                    <!-- Form Pencarian -->
                    <div class="flex gap-4 mb-6">
                        <input type="text" placeholder="Masukkan NPWPD" x-model="npwpd" class="border px-3 py-2 rounded flex-1">
                        <select class="border px-3 py-2 rounded">
                            <option>2024</option>
                        </select>
                        <button @click="search()" class="bg-blue-600 text-white px-4 py-2 rounded">Cari Wajib Pajak</button>
                    </div>

                    <!-- Hasil Pencarian -->
                    <h2 class="text-blue-600 font-semibold text-lg mb-4">Hasil Pencarian</h2>
                    <div class="space-y-4">
                        <template x-if="searchData">
                            <div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Nama Wajib Pajak</label>
                                    <input type="text" :value="searchData.nama" class="border rounded w-full p-2" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">NPWPD</label>
                                    <input type="text" :value="searchData.npwpd" class="border rounded w-full p-2" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">NOPD</label>
                                    <input type="text" :value="searchData.nopd" class="border rounded w-full p-2" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Alamat</label>
                                    <input type="text" :value="searchData.alamat" class="border rounded w-full p-2" readonly>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-semibold">Catatan</label>
                                    <textarea rows="2" :value="searchData.catatan" class="border rounded w-full p-2" readonly></textarea>
                                </div>
                            </div>
                        </template>
                        <template x-if="!searchData">
                            <p class="text-gray-500">Data pencarian akan ditampilkan di sini.</p>
                        </template>
                    </div>

                    <!-- Tabel Tagihan -->
                    <div class="mt-8">
                        <h3 class="text-blue-600 font-semibold text-lg mb-4">Tabel Layanan</h3>
                        <table class="min-w-full table-auto">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">No</th>
                                    <th class="px-4 py-2">Nama Pemohon</th>
                                    <th class="px-4 py-2">NPWPD</th>
                                    <th class="px-4 py-2">NOPD</th>
                                    <th class="px-4 py-2">Tanggal Pengajuan</th>
                                    <th class="px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($permohonans as $key => $permohonan)
                                <tr>
                                    <td class="border px-4 py-2">{{ $key + 1 }}</td>
                                    <td class="border px-4 py-2">{{ $permohonan->nama_pemohon }}</td>
                                    <td class="border px-4 py-2">{{ $permohonan->npwpd }}</td>
                                    <td class="border px-4 py-2">{{ $permohonan->nopd }}</td>
                                    <td class="border px-4 py-2">{{ $permohonan->tanggal_pengajuan }}</td>
                                    <td class="border px-4 py-2">
                                        <form method="POST" action="{{ route('admin.permohonan.validate', $permohonan->id) }}">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Validasi</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani pencarian
            const searchButton = document.querySelector('[x-on\\:click="search()"]');
            const npwpdInput = document.getElementById('npwpd');
            const resultContainer = document.getElementById('dataContainer');

            searchButton.addEventListener('click', async function(event) {
                event.preventDefault();

                const npwpd = npwpdInput.value.trim();
                if (!npwpd) {
                    alert('Harap masukkan NPWPD terlebih dahulu.');
                    return;
                }

                try {
                    // Mengambil data dari API pencarian NPWPD
                    const response = await fetch(`/admin/api/search/${npwpd}`);
                    if (!response.ok) {
                        alert('Data tidak ditemukan.');
                        return;
                    }
                    const data = await response.json();

                    // Menampilkan data ke form jika ditemukan
                    if (data) {
                        document.getElementById('nama').value = data.nama;
                        document.getElementById('npwpd').value = data.npwpd;
                        document.getElementById('nopd').value = data.nopd;
                        document.getElementById('alamat').value = data.alamat;
                        document.getElementById('catatan').value = data.catatan || '';
                    } else {
                        alert('Data tidak ditemukan.');
                    }
                } catch (error) {
                    console.error('Terjadi kesalahan:', error);
                    alert('Terjadi kesalahan saat mencari data.');
                }
            });
        });
    </script>


</body>

</html>