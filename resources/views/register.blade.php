<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
    @vite('resources/css/app.css')
    <style>
        /* Animasi gambar tetap */
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

<body class="min-h-screen flex justify-center items-center bg-gray-100">

    <!-- Container Utama -->
    <div class="flex w-full max-w-4xl bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Kolom Gambar -->
        <div class="w-1/2 flex justify-center items-center bg-gray-200 p-8">
            <img src="img/login-public-icon2-red.svg" alt="Gambar Animasi"
                class="w-full h-auto object-cover animate-zoom">
        </div>

        <!-- Kolom Formulir -->
        <div class="w-1/2 p-8 flex flex-col justify-center">
            <!-- Judul Form -->
            <div class="border-b mb-6">
                <div class="text-center font-bold text-black border-b-2 border-red-600 p-2">
                    Register
                </div>
            </div>


            <!-- Formulir Registrasi -->
            <form action="{{ route('register.action') }}" method="POST" class="space-y-5">
                @csrf
                <!-- Input Nama Lengkap -->
                <div>
                    <label class="block text-sm font-medium text-red-800 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama_user" placeholder="Masukkan nama lengkap"
                        class="w-full border border-red-800 rounded-md px-4 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Input Email -->
                <div>
                    <label class="block text-sm font-medium text-red-800 mb-1">Email</label>
                    <input type="email" name="email" placeholder="Masukkan email"
                        class="w-full border border-red-800 rounded-md px-4 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Input Nomor Telepon -->
                <div>
                    <label class="block text-sm font-medium text-red-800 mb-1">Nomor Telepon</label>
                    <input type="text" name="telepon" placeholder="Masukkan nomor telepon"
                        class="w-full border border-red-800 rounded-md px-4 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Input Kata Sandi -->
                <div>
                    <label class="block text-sm font-medium text-red-800 mb-1">Kata Sandi</label>
                    <input type="password" name="password" placeholder="Masukkan kata sandi"
                        class="w-full border border-red-800 rounded-md px-4 py-2 focus:ring-2 focus:ring-red-500 focus:outline-none">
                </div>

                <!-- Tombol Daftar -->
                <button type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300">
                    Daftar
                </button>
            </form>

            <!-- Link Kembali ke Login -->
            <div class="text-center mt-6">
                <a href="login" class="text-red-600 hover:underline">Sudah punya akun? Kembali ke Login</a>
            </div>
        </div>
    </div>

</body>

</html>
