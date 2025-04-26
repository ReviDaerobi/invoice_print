<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoices - InvoicePro</title>
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
                        <a href="/" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-tachometer-alt w-5 h-5 mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                        <a href="#" class="sidebar-item active flex items-center px-4 py-3 text-blue-600 rounded-lg transition duration-200 hover:bg-blue-50">
                            <i class="fas fa-file-invoice w-5 h-5 mr-3"></i>
                            <span>Invoices</span>
                        </a>
                        <a href="/customers" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fas fa-users w-5 h-5 mr-3"></i>
                            <span>Customer</span>
                        </a>
                        <a href="/delivery-order" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
                            <i class="fa-solid fa-truck-fast w-5 h-5 mr-3"></i>
                            <span>Delivery Order</span>
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
                            <a href="#" class="sidebar-item active flex items-center px-4 py-3 text-blue-600 rounded-lg transition duration-200 hover:bg-blue-50">
                                <i class="fas fa-file-invoice w-5 h-5 mr-3"></i>
                                <span>Invoices</span>
                            </a>
                            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-600 rounded-lg transition duration-200 hover:bg-blue-50 hover:text-blue-600">
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
                        <h2 class="text-xl font-semibold text-gray-800">Daftar Invoice</h2>
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
                            <input type="text" placeholder="Cari invoice..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Status</option>
                                <option value="paid">Dibayar</option>
                                <option value="pending">Tertunda</option>
                                <option value="overdue">Terlambat</option>
                            </select>
                            <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Tanggal</option>
                                <option value="this_month">Bulan Ini</option>
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
                        <form action="{{ route('invoiceCreate') }}" method="GET">
                            @csrf
                            <button class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                                <i class="fas fa-plus mr-2"></i>
                                <span>Buat Invoice</span>
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Invoices Table -->
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    <div class="p-4 sm:p-6 border-b flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-800">Daftar Invoice</h2>
                        <div class="text-sm text-gray-500">Menampilkan 1-5 dari 5 invoice</div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        No. Invoice
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Customer
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tanggal
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Jatuh Tempo
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Total
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($invoices as $invoice)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ $invoice->nomor_invoice }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-8 w-8 flex-shrink-0 rounded-full bg-{{ ['gray', 'blue', 'green', 'purple', 'red'][rand(0,4)] }}-100 flex items-center justify-center">
                                                    <span class="text-xs font-bold">{{ $invoice->customer->inisial }}</span>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="text-sm font-medium text-gray-900">{{ $invoice->customer->nama }}</div>
                                                    <div class="text-xs text-gray-500">{{ $invoice->customer->no_telp }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $invoice->tanggal_invoice->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $invoice->tanggal_invoice->addDays(14)->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $invoice->status_color }}-100 text-{{ $invoice->status_color }}-800">{{ $invoice->status }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <a href="{{ route('invoice.detail', $invoice->id) }}" class="text-blue-600 hover:text-blue-900">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('invoice.edit', $invoice->id) }}" class="text-gray-600 hover:text-gray-900">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('invoice.destroy', ['id' => $invoice->id]) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus invoice ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Tidak ada data invoice
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
                                    Menampilkan {{ $invoices->firstItem() ?? 0 }} sampai {{ $invoices->lastItem() ?? 0 }} dari {{ $invoices->total() }} invoice
                                </p>
                            </div>
                            <div class="flex-1 flex justify-center sm:justify-end">
                                {{ $invoices->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>

</html>