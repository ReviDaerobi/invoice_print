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
                    <h2 class="text-xl font-semibold text-gray-800">Detail Produk</h2>
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
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <a href="{{ route('produk.index') }}" class="flex items-center text-blue-600 hover:text-blue-800">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali ke Daftar Produk</span>
                    </a>
                </div>
                <div class="flex space-x-3">
                    <form action="{{ route('produk.edit' , ['id' => $produk->ItemId]) }}" method="GET">
                        @csrf
                        <button class="flex items-center px-4 py-2 border border-gray-300 bg-white rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-edit mr-2 text-gray-600"></i>
                            <span>Edit Produk</span>
                        </button>
                    </form>
                    <form action="{{ route('produk.destroy', ['id' => $produk->ItemId]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button class="flex items-center px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                            <i class="fas fa-trash mr-2"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
            </div>
            
            @if(isset($produk))
            <!-- Product Details -->
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="p-6 border-b">
                    <div class="flex items-center">
                        <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center mr-4">
                            <span class="text-lg font-bold">{{ substr($produk->ItemName, 0, 2) }}</span>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">{{ $produk->ItemName }}</h1>
                            <p class="text-gray-500">ID Produk: #PRD{{ str_pad($produk->ItemId, 3, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Produk</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Nama Produk</p>
                                    <p class="text-base font-medium text-gray-800">{{ $produk->ItemName }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Unit</p>
                                    <p class="text-base font-medium text-gray-800">{{ $produk->Unit }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Harga</p>
                                    <p class="text-base font-medium text-gray-800">Rp {{ number_format($produk->UnitPrice, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Tambahan</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Status</p>
                                    <div class="flex items-center mt-1">
                                        <span class="h-2.5 w-2.5 rounded-full bg-green-500 mr-2"></span>
                                        <p class="text-base font-medium text-gray-800">Aktif</p>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Dibuat</p>
                                    <p class="text-base font-medium text-gray-800">{{ isset($produk->created_at) ? $produk->created_at->format('d M Y') : 'Tidak tersedia' }}</p>
                                </div>
                                
                                <div>
                                    <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                                    <p class="text-base font-medium text-gray-800">{{ isset($produk->updated_at) ? $produk->updated_at->format('d M Y') : 'Tidak tersedia' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Usage History (you can expand this section later) -->
            <div class="bg-white rounded-xl shadow overflow-hidden mt-6">
                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-800">Riwayat Penggunaan</h3>
                </div>
                
                <div class="p-6">
                    <p class="text-gray-500">Tidak ada data riwayat penggunaan untuk ditampilkan.</p>
                </div>
            </div>
            @else
            <div class="bg-white rounded-xl shadow overflow-hidden">
                <div class="p-6 text-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mx-auto mb-4 w-16 h-16 flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Produk tidak ditemukan</h3>
                    <p class="text-gray-500 mb-4">Data produk yang Anda cari tidak ditemukan atau belum tersedia.</p>
                    <a href="{{ route('produk.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Kembali ke Daftar Produk</span>
                    </a>
                </div>
            </div>
            @endif
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
    
    <!-- Alpine.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
@endsection