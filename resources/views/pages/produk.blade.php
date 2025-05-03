@extends('layouts.app')

@section('content')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm z-10">
                <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
                    <div class="flex items-center md:hidden">
                        <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                    </div>
                    
                    <div class="flex-1 md:ml-0 md:mr-auto">
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Produk</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-bell text-xl"></i>
                        </button>
                        <button class="text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class="fas fa-cog text-xl"></i>
                        </button>
                        <div class="md:hidden">
                            <button class="flex items-center focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
                <!-- Action Bar -->
                <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <div class="relative">
                            <input type="text" placeholder="Cari Produk..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Produk</option>
                                <option value="active">Produk Aktif</option>
                                <option value="inactive">Produk Tidak Aktif</option>
                            </select>
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Tanggal</option>
                                <option value="this_month">Baru Bulan Ini</option>
                                <option value="last_month">Bulan Lalu</option>
                                <option value="this_year">Tahun Ini</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <button class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-download mr-2 text-gray-600"></i>
                            <span>Export</span>
                        </button>
                        <form action="{{ route('ProdukCreate') }}" method="GET">
                            @csrf
                            <button class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                <span>Tambah Produk</span>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Produks Table -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="p-4 sm:p-6 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Produk</h2>
                        <div class="text-sm text-gray-500">Menampilkan 1-{{ $produks->count() }} dari {{ $totalProduk }} Produk</div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Produk
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Unit
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Harga
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($produks as $produk)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#PRD{{ str_pad($produk->ItemId, 3, '0', STR_PAD_LEFT) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-sm font-bold">{{ substr($produk->ItemName, 0, 2) }}</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $produk->ItemName }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produk->Unit }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($produk->UnitPrice, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <form action="{{ route('ProdukDetail', ['id' => $produk->ItemId]) }}" method="GET">
                                                @csrf
                                                <button class="text-blue-600 hover:text-blue-900" type="submit">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('produk.edit', ['id' => $produk->ItemId]) }}" method="GET">
                                               @csrf 
                                               <button class="text-gray-600 hover:text-gray-900" type="submit">
                                                   <i class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('produk.destroy',['id' => $produk->ItemId]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-900" type="submit">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                        Tidak ada data produk
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="hidden sm:block">
                                <p class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">{{ $produks->count() }}</span> dari <span class="font-medium">{{ $totalProduk }}</span> Produk
                                </p>
                            </div>
                            <div class="flex-1 flex justify-center sm:justify-end">
                                <nav class="relative z-0 inline-flex shadow-sm -space-x-px">
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <i class="fas fa-chevron-left"></i>
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600 hover:bg-blue-100">
                                        1
                                    </a>
                                    <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </nav>
                            </div>
                     
                        </div>
                    </div>
                </div>
                
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                                <i class="fas fa-box text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Total Produk</h3>
                                <p class="text-2xl font-bold text-gray-800">{{ $totalProduk }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Produk Aktif</h3>
                                <p class="text-2xl font-bold text-gray-800">{{ $aktivProduk }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-100 text-purple-600 mr-4">
                                <i class="fas fa-calendar-alt text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Baru Bulan Ini</h3>
                                <p class="text-2xl font-bold text-gray-800">{{ $produkBulanIni }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="bg-white border-t mt-auto">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center md:justify-between items-center">
                        <p class="text-sm text-gray-500">&copy; 2025 InvoicePro. All rights reserved.</p>
                        <div class="hidden md:flex space-x-6">
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Terms</a>
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Privacy</a>
                            <a href="#" class="text-sm text-gray-500 hover:text-gray-700">Help</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <!-- Alpine.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
@endsection