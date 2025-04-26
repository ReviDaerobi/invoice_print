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
                <h2 class="text-xl font-semibold text-gray-800">Buat Delivery Order Baru</h2>
            </div>
        </div>
    </header>
    
    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-4 sm:p-6 border-b">
                    <h3 class="text-lg font-medium text-gray-900">Informasi Delivery Order</h3>
                    <p class="mt-1 text-sm text-gray-500">Lengkapi informasi delivery order di bawah ini.</p>
                </div>
                
                <form action="{{ route('delivery-order.store') }}" method="POST" class="p-4 sm:p-6 space-y-6">
                    @csrf
                    
                    <!-- Delivery Order Information -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="no_do" class="block text-sm font-medium text-gray-700">No. Delivery Order</label>
                            <input type="text" name="no_do" id="no_do" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('no_do') }}" required>
                            @error('no_do')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="tanggal_do" class="block text-sm font-medium text-gray-700">Tanggal Delivery Order</label>
                            <input type="date" name="tanggal_do" id="tanggal_do" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('tanggal_do', date('Y-m-d')) }}" required>
                            @error('tanggal_do')
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
                        
                        <div>
                            <label for="purchase_order_id" class="block text-sm font-medium text-gray-700">Purchase Order (Opsional)</label>
                            <select name="purchase_order_id" id="purchase_order_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Purchase Order</option>
                                @foreach($purchaseOrders as $po)
                                    <option value="{{ $po->id }}" {{ old('purchase_order_id') == $po->id ? 'selected' : '' }}>
                                        {{ $po->no_po }} - {{ $po->customer->nama ?? 'Unknown' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('purchase_order_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="no_po_customer" class="block text-sm font-medium text-gray-700">No. PO Customer (Opsional)</label>
                            <input type="text" name="no_po_customer" id="no_po_customer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" value="{{ old('no_po_customer') }}">
                            @error('no_po_customer')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Items Section -->
                    <div class="mt-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Detail Barang</h3>
                            <button type="button" id="add-item" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-plus mr-2"></i> Tambah Barang
                            </button>
                        </div>
                        
                        <div class="border rounded-md p-4">
                            <div id="items-container">
                                <!-- Initial item row -->
                                <div class="item-row grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                                        <input type="text" name="items[0][nama_barang]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                        <input type="number" name="items[0][jumlah]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" min="1" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Satuan</label>
                                        <input type="text" name="items[0][satuan]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" class="remove-item px-3 py-2 text-red-600 hover:text-red-800 focus:outline-none">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Template for new item rows (hidden) -->
                            <template id="item-template">
                                <div class="item-row grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Nama Barang</label>
                                        <input type="text" name="items[INDEX][nama_barang]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                                        <input type="number" name="items[INDEX][jumlah]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" min="1" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Satuan</label>
                                        <input type="text" name="items[INDEX][satuan]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>
                                    <div class="flex items-end">
                                        <button type="button" class="remove-item px-3 py-2 text-red-600 hover:text-red-800 focus:outline-none">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-3 pt-5 border-t">
                        <a href="{{ route('deliveryOrders') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
    document.addEventListener('DOMContentLoaded', function() {
        const addItemButton = document.getElementById('add-item');
        const itemsContainer = document.getElementById('items-container');
        const itemTemplate = document.getElementById('item-template');
        let itemIndex = 0;
        
        // Add new item row
        addItemButton.addEventListener('click', function() {
            itemIndex++;
            const newItemRow = document.importNode(itemTemplate.content, true);
            
            // Update the input names with the new index
            newItemRow.querySelectorAll('input').forEach(input => {
                input.name = input.name.replace('INDEX', itemIndex);
            });
            
            itemsContainer.appendChild(newItemRow);
            
            // Attach event listener to new remove button
            attachRemoveItemEventListener();
        });
        
        // Function to attach event listeners to remove buttons
        function attachRemoveItemEventListener() {
            document.querySelectorAll('.remove-item').forEach(button => {
                button.addEventListener('click', function() {
                    // Only remove if there's more than one item
                    if (document.querySelectorAll('.item-row').length > 1) {
                        this.closest('.item-row').remove();
                    }
                });
            });
        }
        
        // Initialize remove button for the first item
        attachRemoveItemEventListener();
    });
</script>
@endsection