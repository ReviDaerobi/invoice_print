
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h1 class="text-lg font-medium text-gray-900">Edit Penawaran</h1>
            <a href="{{ route('quatation.index') }}" class="px-3 py-1 bg-gray-500 text-white text-sm rounded hover:bg-gray-600 transition">Kembali</a>
        </div>

        <div class="p-6">
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">{{ session('error') }}</div>
            @endif

            <form action="{{ route('quatation.update', $quatation->id) }}" method="POST" id="penawaranForm">
                @csrf
                @method('PUT')
                
                <!-- Informasi Umum -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label for="nomor_penawaran" class="block text-sm font-medium text-gray-700 mb-1">Nomor Penawaran</label>
                        <input type="text" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('nomor_penawaran') border-red-500 @enderror" 
                            id="nomor_penawaran" name="nomor_penawaran" value="{{ old('nomor_penawaran', $quatation->nomor_penawaran) }}" readonly>
                        @error('nomor_penawaran')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="tanggal_penawaran" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Penawaran</label>
                        <input type="date" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('tanggal_penawaran') border-red-500 @enderror" 
                            id="tanggal_penawaran" name="tanggal_penawaran" value="{{ old('tanggal_penawaran', $quatation->tanggal_penawaran->format('Y-m-d')) }}">
                        @error('tanggal_penawaran')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-1">Customer</label>
                        <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('customer_id') border-red-500 @enderror" 
                            id="customer_id" name="customer_id">
                            <option value="">Pilih Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ (old('customer_id', $quatation->customer_id) == $customer->id) ? 'selected' : '' }}>
                                    {{ $customer->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('customer_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="keterangan_pengiriman" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Pengiriman</label>
                    <textarea class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('keterangan_pengiriman') border-red-500 @enderror" 
                        id="keterangan_pengiriman" name="keterangan_pengiriman" rows="3">{{ old('keterangan_pengiriman', $quatation->keterangan_pengiriman) }}</textarea>
                    @error('keterangan_pengiriman')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Detail Produk -->
                <div class="mb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-3">Detail Produk</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse" id="product-table">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12">No</th>
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Jumlah</th>
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Satuan</th>
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-36">Harga</th>
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-36">Total</th>
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                    <th class="py-2 px-3 border border-gray-300 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="product-rows">
                                @foreach($details as $index => $detail)
                                <tr class="product-row">
                                    <td class="py-2 px-3 border border-gray-300 text-sm">{{ $index + 1 }}</td>
                                    <td class="py-2 px-3 border border-gray-300">
                                        <input type="text" class="product-name w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50" 
                                            name="product_name[]" value="{{ $detail['nama_barang'] ?? '' }}" readonly>
                                        <input type="hidden" class="product-id" name="product_id[]" value="{{ $detail['product_id'] ?? '' }}">
                                    </td>
                                    <td class="py-2 px-3 border border-gray-300">
                                        <input type="number" class="quantity w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            name="quantity[]" min="1" value="{{ $detail['jumlah'] ?? '' }}">
                                    </td>
                                    <td class="py-2 px-3 border border-gray-300">
                                        <input type="text" class="unit w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50" 
                                            name="unit[]" value="{{ $detail['satuan'] ?? '' }}" readonly>
                                    </td>
                                    <td class="py-2 px-3 border border-gray-300">
                                        <input type="number" class="price w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-gray-50" 
                                            name="price[]" step="0.01" value="{{ $detail['harga'] ?? '' }}" readonly>
                                    </td>
                                    <td class="py-2 px-3 border border-gray-300">
                                        <input type="text" class="row-total w-full border-gray-300 rounded shadow-sm bg-gray-50" 
                                            name="total[]" value="{{ $detail['total_harga'] ?? '' }}" readonly>
                                    </td>
                                    <td class="py-2 px-3 border border-gray-300">
                                        <input type="text" class="w-full border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                            name="keterangan[]" value="{{ $detail['keterangan'] ?? '' }}">
                                    </td>
                                    <td class="py-2 px-3 border border-gray-300">
                                        <button type="button" class="select-product-btn w-full px-2 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition" data-row="{{ $index }}">
                                            {{ empty($detail['nama_barang']) ? 'Pilih' : 'Ubah' }}
                                        </button>
                                        @if(!empty($detail['nama_barang']))
                                        <button type="button" class="remove-product-btn w-full mt-1 px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition" data-row="{{ $index }}">
                                            Hapus
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 flex justify-end">
                        <button type="button" id="addRowBtn" class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600 transition">
                            + Tambah Baris
                        </button>
                    </div>
                </div>

                <!-- Kalkulasi Total -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <div class="mb-4">
                            <label for="ongkos_kirim" class="block text-sm font-medium text-gray-700 mb-1">Ongkos Kirim</label>
                            <input type="number" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                id="ongkos_kirim" name="ongkos_kirim" value="{{ old('ongkos_kirim', $quatation->ongkos_kirim) }}" step="0.01">
                        </div>
                        <div class="mb-4">
                            <label for="bea_materai" class="block text-sm font-medium text-gray-700 mb-1">Bea Materai</label>
                            <input type="number" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                id="bea_materai" name="bea_materai" value="{{ old('bea_materai', $quatation->bea_materai) }}" step="0.01">
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded">
                        <div class="mb-3">
                            <label for="subtotal" class="block text-sm font-medium text-gray-700 mb-1">Subtotal</label>
                            <input type="text" class="w-full rounded-md border-gray-300 bg-gray-100 shadow-sm" 
                                id="subtotal" name="subtotal" value="{{ $quatation->subtotal }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="ppn" class="block text-sm font-medium text-gray-700 mb-1">PPN (11%)</label>
                            <input type="text" class="w-full rounded-md border-gray-300 bg-gray-100 shadow-sm" 
                                id="ppn" name="ppn" value="{{ $quatation->ppn }}" readonly>
                        </div>
                        <div class="mb-2">
                            <label for="grand_total" class="block text-sm font-medium text-gray-700 mb-1">Grand Total</label>
                            <input type="text" class="w-full rounded-md border-gray-300 bg-gray-100 shadow-sm font-bold" 
                                id="grand_total" name="grand_total" value="{{ $quatation->grand_total }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('quatation.show', $quatation->id) }}" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Batal</a>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update Penawaran</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Produk -->
<div class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50" id="productModal">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-4xl shadow-lg rounded-md bg-white">
        <div class="flex justify-between items-center pb-3 border-b">
            <h3 class="text-lg font-medium text-gray-900">Pilih Produk</h3>
            <button type="button" class="close-modal text-gray-400 hover:text-gray-500">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="my-4 overflow-x-auto max-h-96">
            <table class="min-w-full table-auto" id="productDataTable">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $product->ItemId }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $product->ItemName }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ $product->Unit }}</td>
                        <td class="px-4 py-2 text-sm text-gray-900">{{ number_format($product->UnitPrice, 2) }}</td>
                        <td class="px-4 py-2 text-sm">
                            <button type="button" class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition select-item"
                                data-id="{{ $product->ItemId }}"
                                data-name="{{ $product->ItemName }}"
                                data-unit="{{ $product->Unit }}"
                                data-price="{{ $product->UnitPrice }}">
                                Pilih
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="pt-3 border-t text-right">
            <button type="button" class="close-modal px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Variabel untuk menyimpan indeks baris yang sedang aktif
    let currentRowIndex = 0;
    let rowCount = document.querySelectorAll('.product-row').length;
    
    // Inisialisasi DataTable jika ada
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#productDataTable').DataTable({
            searching: true,
            paging: true,
            info: true
        });
    }
    
    // Event listener untuk tombol "Tambah Baris"
    document.getElementById('addRowBtn').addEventListener('click', function() {
        addNewRow();
        recalculateAll();
    });
    
    // Event listener untuk tombol "Pilih Produk"
    document.querySelectorAll('.select-product-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            currentRowIndex = this.getAttribute('data-row');
            document.getElementById('productModal').classList.remove('hidden');
        });
    });
    
    // Event listener untuk tombol "Hapus" pada baris
    document.querySelectorAll('.remove-product-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            // Clear all values in this row instead of removing
            const inputs = row.querySelectorAll('input');
            inputs.forEach(input => {
                if(input.type !== 'button') {
                    input.value = '';
                }
            });
            
            // Change button text
            row.querySelector('.select-product-btn').textContent = 'Pilih';
            // Hide remove button
            this.classList.add('hidden');
            
            recalculateAll();
        });
    });
    
    // Event listener untuk tutup modal
    document.querySelectorAll('.close-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('productModal').classList.add('hidden');
        });
    });
    
    // Event listener untuk pilih item
    document.querySelectorAll('.select-item').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = document.querySelectorAll('.product-row')[currentRowIndex];
            
            // Set data produk ke baris
            row.querySelector('.product-id').value = this.getAttribute('data-id');
            row.querySelector('.product-name').value = this.getAttribute('data-name');
            row.querySelector('.unit').value = this.getAttribute('data-unit');
            row.querySelector('.price').value = this.getAttribute('data-price');
            
            // Reset quantity and recalculate
            const quantityInput = row.querySelector('.quantity');
            if (!quantityInput.value) {
                quantityInput.value = 1;
            }
            
            // Update row total
            updateRowTotal(row);
            
            // Update button text
            row.querySelector('.select-product-btn').textContent = 'Ubah';
            
            // Show remove button if it exists or create one if not
            let removeBtn = row.querySelector('.remove-product-btn');
            if (!removeBtn) {
                const selectBtn = row.querySelector('.select-product-btn');
                removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'remove-product-btn w-full mt-1 px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition';
                removeBtn.textContent = 'Hapus';
                removeBtn.setAttribute('data-row', currentRowIndex);
                
                removeBtn.addEventListener('click', function() {
                    const row = this.closest('tr');
                    // Clear all values
                    const inputs = row.querySelectorAll('input');
                    inputs.forEach(input => {
                        if(input.type !== 'button') {
                            input.value = '';
                        }
                    });
                    
                    // Change button text
                    row.querySelector('.select-product-btn').textContent = 'Pilih';
                    // Hide remove button
                    this.classList.add('hidden');
                    
                    recalculateAll();
                });
                
                selectBtn.parentNode.appendChild(removeBtn);
            } else {
                removeBtn.classList.remove('hidden');
            }
            
            // Hide modal
            document.getElementById('productModal').classList.add('hidden');
            
            // Recalculate totals
            recalculateAll();
        });
    });
    
    // Event listeners for quantity changes
    document.querySelectorAll('.quantity').forEach(input => {
        input.addEventListener('input', function() {
            const row = this.closest('tr');
            updateRowTotal(row);
            recalculateAll();
        });
    });
    
    // Event listeners for other inputs that affect total
    document.getElementById('ongkos_kirim').addEventListener('input', recalculateAll);
    document.getElementById('bea_materai').addEventListener('input', recalculateAll);
    
    // Fungsi untuk menambah baris baru
    function addNewRow() {
        const tbody = document.getElementById('product-rows');
        const template = document.querySelector('.product-row').cloneNode(true);
        
        // Reset values
        template.querySelectorAll('input').forEach(input => { 
            if(input.type !== 'button') {
                input.value = ''; 
            }
        });
        
        // Set row number
        template.querySelector('td:first-child').textContent = rowCount + 1;
        
        // Update data-row attribute
        const selectBtn = template.querySelector('.select-product-btn');
        selectBtn.setAttribute('data-row', rowCount);
        selectBtn.textContent = 'Pilih';
        
        // Hide remove button if exists
        const removeBtn = template.querySelector('.remove-product-btn');
        if (removeBtn) {
            removeBtn.classList.add('hidden');
        }
        
        // Add event listeners to new elements
        selectBtn.addEventListener('click', function() {
            currentRowIndex = this.getAttribute('data-row');
            document.getElementById('productModal').classList.remove('hidden');
        });
        
        const quantityInput = template.querySelector('.quantity');
        quantityInput.addEventListener('input', function() {
            updateRowTotal(template);
            recalculateAll();
        });
        
        tbody.appendChild(template);
        rowCount++;
    }
    
    // Fungsi untuk menghitung total baris
    function updateRowTotal(row) {
        const quantity = parseFloat(row.querySelector('.quantity').value) || 0;
        const price = parseFloat(row.querySelector('.price').value) || 0;
        const total = quantity * price;
        row.querySelector('.row-total').value = total.toFixed(2);
    }
    
    // Fungsi untuk menghitung ulang semua total
    function recalculateAll() {
        let subtotal = 0;
        
        // Sum all row totals
        document.querySelectorAll('.row-total').forEach(input => {
            subtotal += parseFloat(input.value) || 0;
        });
        
        // Set subtotal
        document.getElementById('subtotal').value = subtotal.toFixed(2);
        
        // Calculate PPN (11%)
        const ppn = subtotal * 0.11;
        document.getElementById('ppn').value = ppn.toFixed(2);
        
        // Calculate grand total
        const ongkosKirim = parseFloat(document.getElementById('ongkos_kirim').value) || 0;
        const beaMaterai = parseFloat(document.getElementById('bea_materai').value) || 0;
        const grandTotal = subtotal + ppn + ongkosKirim + beaMaterai;
        document.getElementById('grand_total').value = grandTotal.toFixed(2);
    }
    
    // Initialize calculations when page loads
    recalculateAll();
});
</script>
@endpush

@endsection