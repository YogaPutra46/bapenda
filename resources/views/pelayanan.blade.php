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
        <section id="search-bar" class="mb-8">
            <div class="flex space-x-4 max-w-3xl mx-auto">
                <input type="text" id="search-input" placeholder="Cari Layanan" class="p-4 w-full border-2 border-maroon-500 rounded-md focus:outline-none focus:ring-2 focus:ring-maroon-500">
            </div>
        </section>



        <section id="content">
            <h2 class="text-3xl font-bold text-center text-red-800 mb-6">Pelayanan Bapemda Badung</h2>
            <p class="text-lg text-center text-gray-600 mb-10">Kami menyediakan berbagai layanan pajak dan administrasi untuk masyarakat Kabupaten Badung.</p>

            <!-- Service Items -->
            <div id="service-items" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Cek Tagihan BPHTB -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Cek Tagihan BPHTB">
                    <h3 class="text-xl font-semibold text-red-800">Cek Tagihan BPHTB</h3>
                    <p class="text-gray-700 mt-2">Cek tagihan Bea Perolehan Hak atas Tanah dan Bangunan (BPHTB).</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <!-- Cek Tunggakan Non-PBB -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Cek Tunggakan Non-PBB">
                    <h3 class="text-xl font-semibold text-red-800">Cek Tunggakan Non-PBB</h3>
                    <p class="text-gray-700 mt-2">Cek Tunggakan PBJT (Pajak Barang dan Jasa Tertentu) seperti Jasa Perhotelan, Makanan dan Minuman, dll.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <!-- Cek Tunggakan PBB -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Cek Tunggakan PBB">
                    <h3 class="text-xl font-semibold text-red-800">Cek Tunggakan PBB</h3>
                    <p class="text-gray-700 mt-2">Cek tunggakan Pajak Bumi dan Bangunan Perdesaan dan Perkotaan (PBB-P2).</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <!-- Cetak E-SPPT -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Cetak E-SPPT PBB-P2">
                    <h3 class="text-xl font-semibold text-red-800">Cetak E-SPPT PBB-P2</h3>
                    <p class="text-gray-700 mt-2">Cetak E-SPPT untuk Pajak Bumi dan Bangunan Perdesaan dan Perkotaan.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <!-- Keberatan Pajak Daerah -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Keberatan Pajak Daerah">
                    <h3 class="text-xl font-semibold text-red-800">Keberatan Pajak Daerah</h3>
                    <p class="text-gray-700 mt-2">Ajukan keberatan terkait pajak daerah yang dikenakan kepada Anda.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400" id="ajukanPermohonanBtn">Ajukan Permohonan</a>
                </div>
                <div id="permohonanFormContainer" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                    <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full h-auto max-h-[80vh] overflow-auto">
                        <!-- Form permohonan -->
                        @include('permohonan.create')
                    </div>
                </div>

                <!-- Lapor SPTPD -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Lapor SPTPD">
                    <h3 class="text-xl font-semibold text-red-800">Lapor SPTPD</h3>
                    <p class="text-gray-700 mt-2">Laporkan Surat Pemberitahuan Pajak Daerah (SPTPD) untuk Pajak Barang dan Jasa Tertentu.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <!-- Pemutakhiran Data Pajak Hiburan -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Pemutakhiran Data Pajak Hiburan">
                    <h3 class="text-xl font-semibold text-red-800">Pemutakhiran Data Pajak Hiburan</h3>
                    <p class="text-gray-700 mt-2">Pemutakhiran data untuk Pajak Hiburan yang sedang Anda kelola.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <!-- Pemutakhiran Data Pajak Hotel -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Pemutakhiran Data Pajak Hotel">
                    <h3 class="text-xl font-semibold text-red-800">Pemutakhiran Data Pajak Hotel</h3>
                    <p class="text-gray-700 mt-2">Pemutakhiran data Pajak Hotel, Hostel, Vila, Motel, dll.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <!-- Additional Services -->
                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Pendaftaran Wajib Pajak Restoran">
                    <h3 class="text-xl font-semibold text-red-800">Pendaftaran Wajib Pajak Restoran</h3>
                    <p class="text-gray-700 mt-2">Pendaftaran untuk wajib pajak restoran, jasa boga, atau katering.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="Snapstruk">
                    <h3 class="text-xl font-semibold text-red-800">Snapstruk</h3>
                    <p class="text-gray-700 mt-2">Ayo awasi uang pajak yang telah Anda bayarkan!</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>

                <div class="p-6 bg-white border-2 border-red-800 rounded-lg shadow-md hover:shadow-xl transition duration-300 service-item" data-name="WhatsApp Pelayanan E-Palapa">
                    <h3 class="text-xl font-semibold text-red-800">WhatsApp Pelayanan E-Palapa</h3>
                    <p class="text-gray-700 mt-2">Pelayanan E-Palapa hanya menerima pesan chat pada jam kerja.</p>
                    <a href="#" class="inline-block mt-4 text-green-700 hover:text-green-400">Ajukan Permohonan</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Scripts -->
    <!-- Scripts -->
    <script>
        const burgerMenu = document.getElementById('burger-menu');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const mainContent = document.getElementById('main-content');

        // Toggle sidebar visibility
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

        // Modal toggle
        const changePasswordBtn = document.getElementById('change-password-btn');
        const changePasswordModal = document.getElementById('change-password-modal');
        const closeModal = document.getElementById('close-modal');
        const cancelBtn = document.getElementById('cancel-btn');

        changePasswordBtn.addEventListener('click', () => {
            changePasswordModal.classList.remove('hidden');
        });
        closeModal.addEventListener('click', () => {
            changePasswordModal.classList.add('hidden');
        });
        cancelBtn.addEventListener('click', () => {
            changePasswordModal.classList.add('hidden');
        });

        // Buka modal jika ada error dari server
        @if($errors -> any())
        changePasswordModal.classList.remove('hidden');
        @endif

        // Mengambil elemen pencarian dan semua item layanan
        const searchInput = document.getElementById('search-input');
        const serviceItems = document.querySelectorAll('.service-item');

        // Fungsi untuk menyaring layanan berdasarkan input pencarian
        function filterServices() {
            const query = searchInput.value.toLowerCase(); // Mengambil input pencarian dalam huruf kecil

            serviceItems.forEach(item => {
                const serviceName = item.getAttribute('data-name').toLowerCase(); // Ambil nama layanan
                if (serviceName.includes(query)) {
                    item.style.display = 'block'; // Tampilkan item jika cocok
                } else {
                    item.style.display = 'none'; // Sembunyikan item jika tidak cocok
                }
            });
        }

        // Menambahkan event listener pada input pencarian
        searchInput.addEventListener('input', filterServices);

        document.getElementById('ajukanPermohonanBtn').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link melakukan navigasi

            // Menampilkan form permohonan
            const formContainer = document.getElementById('permohonanFormContainer');
            formContainer.classList.toggle('hidden');
        });
        document.getElementById('backBtn').addEventListener('click', function() {
            const formContainer = document.getElementById('permohonanFormContainer');
            formContainer.classList.add('hidden');
        });
    </script>
</body>