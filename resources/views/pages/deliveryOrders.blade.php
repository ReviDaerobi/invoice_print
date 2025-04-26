@extends('layouts.app')

@section('content')
<!-- Page Content -->
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
                <h2 class="text-xl font-semibold text-gray-800">Daftar Delivery Order</h2>
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
                    <input type="text" placeholder="Cari delivery order..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="delivered">Terkirim</option>
                        <option value="pending">Dalam Proses</option>
                        <option value="canceled">Dibatalkan</option>
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
                <form action="{{ route('delivery-order.create') }}" method="GET">
                    @csrf
                    <button class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        <span>Buat Delivery Order</span>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Delivery Orders Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-4 sm:p-6 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Delivery Order</h2>
                <div class="text-sm text-gray-500">Menampilkan {{ $deliveryOrders->firstItem() ?? 0 }} sampai {{ $deliveryOrders->lastItem() ?? 0 }} dari {{ $deliveryOrders->total() }} delivery order</div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No. DO
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Customer
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal DO
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No. PO Customer
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Barang
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
                        @forelse ($deliveryOrders as $do)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ $do->no_do }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 flex-shrink-0 rounded-full bg-{{ ['gray', 'blue', 'green', 'purple', 'red'][rand(0,4)] }}-100 flex items-center justify-center">
                                            <span class="text-xs font-bold">{{ substr($do->customer->nama, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $do->customer->nama }}</div>
                                            <div class="text-xs text-gray-500">{{ $do->customer->no_telp ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $do->tanggal_do->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $do->no_po_customer ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $do->details->count() }} item</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        // Determine if this DO has been invoiced
                                        $hasInvoice = $do->invoices->count() > 0;
                                        $statusText = $hasInvoice ? 'Ditagih' : 'Belum Ditagih';
                                        $statusColor = $hasInvoice ? 'green' : 'yellow';
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('delivery-order.show', $do->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('delivery-order.edit', $do->id) }}" class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('delivery-order.destroy', ['id' => $do->id]) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus delivery order ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data delivery order
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
                            Menampilkan {{ $deliveryOrders->firstItem() ?? 0 }} sampai {{ $deliveryOrders->lastItem() ?? 0 }} dari {{ $deliveryOrders->total() }} delivery order
                        </p>
                    </div>
                    <div class="flex-1 flex justify-center sm:justify-end">
                        {{ $deliveryOrders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection