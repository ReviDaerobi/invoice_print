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
                        <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
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
                <!-- Welcome Banner -->
                <div class="mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-700  shadow-lg">
                    <div class="px-6 py-8 md:px-8 md:py-10 relative">
                        <div class="relative z-10">
                            <h1 class="text-2xl font-bold text-white sm:text-3xl">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                            <p class="mt-2 max-w-lg text-blue-100">
                                Kelola invoice bisnis Anda dengan mudah. Buat invoice baru, lacak pembayaran, dan lihat laporan di satu tempat.
                            </p>
                            {{-- <div class="mt-6">
                                <a href="/invoices/create" class="inline-flex items-center rounded-lg bg-white px-4 py-2 text-sm font-medium text-blue-600 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    <i class="fas fa-plus mr-2"></i> Buat Invoice Baru
                                </a>
                            </div> --}}
                        </div>
                        
                        <!-- Decorative elements -->
                        <div class="absolute top-6 right-12 w-20 h-20 bg-white/10 rounded-full blur-xl"></div>
                        <div class="absolute bottom-10 left-10 w-32 h-32 bg-purple-500/20 rounded-full blur-xl"></div>
                    </div>
                </div>
                
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
                    <div class="rounded-xl bg-white shadow p-6 flex items-center border-l-4 border-blue-500">
                        <div class="p-3 rounded-full bg-blue-50 mr-4">
                            <i class="fas fa-file-invoice text-xl text-blue-500"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium">Total Invoice</h3>
                            <p class="text-2xl font-bold text-gray-800">0</p>
                            <p class="text-xs font-medium text-green-500 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i> 0% dari bulan lalu
                            </p>
                        </div>
                    </div>
                    
                    <div class="rounded-xl bg-white shadow p-6 flex items-center border-l-4 border-green-500">
                        <div class="p-3 rounded-full bg-green-50 mr-4">
                            <i class="fas fa-check-circle text-xl text-green-500"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium">Invoice Dibayar</h3>
                            <p class="text-2xl font-bold text-gray-800">0</p>
                            <p class="text-xs font-medium text-green-500 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i> 0% dari bulan lalu
                            </p>
                        </div>
                    </div>
                    
                    <div class="rounded-xl bg-white shadow p-6 flex items-center border-l-4 border-yellow-500">
                        <div class="p-3 rounded-full bg-yellow-50 mr-4">
                            <i class="fas fa-clock text-xl text-yellow-500"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium">Invoice Tertunda</h3>
                            <p class="text-2xl font-bold text-gray-800">0</p>
                            <p class="text-xs font-medium text-green-500 mt-1">
                                <i class="fas fa-arrow-up mr-1"></i> 0% dari bulan lalu
                            </p>
                        </div>
                    </div>
                    
                    <div class="rounded-xl bg-white shadow p-6 flex items-center border-l-4 border-red-500">
                        <div class="p-3 rounded-full bg-red-50 mr-4">
                            <i class="fas fa-exclamation-triangle text-xl text-red-500"></i>
                        </div>
                        <div>
                            <h3 class="text-gray-500 text-sm font-medium">Invoice Terlambat</h3>
                            <p class="text-2xl font-bold text-gray-800">0</p>
                            <p class="text-xs font-medium text-red-500 mt-1">
                                <i class="fas fa-arrow-down mr-1"></i> 0% dari bulan lalu
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Invoices & Quick Actions -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Recent Invoices -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-xl shadow overflow-hidden">
                            <div class="p-4 sm:p-6 border-b flex justify-between items-center">
                                <h2 class="text-lg font-semibold text-gray-800">Invoice Terbaru</h2>
                                <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">Lihat Semua</a>
                            </div>
                            
                            <div class="p-6 text-center text-gray-500">
                                <div class="py-12">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-50 text-blue-500 mb-4">
                                        <i class="fas fa-file-invoice text-3xl"></i>
                                    </div>
                                    <p class="text-lg font-medium">Belum ada invoice yang dibuat</p>
                                    <p class="text-sm mt-2 max-w-md mx-auto">Klik tombol "Buat Invoice Baru" untuk mulai membuat invoice pertama Anda</p>
                                    <div class="mt-6">
                                        <a href="/invoices/create" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                            <i class="fas fa-plus mr-2"></i> Buat Invoice Baru
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-xl shadow overflow-hidden">
                            <div class="p-4 sm:p-6 border-b">
                                <h2 class="text-lg font-semibold text-gray-800">Aksi Cepat</h2>
                            </div>
                            <div class="p-4 sm:p-6">
                                <div class="space-y-4">
                                    <a href="/produk/create" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                                        <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-box text-purple-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-800">Tambah Produk</h3>
                                            <p class="text-sm text-gray-500">Tambahkan produk atau layanan</p>
                                        </div>
                                    </a>
                                    <a href="/customers/create" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                                        <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-user-plus text-green-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-800">Tambah Klien</h3>
                                            <p class="text-sm text-gray-500">Tambahkan klien baru</p>
                                        </div>
                                    </a>
                                    <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-plus text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-800">Tambah Quotation</h3>
                                            <p class="text-sm text-gray-500">Buat Quotation baru untuk klien</p>
                                        </div>
                                    </a>
                                    <a href="/invoices/create" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                                        <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-plus text-blue-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-800">Buat Invoice</h3>
                                            <p class="text-sm text-gray-500">Buat invoice baru untuk klien</p>
                                        </div>
                                    </a>
                                    
                                    
                                    
                                    <a href="#" class="flex items-center p-3 rounded-lg border border-gray-200 hover:bg-blue-50 hover:border-blue-200 transition duration-200">
                                        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-chart-line text-indigo-600"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-medium text-gray-800">Lihat Laporan</h3>
                                            <p class="text-sm text-gray-500">Akses laporan dan analitik</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>


@endsection