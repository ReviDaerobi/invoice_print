@extends('layouts.app')

@section('content')
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
                <h2 class="text-xl font-semibold text-gray-800">Buat Purchase Order Baru</h2>
            </div>
        </div>
    </header>
    
    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-4 sm:p-6 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Purchase Order</h3>
                    <p class="mt-1 text-sm text-gray-500">Lengkapi informasi purchase order di bawah ini.</p>
                </div>
                
                <form action="{{ route('PO.store') }}" method="POST" class="p-4 sm:p-6 space-y-6">
                    @csrf
                    
                    <!-- PO Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="invoice_id" class="block text-sm font-medium text-gray-700">Invoice</label>
                            <select name="invoice_id" id="invoice_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">Pilih Invoice</option>
                                @foreach($invoices as $invoice)
                                    <option value="{{ $invoice->id }}" {{ old('invoice_id') == $invoice->id ? 'selected' : '' }}>
                                        {{ $invoice->invoice_number }}
                                    </option>
                                @endforeach
                            </select>
                            @error('invoice_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('tanggal') ?? date('Y-m-d') }}" required>
                            @error('tanggal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
                            <select name="customer_id" id="customer_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                <option value="">Pilih Customer</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Financial Information -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="total_revenue" class="block text-sm font-medium text-gray-700">Total Revenue</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="total_revenue" id="total_revenue" class="mt-1 block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('total_revenue') }}" step="0.01" min="0" required onchange="calculateProfit()">
                            </div>
                            @error('total_revenue')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="total_cost" class="block text-sm font-medium text-gray-700">Total Cost</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="total_cost" id="total_cost" class="mt-1 block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('total_cost') }}" step="0.01" min="0" required onchange="calculateProfit()">
                            </div>
                            @error('total_cost')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="profit" class="block text-sm font-medium text-gray-700">Profit</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Rp</span>
                                </div>
                                <input type="number" name="profit" id="profit" class="mt-1 block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('profit') }}" step="0.01" readonly>
                            </div>
                            @error('profit')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-5 border-t">
                        <a href="{{ route('PO.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>

<script>
    function calculateProfit() {
        const revenue = parseFloat(document.getElementById('total_revenue').value) || 0;
        const cost = parseFloat(document.getElementById('total_cost').value) || 0;
        const profit = revenue - cost;
        document.getElementById('profit').value = profit.toFixed(2);
    }
</script>
@endsection