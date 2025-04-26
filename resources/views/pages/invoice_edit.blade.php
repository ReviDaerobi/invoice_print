<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invoice - InvoicePro</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
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
                        <h2 class="text-xl font-semibold text-gray-800">Edit Invoice #{{ $invoice->nomor_invoice }}</h2>
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
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <a href="{{ route('invoice') }}" class="flex items-center text-gray-600 hover:text-blue-600">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Kembali ke Daftar Invoice</span>
                        </a>
                    </div>
                    <div class="flex space-x-3">
                        <button type="button" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                            <i class="fas fa-save mr-2 text-gray-600"></i>
                            <span>Simpan Draft</span>
                        </button>
                        <button form="invoice-form" type="submit" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            <span>Update Invoice</span>
                        </button>
                    </div>
                </div>
                
                <!-- Invoice Form -->
                <form id="invoice-form" action="{{ route('invoices.update', $invoice->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Info Card -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Informasi Dasar</h2>
                            <p class="text-sm text-gray-500 mt-1">Detail dasar invoice</p>
                        </div>
                        
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nomor_invoice" class="block text-sm font-medium text-gray-700 mb-1">No. Invoice</label>
                                <div class="relative rounded-md shadow-sm">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">#</span>
                                    <input type="text" name="nomor_invoice" id="nomor_invoice" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-8 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ $invoice->nomor_invoice }}" readonly>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Nomor invoice tidak dapat diubah</p>
                            </div>
                            
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select id="status" name="status" class="mt-1 block w-full h-9 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" disabled>
                                    <option value="Tertunda" {{ $invoice->status == 'Tertunda' ? 'selected' : '' }}>Tertunda</option>
                                    <option value="Dibayar" {{ $invoice->status == 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
                                    <option value="Terlambat" {{ $invoice->status == 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                                </select>
                                <p class="mt-1 text-xs text-gray-500">Status otomatis ditentukan sistem</p>
                            </div>
                            
                            <div>
                                <label for="tanggal_invoice" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Invoice</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="far fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" name="tanggal_invoice" id="tanggal_invoice" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-10 sm:text-sm border-gray-300 rounded-md" value="{{ $invoice->tanggal_invoice->format('Y-m-d') }}">
                                </div>
                            </div>
                            
                            <div>
                                <label for="no_po_customer" class="block text-sm font-medium text-gray-700 mb-1">No. PO Customer</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="far fa-file-alt text-gray-400"></i>
                                    </div>
                                    <input type="text" name="no_po_customer" id="no_po_customer" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-10 sm:text-sm border-gray-300 rounded-md" value="{{ $invoice->no_po_customer }}">
                                </div>
                            </div>
                            
                            <div>
                                <label for="attention" class="block text-sm font-medium text-gray-700 mb-1">Attention</label>
                                <input type="text" name="attention" id="attention" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 sm:text-sm border-gray-300 rounded-md" value="{{ $invoice->attention }}">
                            </div>
                            
                            <div>
                                <label for="delivery_order_id" class="block text-sm font-medium text-gray-700 mb-1">Delivery Order</label>
                                <select id="delivery_order_id" name="delivery_order_id" class="mt-1 block w-full h-9 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="">-- Pilih Delivery Order --</option>
                                    @foreach($deliveryOrders as $do)
                                        <option value="{{ $do->id }}" {{ $invoice->delivery_order_id == $do->id ? 'selected' : '' }}>
                                            {{ $do->nomor_do }} - {{ $do->tanggal_do->format('d/m/Y') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="keterangan_pengiriman" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Pengiriman</label>
                                <textarea id="keterangan_pengiriman" name="keterangan_pengiriman" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Detail pengiriman atau catatan tambahan...">{{ $invoice->keterangan_pengiriman }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer Info Card -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Informasi Customer</h2>
                            <p class="text-sm text-gray-500 mt-1">Data customer terkait invoice ini</p>
                        </div>
                        
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                    <select id="customer_id" name="customer_id" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-10 sm:text-sm border-gray-300 rounded-md">
                                        <option value="">-- Pilih Customer --</option>
                                        @foreach($customers as $customer)
    <option value="{{ $customer->id }}" {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
        {{ $customer->nama }} - {{ $customer->contact_person ?? $customer->no_telp }}
    </option>
@endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <!-- Customer details will be loaded here via JavaScript -->
                            <div id="customer-details" class="mt-4 p-4 bg-gray-50 rounded-lg border border-gray-200" style="display: {{ $invoice->customer_id ? 'block' : 'none' }}">
                                <h3 class="font-medium text-gray-700 mb-2">Detail Customer</h3>
                                <div id="customer-info" class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                    <!-- This will be populated by JavaScript -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                  <!-- Bagian Items Table Card -->
<div class="bg-white rounded-xl shadow overflow-hidden" x-data="invoiceItems()">
    <div class="p-6 border-b">
        <h2 class="text-lg font-semibold text-gray-800">Item & Layanan</h2>
        <p class="text-sm text-gray-500 mt-1">Item atau layanan dalam invoice</p>
    </div>
    
    <div class="p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama Barang
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Satuan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Harga Satuan
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Total
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <template x-for="(item, index) in items" :key="index">
                        <tr>
                            <td class="px-6 py-4">
                                <input type="text" x-model="item.nama_barang" :name="'details['+index+'][nama_barang]'" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Nama barang">
                                <input type="hidden" x-model="item.id" :name="'details['+index+'][id]'" x-show="item.id">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="number" x-model="item.jumlah" :name="'details['+index+'][jumlah]'" min="1" class="focus:ring-blue-500 focus:border-blue-500 block w-24 sm:text-sm border-gray-300 rounded-md" @input="calculateTotals()">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="text" x-model="item.satuan" :name="'details['+index+'][satuan]'" class="focus:ring-blue-500 focus:border-blue-500 block w-24 sm:text-sm border-gray-300 rounded-md" placeholder="Pcs">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                    </div>
                                    <input type="number" x-model="item.harga" :name="'details['+index+'][harga]'" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="0" @input="calculateTotals()">
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <span x-text="formatPrice(item.total_harga)"></span>
                                <input type="hidden" x-model="item.total_harga" :name="'details['+index+'][total_harga]'">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button @click="removeItem(index)" type="button" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    
                    <tr>
                        <td colspan="6" class="px-6 py-4">
                            <button @click="addItem()" type="button" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Item
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Subtotal Section -->
                    <tr class="bg-gray-50">
                        <td colspan="3" class="px-6 py-4"></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                            Subtotal
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            <span x-text="formatPrice(subtotal)"></span>
                            <input type="hidden" name="subtotal" x-model="subtotal">
                        </td>
                        <td></td>
                    </tr>
                                        
                                        <!-- Ongkos Kirim -->
                                        <tr class="bg-gray-50">
                                            <td colspan="3" class="px-6 py-4"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                                                Ongkos Kirim
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                                    </div>
                                                    <input type="number" name="ongkos_kirim" x-model="ongkosKirim" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" @input="calculateTotals()">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        
                                        <!-- Bea Materai -->
                                        <tr class="bg-gray-50">
                                            <td colspan="3" class="px-6 py-4"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                                                Bea Materai
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="relative rounded-md shadow-sm">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">Rp</span>
                                                    </div>
                                                    <input type="number" name="bea_materai" x-model="beaMaterai" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" @input="calculateTotals()">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        
                                        <!-- PPN -->
                                        <tr class="bg-gray-50">
                                            <td colspan="3" class="px-6 py-4"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700 text-right">
                                                PPN (11%)
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="relative flex items-start mr-4">
                                                        <div class="flex items-center h-5">
                                                            <input id="include_ppn" name="include_ppn" type="checkbox" x-model="includePpn" class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded" @change="calculateTotals()">
                                                        </div>
                                                        <div class="ml-2 text-sm">
                                                            <label for="include_ppn" class="font-medium text-gray-700">Tambahkan PPN</label>
                                                        </div>
                                                    </div>
                                                    <span class="text-sm font-medium text-gray-900" x-text="formatPrice(ppnAmount)"></span>
                                                    <input type="hidden" name="ppn_amount" x-model="ppnAmount">
                                                </div>
                                            </td>
                                            <td></td>
                                        </tr>
                                        
                                        <!-- Total -->
                                        <tr class="bg-blue-50">
                                            <td colspan="3" class="px-6 py-4"></td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900 text-right">
                                                Total
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                                <span x-text="formatPrice(totalAmount)"></span>
                                                <input type="hidden" name="total_amount" x-model="totalAmount">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                 
                    
                    <!-- Notes and Terms Card -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Catatan & Syarat</h2>
                            <p class="text-sm text-gray-500 mt-1">Tambahkan catatan atau syarat dalam invoice</p>
                        </div>
                        
                        <div class="p-6 grid grid-cols-1 gap-6">
                            <div>
                                <label for="catatan" class="block text-sm font-medium text-gray-700 mb-1">Catatan Invoice</label>
                                <textarea id="catatan" name="catatan" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tambahkan catatan untuk customer...">{{ $invoice->catatan }}</textarea>
                            </div>
                            
                            <div>
                                <label for="syarat_ketentuan" class="block text-sm font-medium text-gray-700 mb-1">Syarat & Ketentuan</label>
                                <textarea id="syarat_ketentuan" name="syarat_ketentuan" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Contoh: Pembayaran harus dilakukan dalam 14 hari...">{{ $invoice->syarat_ketentuan }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action buttons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('invoice') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Invoice
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    
    <script>

        // JavaScript untuk menampilkan detail customer
document.addEventListener('DOMContentLoaded', function() {
    const customerSelect = document.getElementById('customer_id');
    const customerDetails = document.getElementById('customer-details');
    const customerInfo = document.getElementById('customer-info');
    
    // Inisialisasi detail customer jika sudah ada yang dipilih
    if (customerSelect.value) {
        showCustomerDetails(customerSelect.value);
    }
    
    // Event listener untuk perubahan pilihan customer
    customerSelect.addEventListener('change', function() {
        if (this.value) {
            showCustomerDetails(this.value);
        } else {
            customerDetails.style.display = 'none';
        }
    });
    
    function showCustomerDetails(customerId) {
        // Ambil data customer dari server
        fetch(`/api/customers/${customerId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(customer => {
                // Tampilkan detail customer
                customerDetails.style.display = 'block';
                customerInfo.innerHTML = `
                    <div>
                        <p class="text-gray-500">Nama</p>
                        <p class="font-medium">${customer.nama || '-'}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Kontak</p>
                        <p class="font-medium">${customer.contact_person || '-'}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Telepon</p>
                        <p class="font-medium">${customer.no_telp || '-'}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Alamat</p>
                        <p class="font-medium">${customer.alamat_1 || '-'}${customer.alamat_2 ? ', ' + customer.alamat_2 : ''}${customer.alamat_3 ? ', ' + customer.alamat_3 : ''}</p>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error fetching customer details:', error);
                customerInfo.innerHTML = '<p class="text-red-500">Gagal memuat data customer</p>';
            });
    }
});

// Add this to your existing script section
document.addEventListener('DOMContentLoaded', function() {
    // Initialize customer details if a customer is already selected
    const customerId = document.getElementById('customer_id').value;
    if (customerId) {
        fetchCustomerDetails(customerId);
    }
    
    // Set up event listener for customer selection change
    document.getElementById('customer_id').addEventListener('change', function() {
        const selectedId = this.value;
        if (selectedId) {
            fetchCustomerDetails(selectedId);
        } else {
            document.getElementById('customer-details').style.display = 'none';
        }
    });
    
    function fetchCustomerDetails(customerId) {
        // Make AJAX request to get customer details
        fetch(`/api/customers/${customerId}`)
            .then(response => response.json())
            .then(customer => {
                // Show the customer details section
                document.getElementById('customer-details').style.display = 'block';
                
                // Populate customer info
                document.getElementById('customer-info').innerHTML = `
                    <div>
                        <p class="text-gray-500">Nama</p>
                        <p class="font-medium">${customer.nama}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Kontak</p>
                        <p class="font-medium">${customer.contact_person || '-'}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Telepon</p>
                        <p class="font-medium">${customer.no_telp || '-'}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Alamat</p>
                        <p class="font-medium">${customer.alamat_1}${customer.alamat_2 ? ', ' + customer.alamat_2 : ''}${customer.alamat_3 ? ', ' + customer.alamat_3 : ''}</p>
                    </div>
                `;
            })
            .catch(error => {
                console.error('Error fetching customer details:', error);
            });
    }
});

        // Pastikan Alpine.js diimport
document.addEventListener('alpine:init', () => {
    Alpine.data('invoiceItems', () => ({
        items: [],
        subtotal: 0,
        ongkosKirim: 0,
        beaMaterai: 0,
        includePpn: false,
        ppnAmount: 0,
        totalAmount: 0,
        
        init() {
            // Muat data item dari JSON yang disediakan dari server
            // Jika tidak ada item, tambahkan item kosong
            const invoiceDetails = @json($invoice->details);
            
            if (invoiceDetails && invoiceDetails.length > 0) {
                this.items = invoiceDetails;
            } else {
                this.addItem();
            }
            
            // Set nilai awal
            this.ongkosKirim = {{ $invoice->ongkos_kirim ?? 0 }};
            this.beaMaterai = {{ $invoice->bea_materai ?? 0 }};
            this.includePpn = {{ $invoice->include_ppn ? 'true' : 'false' }};
            
            this.calculateTotals();
        },
        
        addItem() {
            this.items.push({
                id: null,
                nama_barang: '',
                jumlah: 1,
                satuan: 'Pcs',
                harga: 0,
                total_harga: 0
            });
        },
        
        removeItem(index) {
            if (this.items.length > 1) {
                this.items.splice(index, 1);
                this.calculateTotals();
            }
        },
        
        calculateTotals() {
            // Hitung total per item
            this.items.forEach(item => {
                item.total_harga = item.jumlah * item.harga;
            });
            
            // Hitung subtotal
            this.subtotal = this.items.reduce((sum, item) => sum + parseFloat(item.total_harga || 0), 0);
            
            // Hitung PPN jika dicentang
            this.ppnAmount = this.includePpn ? this.subtotal * 0.11 : 0;
            
            // Hitung total keseluruhan
            this.totalAmount = this.subtotal + parseFloat(this.ongkosKirim || 0) + parseFloat(this.beaMaterai || 0) + this.ppnAmount;
        },
        
        formatPrice(value) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value || 0);
        }
    }));
});
        
     
    </script>
</body>
</html>