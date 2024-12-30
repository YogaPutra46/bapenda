<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow-md py-4">
        <div class="container mx-auto flex items-center justify-between px-4">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('img/logo-epalapa-2.svg') }}" alt="Logo E-Palapa" class="h-8">
                <span class="text-xl font-semibold text-gray-700"><a href="/">E-BAPENDA</a</span>
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

    <main id="main-content" class="transition-all duration-300 ease-in-out p-4 container mx-auto w-full">
        <!-- Navbar -->
        <div class="custom-navbar max-w-screen-lg mx-auto flex flex-col justify-center items-center bg-cover bg-center bg-no-repeat"
            style="background-image: url('../img/background3.jpg'); height: 60vh;">
            <img src="{{ asset('img/logo.png') }}" alt="logo" class="w-40 h-auto mb-4">
            <h1 class="text-center text-white text-xl font-bold">
                Badan Pendapatan Daerah
                <br /> Kabupaten Badung
            </h1>
        </div>
    
        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success text-green-600 text-center mt-4">
                {{ session('success') }}
            </div>
        @endif
    
        @if (session('error'))
            <div class="alert alert-danger text-red-600 text-center mt-4">
                {{ session('error') }}
            </div>
        @endif
    
        <!-- Form -->
        <div class="max-w-screen-lg mx-auto -mt-12">
            <form method="POST" action="{{ route('quisioner.store') }}" enctype="multipart/form-data"
                class="bg-white p-8 rounded shadow-md">
                @csrf
    
                <!-- Data Responden Section -->
                <div class="mb-6">
                    <fieldset class="border p-4 rounded">
                        <div class="data-responden">
                            <h3 class="text-lg font-semibold text-center mb-4">Data Responden</h3>
                            <hr class="my-2 w-24 mx-auto border-2 rounded-lg">
    
                            <!-- Gender -->
                            <div class="form-group mb-4 flex items-center justify-between">
                                <label for="gender" class="w-1/3 text-lg font-medium">Jenis Kelamin / Gender:</label>
                                <div class="w-2/3 flex justify-end space-x-4">
                                    <label class="flex items-center">
                                        <input type="radio" name="gender" value="pria" id="gender_pria" class="mr-2">
                                        Pria / Male
                                    </label>
                                    <label class="flex items-center">
                                        <input type="radio" name="gender" value="wanita" id="gender_wanita"
                                            class="mr-2">
                                        Wanita / Female
                                    </label>
                                </div>
                            </div>
    
                            <!-- Age -->
                            <div class="form-group mb-4 flex items-center justify-between">
                                <label for="age" class="w-1/3 text-lg font-medium">Umur / Age</label>
                                <div class="w-2/3 flex justify-end">
                                    <input type="number" name="age" id="age" required
                                        class="border rounded p-2 w-2/5">
                                    <span class="ml-2">Tahun</span>
                                </div>
                            </div>
    
                            <!-- Education -->
                            <div class="form-group mb-4 flex items-center justify-between">
                                <label for="education" class="w-1/3 text-lg font-medium">Pendidikan / Last Education</label>
                                <div class="w-2/3 flex justify-end">
                                    <select name="education" required class="border rounded w-1/2 p-2">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="SD / SMP">SD / SMP</option>
                                        <option value="SMA / SMK / DIPLOMA">SMA / SMK / DIPLOMA</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                    </select>
                                </div>
                            </div>
    
                            <!-- Employment -->
                            <div class="form-group mb-4 flex items-center justify-between">
                                <label for="employment" class="w-1/3 text-lg font-medium">Pekerjaan / Employment</label>
                                <div class="w-2/3 flex justify-end">
                                    <select name="employment" required class="border rounded w-1/2 p-2">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="PNS / TNI / Polri">PNS / TNI / Polri</option>
                                        <option value="Pegawai Swasta">Pegawai Swasta</option>
                                        <option value="Wiraswasta / Usahawan">Wiraswasta / Usahawan</option>
                                        <option value="Lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
    
                <!-- Data Unit Pelayanan Section -->
                <div class="mb-6">
                    <fieldset class="border p-4 rounded">
                        <div class="data-unit-pelayanan">
                            <h3 class="text-lg font-semibold text-center mb-4">Data Unit Pelayanan</h3>
                            <hr class="my-2 w-24 mx-auto border-2 rounded-lg">
    
                            <!-- Work Unit -->
                            <div class="form-group mb-4 flex items-center justify-between">
                                <label for="tempat_kerja" class="w-1/3 text-lg font-medium">Unit Tempat Kerja Mengurus
                                    Layanan Public</label>
                                <div class="w-2/3 flex justify-end">
                                    <select name="tempat_kerja" required class="border rounded w-1/2 p-2">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Bidang Data dan IT">Bidang Data dan IT</option>
                                        <option value="Bidang Penetapan">Bidang Penetapan</option>
                                        <option value="Bidang Penagihan">Bidang Penagihan</option>
                                        <option value="UPTD Menggwi">UPTD Menggwi</option>
                                        <option value="UPTD Kuta">UPTD Kuta</option>
                                        <option value="UPTD Kuta Utara">UPTD Kuta Utara</option>
                                        <option value="UPTD Kuta Selatan">UPTD Kuta Selatan</option>
                                        <option value="UPTD Abiansemal & Petang">UPTD Abiansemal & Petang</option>
                                    </select>
                                </div>
                            </div>
    
                            <!-- Service Type -->
                            <div class="form-group mb-4 flex items-center justify-between">
                                <label for="jenis_layanan" class="w-1/3 text-lg font-medium">Jenis Layanan / Type of
                                    Service</label>
                                <div class="w-2/3 flex justify-end">
                                    <select name="jenis_layanan" required class="border rounded w-1/2 p-2">
                                        <option value="" disabled selected>Pilih</option>
                                        <option value="Permohonan NPWPD">Permohonan NPWPD</option>
                                        <option value="Permohonan User ID">Permohonan User ID</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
    
                <!-- Survey Questions Section -->
                <div class="mb-6">
                    <fieldset class="border p-4 rounded">
                        <div class="pendapatan-responden-tentang-pelayanan">
                            <h3 class="text-lg font-semibold text-center mb-4">Pendapatan Responden Tentang Pelayanan</h3>
                            <hr class="my-2 w-24 mx-auto border-2 rounded-lg">
    
                            <!-- Survey Question A -->
                            <div class="form-group mb-4">
                                <h4 class="text-lg font-medium">A. Penilaian Terhadap Kualitas Pelayanan/Survei Persepsi
                                    Kualitas Pelayanan (SPKP)</h4>
                            </div>
    
                            <!-- Survey Question 1 -->
                            <div class="form-group mb-4">
                                <h4>1. Bagaimana pendapat saudara tentang informasi pelayanan yang tersedia melalui media
                                    elektronik maupun non elektronik?</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal1_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal1_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal1_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal1_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>2. Bagaimana pendapat saudara tentang kesesuaian persyaratan pelayanan yang diinformasikan dengan persyaratan yang ditetapkan?</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal2_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal2_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal2_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal2_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>3. Bagaimana pendapat saudara tentang kesesuaian persyaratan pelayanan yang
                                    diinformasikan dengan persyaratan yang ditetapkan?</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal3_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal3_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal3_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal3_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>4. Bagaimana pendapat saudara tentang kemudahan prosedur pelayanan di instansi ini?</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal4_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal4_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal4_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal4_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>5. Bagaimana pendapat saudara tentang tidak adanya tarif/biaya pelayanan yang dibayarkan
                                    (gratis) pada unit pelayanan yang ditetapkan?</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal5_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal5_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal5_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal5_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>6. Bagaimana pendapat saudara tentang sarana prasarana pendukung pelayanan/sistem
                                    pelayanan online yang disediakan unit layanan ini memberikan kenyamanan/mudah digunakan?
                                </h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal6_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal6_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal6_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal6_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>7. Bagaimana pendapat saudara tentang petugas pelayanan/sistem pelayanan online pada
                                    unit layanan ini merespon keperluan bapak/ibu dengan cepat?</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal7_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal7_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal7_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal7_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>8. Bagaimana pendapat saudara tentang petugas pelayanan/sistem pelayanan online pada
                                    unit layanan ini merespon keperluan bapak/ibu dengan cepat?</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal8_A" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal8_A" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal8_A" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal8_A" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <!-- Survey Question B -->
                            <div class="form-group mb-4">
                                <h4 class="text-lg font-medium">B. Penilaian Terhadap Persepsi Korupsi / Survei Persepsi
                                    Anti Korupsi (SPAK)</h4>
                            </div>
                            <div class="form-group mb-4">
                                <h4>1. Tidak ada diskriminasi pelayanan pada unit layanan</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal1_B" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal1_B" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal1_B" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal1_B" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>2. Tidak ada pelayanan di luar prosedur/kecurangan pelayanan pada unit layanan ini.</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal2_B" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal2_B" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal2_B" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal2_B" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>3. Tidak ada penerimaan imbalan uang/barang/fasilitas diluar ketentuan yang berlaku pada
                                    unit layanan ini.</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal3_B" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal3_B" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal3_B" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal3_B" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>4. Tidak ada pungutan liar (pungli) pada unit layanan ini.</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal4_B" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal4_B" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal4_B" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal4_B" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
    
                            <div class="form-group mb-4">
                                <h4>5. Tidak ada percalonan/perantara tidak resmi pada unit layanan ini.</h4>
                                <div class="flex flex-col mt-2 space-y-2">
                                    <label>
                                        <input type="radio" name="soal5_B" value="4" class="mr-2">
                                        Sangat Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal5_B" value="3" class="mr-2">
                                        Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal5_B" value="2" class="mr-2">
                                        Tidak Setuju
                                    </label>
                                    <label>
                                        <input type="radio" name="soal5_B" value="1" class="mr-2">
                                        Sangat Tidak Setuju
                                    </label>
                                </div>
                            </div>
                            <!-- Komentar dan Saran -->
                            <div class="form-group mb-4">
                                <label for="komentar" class="block font-medium">Komentar dan Saran</label>
                                <textarea id="komentar" name="komentar" placeholder="Tulis komentar di sini..." class="border rounded w-full p-2"></textarea>
                            </div>
                        </div>
                    </fieldset>
                </div>
    
                <!-- Submit Button -->
                <div class="form-group mb-6">
                    <button type="submit"
                        class="w-full bg-red-800 text-white py-2 rounded hover:bg-red-900 font-semibold">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    
        <footer class="bg-red-800 text-white py-2 mt-0 max-w-screen-lg mx-auto w-full">
            <div class="text-center">
                <p>&copy; 2024 Badan Pendapatan Daerah. Semua Hak Cipta Dilindungi.</p>
            </div>
        </footer>
    </main>
    
    <script>
        
        const burgerMenu = document.getElementById('burger-menu');
        const sidebar = document.getElementById('sidebar');
        const closeSidebar = document.getElementById('close-sidebar');
        const mainContent = document.getElementById('main-content');

        // Toggle sidebar visibility
        burgerMenu.addEventListener('click', () => {
            event.preventDefault();
            sidebar.classList.toggle('right-[-250px]');
            sidebar.classList.toggle('right-0');
            mainContent.classList.toggle('pr-[250px]');
        });

        closeSidebar.addEventListener('click', () => {
            event.preventDefault();
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
            event.preventDefault();
            changePasswordModal.classList.remove('hidden');
        });
        closeModal.addEventListener('click', () => {
            event.preventDefault();
            changePasswordModal.classList.add('hidden');
        });
        cancelBtn.addEventListener('click', () => {
            event.preventDefault();
            changePasswordModal.classList.add('hidden');
        });

        // Buka modal jika ada error dari server
        @if ($errors->any())
        event.preventDefault();
            changePasswordModal.classList.remove('hidden');
        @endif
    </script>

</body>

</html>
