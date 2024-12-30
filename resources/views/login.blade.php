<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login dengan Animasi Gambar</title>
    @vite('resources/css/app.css')

    <!-- Tambahkan Style Animasi -->
    <style>
        @keyframes zoomInOut {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .animate-zoom {
            animation: zoomInOut 5s ease-in-out infinite;
        }
    </style>
</head>

<body class="h-screen flex justify-center items-center bg-gray-100">

    <!-- Container Utama -->
    <div class="flex w-full max-w-4xl shadow-lg rounded-lg overflow-hidden bg-white">
        <!-- Kolom Kiri: Gambar dengan Animasi -->
        <div class="w-1/2 flex justify-center items-center bg-gray-200">
            <img src="img/login-public-icon2-red.svg" alt="Gambar Animasi"
                class="w-full h-auto object-cover animate-zoom">
        </div>

        <!-- Kolom Kanan: Box Login -->
        <div class="w-1/2 flex items-center justify-center p-8">
            <div class="w-full">
                <!-- Header Tab -->
                <div class="border-b mb-6">
                    <div class="text-center font-bold text-black border-b-2 border-red-600 p-2">
                        Masuk / Daftar
                    </div>
                </div>

                <!-- Selamat Datang -->
                <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
                <p class="text-gray-500 text-sm mb-6">Mohon login terlebih dahulu untuk melanjutkan</p>

                <!-- Lupa Kata Sandi -->
                <div class="text-right mt-3">
                    <a href="#" class="text-red-800 text-sm font-medium hover:underline">Lupa kata sandi</a>
                </div>

                <!-- Form Login -->
                <form action="{{ route('login.action') }}" method="POST">
                    @csrf
                    <!-- Input Email -->
                    <div class="mb-4 relative">
                        <input type="email" name="email" placeholder="Masukkan email"
                            class="w-full border border-red-800 rounded-md px-4 py-2 pl-10 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-red-500">
                        <div class="absolute left-3 top-2.5 text-red-800">
                            <!-- Icon Email -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 4v5m0-12h.01" />
                            </svg>
                        </div>
                        <p class="text-red-800 text-sm mt-1">Email harus diisi</p>
                    </div>

                    <!-- Input Password -->
                    <div class="mb-4 relative">
                        <input type="password" name="password" placeholder="Masukkan kata sandi"
                            class="w-full border border-red-800 rounded-md px-4 py-2 pl-10 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-red-500">
                        <div class="absolute left-3 top-2.5 text-red-800">
                            <!-- Icon Password -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v-3m0-4h.01M17 9V7a4 4 0 00-8 0v2m8 0a4 4 0 00-8 0m4 12a9 9 0 01-9-9 9 9 0118 0 9 9 0 01-9 9z" />
                            </svg>
                        </div>
                        <p class="text-red-800 text-sm mt-1">Kata sandi harus diisi</p>
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md">
                        Masuk
                    </button>
                </form>

                <!-- Daftar Baru -->
                <div class="mt-6 text-center text-sm">
                    <hr class="h-1 bg-red-900 border-0 my-4" />
                    <p >
                        Belum memiliki akun ?  
                    </p>
                    <a href="register" class="inline-block w-full border border-red-800 text-red-800 py-2 px-4 rounded-md mt-2 font-medium hover:bg-red-800 hover:text-white">
                        Daftar Baru
                    </a>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
