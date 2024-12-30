<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>E-Bapenda | Citizen</title>
    <link rel="icon" href="{{ asset('img/logo-epalapa-2.svg') }}" type="image/svg+xml">

</head>

<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex items-center justify-between px-4">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/logo-epalapa-2.svg') }}" alt="Logo E-Palapa" class="h-8">
                <span class="text-xl font-semibold text-gray-700">E-BAPENDA</span>
            </div>

            <!-- Burger Menu (Always visible, positioned at the left) -->
            <button id="burger-menu" class="text-red-800 focus:outline-none ml-4">
                <div class="w-8 h-1 bg-red-800 my-1"></div>
                <div class="w-8 h-1 bg-red-800 my-1"></div>
                <div class="w-8 h-1 bg-red-800 my-1"></div>
            </button>
        </div>
    </header>

    <!-- Sidebar (Initially hidden, positioned to the right) -->
    <div id="sidebar"
        class="fixed top-0 right-[-250px] w-64 h-full bg-white text-red-800 p-6 space-y-4 transition-all duration-300 ease-in-out">
        <div class="row">
            <div class="col-md-12 text-right">
                <span id="close-sidebar" class="cursor-pointer text-sm text-gray-400">Tutup</span>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="text-lg font-semibold text-red-800">Profil</div>
            </div>
            <div class="col-md-6 text-right text-sm text-red-800">
                V 1.3.1
            </div>
        </div>

        <!-- Profile Image and Info -->
        <div class="row mt-4 text-center">
            <div class="col-md-12">
                <img src="{{ asset('img/star.svg') }}" class="w-16 mx-auto animate-pulse">
                <img src="{{ asset('img/red-circle.svg') }}"
                    class="w-16 absolute mx-auto transform -translate-x-1/2 left-1/2 top-24">
                <div class="w-24 h-24 rounded-full bg-cg text-red-800 text-4xl flex justify-center items-center mx-auto"
                    style="font-size: 64px;">
                    {{ strtoupper(substr($user->nama_user, 0, 1)) }}
                </div>
            </div>
        </div>

        <!-- Edit Profile Button -->
        <div class="row mt-4 text-right">
            <div class="col-md-12">
                <button class="btn bg-cg text-white text-sm">Edit Profil</button>
            </div>
        </div>

        <!-- Profile Details -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="flex items-center space-x-4">
                    <div class="bg-cg text-red-800 p-2 rounded-lg">
                        <i class="fa fa-user"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Nama</div>
                        <div class="text-sm">{{$user->nama_user}}</div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <div class="bg-cg text-red-800 p-2 rounded-lg">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <div>
                        <div class="font-semibold">Email</div>
                        <div class="text-sm">{{$user->email}}</div>
                    </div>
                </div>
                <div class="flex items-center space-x-4 mt-4">
                    <div class="bg-cg text-red-800 p-2 rounded-lg">
                        <i class="fa fa-phone"></i>
                    </div>
                    <div>
                        <div class="font-semibold">No. Telepon</div>
                        <div class="text-sm">{{$user->telepon}}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Change Password Button -->
        <div class="row mt-4 text-right">
            <div class="col-md-12">
                <button id="change-password-btn" class="bg-red-800 p-2 text-white text-sm">Ubah Kata Sandi</button>
            </div>
        </div>

        <div class="citizen-profile-line mt-3"></div>

        <!-- Logout Button -->
        <div class="row text-center mt-4">
            <div class="col-md-12">
                <a href="{{ route('logout') }}" class="btn bg-red-800 text-white text-lg w-full">Logout</a>
            </div>
        </div>

        <form method="POST" action="{{ route('change-password') }}">
            @csrf
            <div id="change-password-modal"
                class="fixed inset-0 bg-black bg-opacity-50 hidden flex justify-center items-center z-50">
                <div class="modal-dialog bg-white p-6 rounded-lg shadow-lg w-96" role="document">
                    <div class="modal-header flex justify-between items-center pb-4 border-b">
                        <div class="title-modal text-lg font-semibold text-gray-800">Ubah Kata Sandi</div>
                        <button class="btn close-btn text-red-500" id="close-modal">
                            <img src="/img/close-black.svg" alt="Close" class="w-6 h-6">
                        </button>
                    </div>
                    <div class="modal-body mt-4">
                        <div class="form-group mb-4">
                            <label class="text-sm font-medium text-gray-700">Kata Sandi Lama</label>
                            <input type="password" name="oldPassword" id="oldPassword"
                                class="form-control w-full p-3 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="Kata sandi lama" value="{{ old('oldPassword') }}">
                            @if ($errors->has('oldPassword'))
                            <div class="text-red-500 text-sm mt-1">{{ $errors->first('oldPassword') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <label class="text-sm font-medium text-gray-700">Kata Sandi Baru</label>
                            <input type="password" name="newPassword" id="newPassword"
                                class="form-control w-full p-3 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="Kata sandi baru" value="{{ old('newPassword') }}">
                            @if ($errors->has('newPassword'))
                            <div class="text-red-500 text-sm mt-1">{{ $errors->first('newPassword') }}</div>
                            @endif
                        </div>
                        <div class="form-group mb-6">
                            <label class="text-sm font-medium text-gray-700">Konfirmasi Kata Sandi Baru</label>
                            <input type="password" name="repeatPassword" id="repeatPassword"
                                class="form-control w-full p-3 border rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500"
                                placeholder="Konfirmasi kata sandi baru" value="{{ old('repeatPassword') }}">
                            @if ($errors->has('repeatPassword'))
                            <div class="text-red-500 text-sm mt-1">{{ $errors->first('repeatPassword') }}</div>
                            @endif
                        </div>
                        <div class="modal-footer flex justify-between items-center mt-4">
                            <button type="button"
                                class="btn btn-red-outline text-red-500 py-2 px-6 rounded-lg border-2 border-red-500 hover:bg-red-500 hover:text-white"
                                id="cancel-btn">Batal</button>
                            <button type="submit"
                                class="btn btn-green-outline bg-red-500 text-white py-2 px-6 rounded-lg hover:bg-red-600">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <!-- Main Content -->
    <main id="main-content" class="transition-all duration-300 ease-in-out p-4 container mx-auto w-full">
        <div
            class="bg-red-800 text-white rounded-lg shadow-lg p-6 items-center grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
            <div>
                <h2 class="text-2xl font-bold mb-2">Pelayanan</h2>
                <p>Di sini kamu dapat mengakses seluruh jenis Layanan Publik yang tersedia. Kamu juga bisa
                    mengetahui progress pengajuan pelayanan kamu secara real time.</p>
            </div>
            <div class="ml-auto">
                <img src="{{ asset('img/people-chat.svg') }}" alt="Banner" class="h-48">
            </div>
        </div>

        <!-- Menu Options -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
            <div class="bg-red-900 p-4 rounded-lg shadow-md flex items-center space-x-4">
                <div class="bg-white p-2 rounded-lg shadow space-x-4 flex items-center w-full">
                    <img src="{{ asset('img/icon-pelayanan.svg') }}" class="h-9">
                    <a href="/pelayanan" class="font-medium text-black hover:text-red-900">Pelayanan</a>
                </div>
            </div>
            <div class="bg-red-900 text-black p-4 rounded-lg shadow-md flex items-center space-x-4">
                <div class="bg-white p-2 rounded-lg shadow space-x-4 flex items-center w-full">
                    <img src="{{ asset('img/doc-icon.svg') }}" class="h-9">
                    <a href="/quisioner" class="font-medium text-black hover:text-red-900">Quisioner</a>
                </div>
            </div>
            <div class="bg-red-900 text-black p-4 rounded-lg shadow-md flex items-center space-x-4">
                <div class="bg-white p-2 rounded-lg shadow space-x-4 flex items-center w-full">
                    <img src="{{ asset('img/blog.svg') }}" class="h-9">
                    <a href="http://" class="font-medium text-black hover:text-red-900">Pusat Informasi</a>
                </div>
            </div>
        </div>

        <!-- Daftar Permohonan -->
        <section class="mt-8">
            <h3 class="text-lg font-semibold text-gray-700">Daftar Permohonan</h3>
            <div class="flex items-center space-x-4 mt-4">
                <input type="text" placeholder="Cari permohonan"
                    class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring focus:ring-red-200">
                <select
                    class="border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring focus:ring-red-200">
                    <option>Semua</option>
                    <option>Baru</option>
                    <option>Proses</option>
                    <option>Disetujui</option>
                    <option>Ditolak</option>
                </select>
            </div>
            <!-- Tabel Permohonan -->
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full bg-white shadow-md rounded-lg">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">No.</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">NPWPD</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Tanggal Pengajuan</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permohonan as $key => $item)
                        <tr class="border-b hover:bg-gray-100">
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $key + 1 }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">{{ $item->npwpd }}</td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($item->tanggal_pengajuan)->format('d-m-Y') }} <!-- Mengonversi string menjadi objek Carbon -->
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                <span class="inline-block px-3 py-1 rounded-full text-xs {{ $item->status == 'divalidasi' ? 'bg-green-500 text-white' : ($item->status == 'Ditolak' ? 'bg-red-500 text-white' : 'bg-yellow-500 text-white') }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-700">
                                <a href="#"
                                    class="text-blue-500 hover:text-blue-700 ajukanPermohonanBtn"
                                    data-id="{{ $item->id }}">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
        <div id="permohonanFormContainer" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full h-auto max-h-[80vh] overflow-auto">
                <!-- Form permohonan -->
                @include('permohonan.detail-permohonan')
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <!-- Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal untuk detail permohonan
            const detailButtons = document.querySelectorAll('.ajukanPermohonanBtn');
            const formContainer = document.getElementById('permohonanFormContainer');

            detailButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const permohonanId = this.getAttribute('data-id');
                    console.log("Permohonan ID yang dipilih: ", permohonanId);

                    // Menampilkan modal form
                    formContainer.classList.remove('hidden');

                    // Fetch data permohonan berdasarkan ID
                    fetch(`/permohonan/detail/${permohonanId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log("Data permohonan yang diterima: ", data);

                            // Update modal dengan detail permohonan
                            document.getElementById('permohonanNama').textContent = data.nama_permohonan;
                            document.getElementById('permohonanStatus').textContent = data.status;
                        })
                        .catch(error => {
                            console.error('Error fetching permohonan details:', error);
                        });
                });
            });
            // Listener untuk tombol "Back" di dalam form modal
            document.getElementById('backBtn')?.addEventListener('click', function() {
                const formContainer = document.getElementById('permohonanFormContainer');
                formContainer.classList.add('hidden');
            });


            // Sidebar toggle
            const burgerMenu = document.getElementById('burger-menu');
            const sidebar = document.getElementById('sidebar');
            const closeSidebar = document.getElementById('close-sidebar');
            const mainContent = document.getElementById('main-content');

            burgerMenu.addEventListener('click', () => {
                sidebar.classList.toggle('right-[-250px]');
                sidebar.classList.toggle('right-0');
                mainContent.classList.toggle('pr-[250px]');
            });

            closeSidebar.addEventListener('click', () => {
                sidebar.classList.remove('right-0');
                sidebar.classList.add('right-[-250px]');
                mainContent.classList.remove('pr-[250px]');
            });

            // Modal untuk perubahan password
            const changePasswordBtn = document.getElementById('change-password-btn');
            const changePasswordModal = document.getElementById('change-password-modal');
            const closeModal = document.getElementById('close-modal');
            const cancelBtn = document.getElementById('cancel-btn');

            // Menampilkan modal perubahan password
            changePasswordBtn.addEventListener('click', () => {
                changePasswordModal.classList.remove('hidden');
            });

            // Menutup modal perubahan password
            closeModal.addEventListener('click', () => {
                changePasswordModal.classList.add('hidden');
            });

            // Menutup modal perubahan password dari tombol "Cancel"
            cancelBtn.addEventListener('click', () => {
                changePasswordModal.classList.add('hidden');
            });
        });
    </script>
</body>

</html>