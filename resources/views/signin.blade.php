<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen flex justify-center items-center bg-gray-100">
    <div class="flex w-full max-w-4xl shadow-lg rounded-lg overflow-hidden bg-white">
        <div class="w-1/2 flex justify-center items-center bg-gray-200">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-full h-auto object-cover animate-zoom">
        </div>
        <div class="w-1/2 flex items-center justify-center p-8">
            <div class="w-full">
                <div class="text-center font-bold text-black border-b-2 border-red-600 p-2 mb-6">Masuk Admin</div>
                <h2 class="text-2xl font-bold mb-2">Selamat Datang!</h2>
                <p class="text-gray-500 text-sm mb-6">Mohon login terlebih dahulu untuk melanjutkan</p>
                <form action="{{ route('admin.login.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4 relative">
                        <input type="text" name="username" placeholder="Masukkan username"
                            class="w-full border rounded-md px-4 py-2 pl-12 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-red-500">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-9 4v5m0-12h.01" />
                            </svg>
                        </div>
                    </div>
                    <div class="mb-4 relative">
                        <input type="password" name="password" placeholder="Masukkan kata sandi"
                            class="w-full border rounded-md px-4 py-2 pl-12 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-red-500">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v-3m0-4h.01M17 9V7a4 4 0 00-8 0v2m8 0a4 4 0 00-8 0m4 12a9 9 0 01-9-9 9 9 0118 0 9 9 0 01-9 9z" />
                            </svg>
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>