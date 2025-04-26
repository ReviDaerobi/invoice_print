<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers - InvoicePro</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .sidebar-item.active {
            background-color: rgba(59, 130, 246, 0.1);
            border-right: 3px solid #3b82f6;
            color: #3b82f6;
        }
        
        .bg-dots-light {
            background-image: radial-gradient(rgba(0, 0, 0, 0.05) 2px, transparent 2px);
            background-size: 30px 30px;
        }
        
        .bg-dots-dark {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 2px, transparent 2px);
            background-size: 30px 30px;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="bg-white shadow-lg w-64 flex-shrink-0 hidden md:flex flex-col">
            <div class="flex items-center justify-center h-16 border-b">
                <h1 class="text-2xl font-bold text-blue-600">InvoicePro</h1>
            </div>
            <div class="overflow-y-auto flex-grow">
                <nav class="mt-6 px-4">
                    <div class="space-y-2">
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-file-invoice w-5 h-5 mr-3"></i>
                            <span>Invoices</span>
                        </a>
                        <a href="#" class="sidebar-item active flex items-center px-4 py-3 text-blue-600 rounded-lg transition duration-200 hover:bg-blue-50">
                            <i class="fas fa-users w-5 h-5 mr-3"></i>
                            <span>Customer</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-box w-5 h-5 mr-3"></i>
                            <span>Transaksi</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                            <span>Laporan</span>
                        </a>
                        <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-cog w-5 h-5 mr-3"></i>
                            <span>Pengaturan</span>
                        </a>
                    </div>
                </nav>
            </div>
            <div class="border-t p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Mobile sidebar & overlay -->
        <div class="md:hidden" x-data="{ sidebarOpen: false }">
            <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50"></div>
            
            <div x-show="sidebarOpen" class="fixed inset-y-0 left-0 w-64 z-50 bg-white shadow-lg flex flex-col">
                <div class="flex items-center justify-between h-16 border-b px-4">
                    <h1 class="text-xl font-bold text-blue-600">InvoicePro</h1>
                    <button @click="sidebarOpen = false" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="overflow-y-auto flex-grow">
                    <nav class="mt-6 px-4">
                        <div class="space-y-2">
                            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                                <span>Dashboard</span>
                            </a>
                            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-file-invoice w-5 h-5 mr-3"></i>
                                <span>Invoices</span>
                            </a>
                            <a href="#" class="sidebar-item active flex items-center px-4 py-3 text-blue-600 rounded-lg transition duration-200 hover:bg-blue-50">
                                <i class="fas fa-users w-5 h-5 mr-3"></i>
                                <span>Customer</span>
                            </a>
                            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-box w-5 h-5 mr-3"></i>
                                <span>Transaksi</span>
                            </a>
                            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-chart-bar w-5 h-5 mr-3"></i>
                                <span>Laporan</span>
                            </a>
                            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-cog w-5 h-5 mr-3"></i>
                                <span>Pengaturan</span>
                            </a>
                        </div>
                    </nav>
                </div>
                <div class="border-t p-4">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-100 transition duration-200">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
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
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Customer</h2>
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
                            <input type="text" placeholder="Cari customer..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Customer</option>
                                <option value="active">Customer Aktif</option>
                                <option value="inactive">Customer Tidak Aktif</option>
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
                        <form action="{{ route('customerCreate') }}" method="GET">
                            @csrf
                            <button class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                <span>Tambah Customer</span>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Customers Table -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="p-4 sm:p-6 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Customer</h2>
                        <div class="text-sm text-gray-500">Menampilkan 1-5 dari 5 customer</div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Alamat
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Telp
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Contact Person
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Terdaftar
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#CST001</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-blue-100 flex items-center justify-center">
                                                <span class="text-sm font-bold">PT</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">PT. Maju Jaya</div>
                                                <div class="text-xs text-gray-500">info@majujaya.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Jl. Gatot Subroto No. 123</div>
                                        <div class="text-xs text-gray-500">Jakarta Selatan, DKI Jakarta</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">021-5551234</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Budi Santoso</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">10 Mar 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#CST002</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-green-100 flex items-center justify-center">
                                                <span class="text-sm font-bold">TS</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Toko Sejahtera</div>
                                                <div class="text-xs text-gray-500">toko@sejahtera.id</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Jl. Pahlawan No. 45</div>
                                        <div class="text-xs text-gray-500">Bandung, Jawa Barat</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">022-8765432</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Siti Aminah</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25 Feb 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#CST003</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-purple-100 flex items-center justify-center">
                                                <span class="text-sm font-bold">CV</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">CV Mandiri Abadi</div>
                                                <div class="text-xs text-gray-500">info@mandiriabadi.co.id</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Jl. Diponegoro No. 78</div>
                                        <div class="text-xs text-gray-500">Surabaya, Jawa Timur</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">031-5557890</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Hendra Wijaya</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Mar 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#CST004</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-yellow-100 flex items-center justify-center">
                                                <span class="text-sm font-bold">SB</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">PT. Sukses Bersama</div>
                                                <div class="text-xs text-gray-500">admin@suksesbersama.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Jl. Ahmad Yani No. 55</div>
                                        <div class="text-xs text-gray-500">Semarang, Jawa Tengah</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">024-7654321</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rina Wati</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">3 Apr 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <button class="text-blue-600 hover:text-blue-900">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#CST005</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0 rounded-full bg-red-100 flex items-center justify-center">
                                                <span class="text-sm font-bold">BM</span>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">Bintang Makmur</div>
                                                <div class="text-xs text-gray-500">contact@bintangmakmur.net</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">Jl. Hayam Wuruk No. 32</div>
                                        <div class="text-xs text-gray-500">Denpasar, Bali</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0361-987654</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Made Surya</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">28 Feb 2025</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <form action="{{ route('customerDetail') }}" method="GET">
                                                @csrf
                                                <button class="text-blue-600 hover:text-blue-900" type="submit">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </form>
                                            <button class="text-gray-600 hover:text-gray-900">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        <div class="flex items-center justify-between">
                            <div class="hidden sm:block">
                                <p class="text-sm text-gray-700">
                                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">5</span> dari <span class="font-medium">5</span> customer
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
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Total Customer</h3>
                                <p class="text-2xl font-bold text-gray-800">5</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                                <i class="fas fa-user-check text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Customer Aktif</h3>
                                <p class="text-2xl font-bold text-gray-800">5</p>
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
                                <p class="text-2xl font-bold text-gray-800">3</p>
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
</body>
</html>