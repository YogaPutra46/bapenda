<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPTPD Dashboard</title>
    @vite('resources/css/app.css')
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body class="bg-gray-100" x-data="{ sidebarOpen: false }">

    <!-- Container Utama -->
    <div class="flex h-screen">

        <!-- Sidebar -->
        <div class="bg-white w-64 h-screen fixed z-50 transform transition-transform duration-300 shadow-lg"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="p-4 text-blue-600 font-bold text-lg border-b">
                SPTPD
            </div>
            <nav class="mt-4">
                <a href="/SPTPD" class="block py-2 px-4 hover:bg-gray-200">SPTPD</a>
                <a href="/user" class="block py-2 px-4 text-blue-600 font-semibold hover:bg-gray-200">KELOLA USER</a>
                <a href="/admin" class="block py-2 px-4 hover:bg-gray-200">KELOLA ADMIN</a>
                <a href="#" class="block py-2 px-4 hover:bg-gray-200">E-TAX</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col transition-all duration-300" :class="sidebarOpen ? 'ml-64' : 'ml-0'">

            <!-- Header -->
            <header class="bg-gray-100 shadow p-4 flex items-center justify-between">
                <!-- Burger Menu -->
                <button @click="sidebarOpen = !sidebarOpen" class="text-blue-600 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="text-blue-600 font-semibold text-lg">
                    BAPENDA Kab. Badung
                </div>
            </header>

            <!-- Kontainer Form dan Hasil Pencarian -->
            <div class="p-4">
                <div class="container mx-auto my-5">
                    <div class="bg-white shadow-lg rounded-lg">
                        <div class="bg-gray-100 text-center py-3 rounded-t-lg">
                            <strong class="text-xl">TAMBAH DATA</strong>
                        </div>
                        <div class="p-6">
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                
                                <div class="mb-4">
                                    <label for="nama_user" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input 
                                        type="text" 
                                        name="nama_user" 
                                        id="nama_user" 
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                        placeholder="Nama ..">
                
                                    @if ($errors->has('nama_user'))
                                        <div class="text-red-500 text-sm mt-1">
                                            {{ $errors->first('nama_user') }}
                                        </div>
                                    @endif
                                </div>
                
                                <div class="mb-4">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Username</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                        placeholder="email ..">
                
                                    @if ($errors->has('email'))
                                        <div class="text-red-500 text-sm mt-1">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                
                                <div class="mb-4">
                                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input 
                                        type="text" 
                                        name="password" 
                                        id="password" 
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                        placeholder="Password ..">
                
                                    @if ($errors->has('password'))
                                        <div class="text-red-500 text-sm mt-1">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label for="telepon" class="block text-sm font-medium text-gray-700">Password</label>
                                    <input 
                                        type="text" 
                                        name="telepon" 
                                        id="telepon" 
                                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                        placeholder="Telepon ..">
                
                                    @if ($errors->has('telepon'))
                                        <div class="text-red-500 text-sm mt-1">
                                            {{ $errors->first('telepon') }}
                                        </div>
                                    @endif
                                </div>
                
                                <div class="mt-4 flex justify-between">
                                    <input 
                                        type="submit" 
                                        class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg" 
                                        value="Simpan">
                
                                    <a href="{{ route('user.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center">
                                        <i class="fa fa-arrow-left mr-2"></i> Kembali
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                

            </div>

        </div>
    </div>

</body>

</html>
