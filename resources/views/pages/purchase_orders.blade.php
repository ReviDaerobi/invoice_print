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
                <h2 class="text-xl font-semibold text-gray-800">Daftar Purchase Orders</h2>
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
                    <input type="text" placeholder="Cari Purchase Orders..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <select class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Customer</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                        @endforeach
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
                <form action="{{ route('PO.create') }}" method="GET">
                    @csrf
                    <button class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        <span>Tambah Purchase Orders</span>
                    </button>
                </form>
            </div>
        </div>
        
        <!-- Purchase Orderss Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="p-4 sm:p-6 border-b flex justify-between items-center">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Purchase Orders</h2>
                <div class="text-sm text-gray-500">Menampilkan {{ $POs->firstItem() ?? 0 }} sampai {{ $POs->lastItem() ?? 0 }} dari {{ $POs->total() }} Purchase Orders</div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
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
                                Total Revenue
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Total Cost
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Profit
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($POs as $record)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600">{{ $record->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->invoice->no_invoice ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 flex-shrink-0 rounded-full bg-{{ ['gray', 'blue', 'green', 'purple', 'red'][rand(0,4)] }}-100 flex items-center justify-center">
                                            <span class="text-xs font-bold">{{ substr($record->customer->nama, 0, 1) }}</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900">{{ $record->customer->nama }}</div>
                                            <div class="text-xs text-gray-500">{{ $record->customer->no_telp ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $record->tanggal->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($record->total_revenue, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Rp {{ number_format($record->total_cost, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $profitClass = $record->profit > 0 ? 'green' : 'red';
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-{{ $profitClass }}-100 text-{{ $profitClass }}-800">
                                        Rp {{ number_format($record->profit, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('PO.show', $record->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('PO.edit', $record->id) }}" class="text-gray-600 hover:text-gray-900">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('PO.destroy', $record->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus Purchase Orders ini?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                    Tidak ada data Purchase Orders
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
                            Menampilkan {{ $POs->firstItem() ?? 0 }} sampai {{ $POs->lastItem() ?? 0 }} dari {{ $POs->total() }} Purchase Orders
                        </p>
                    </div>
                    <div class="flex-1 flex justify-center sm:justify-end">
                        {{ $POs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection