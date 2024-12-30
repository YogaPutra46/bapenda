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
                DASHBOARD
            </div>
            <nav class="mt-4">
                <a href="/admin/SPTPD" class="block py-2 px-4 hover:bg-gray-200">SPTPD</a>
                <a href="/admin/user" class="block py-2 px-4 text-blue-600 font-semibold hover:bg-gray-200">KELOLA USER</a>
                <a href="/admin" class="block py-2 px-4 hover:bg-gray-200">KELOLA ADMIN</a>
                <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Anda yakin ingin logout?')">
                    @csrf
                    <button type="submit" class="btn bg-blue-600 text-white text-lg w-full">Logout</button>
                </form>
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
                @if (session('msg'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <span class="block sm:inline">{{ session('msg') }}</span>
                        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                            onclick="this.parentElement.remove()">
                            <span class="text-green-500">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="bg-white shadow-md rounded-lg">
                    <div class="p-4 border-b border-gray-200">
                        <form class="flex flex-wrap items-center">
                            <div class="flex-grow mr-2">
                                <input type="text" name="q"
                                    class="border border-gray-300 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="Search..." value="{{ $q }}">
                            </div>
                            <div class="flex space-x-2 mt-2 sm:mt-0">
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-2 rounded-lg">
                                    Search
                                </button>
                                <a href="{{ route('kelola_user.create') }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-4 py-2 rounded-lg flex items-center">
                                    <i class="fa fa-plus mr-1"></i>Tambah
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="p-4 overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="border border-gray-200 px-4 py-2">No</th>
                                    <th class="border border-gray-200 px-4 py-2">Name</th>
                                    <th class="border border-gray-200 px-4 py-2">Email</th>
                                    <th class="border border-gray-200 px-4 py-2">Telepon</th>
                                    <th class="border border-gray-200 px-4 py-2">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = ($users->currentPage() - 1) * $users->perPage() + 1; ?>
                                @foreach ($users as $user)
                                    <tr class="hover:bg-gray-100">
                                        <td class="border border-gray-200 px-4 py-2">{{ $no++ }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $user->nama_user }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $user->email }}</td>
                                        <td class="border border-gray-200 px-4 py-2">{{ $user->telepon }}</td>
                                        <td class="border border-gray-200 px-4 py-2">
                                            <a href="{{ route('kelola_user.edit', $user) }}"
                                                class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold px-2 py-1 rounded-lg">
                                                <i class="fa fa-edit"></i> Ubah
                                            </a>
                                            <form action="{{ route('kelola_user.destroy', $user) }}" method="POST"
                                                onsubmit="return confirm('Hapus data')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold px-2 py-1 rounded-lg">
                                                    <i class="fa fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>

</html>
