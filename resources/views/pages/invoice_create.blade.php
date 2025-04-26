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
                        <h2 class="text-xl font-semibold text-gray-800">Buat Invoice Baru</h2>
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
                            <span>Kirim Invoice</span>
                        </button>
                    </div>
                </div>
                
                <!-- Display validation errors if any -->
                @if ($errors->any())
                <div class="mb-4 bg-red-50 border border-red-200 text-red-800 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500"></i>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">
                                Terdapat beberapa kesalahan pada input Anda:
                            </h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Invoice Form -->
                <form id="invoice-form" action="{{ route('invoice.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Basic Info Card -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Informasi Dasar</h2>
                            <p class="text-sm text-gray-500 mt-1">Detail dasar untuk invoice baru Anda</p>
                        </div>
                        
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nomor_invoice" class="block text-sm font-medium text-gray-700 mb-1">No. Invoice</label>
                                <div class="relative rounded-md shadow-sm">
                                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">#</span>
                                    <input type="text" name="nomor_invoice" id="nomor_invoice" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-8 pr-12 sm:text-sm border-gray-300 rounded-md" value="{{ old('nomor_invoice', 'INV-' . date('Ymd') . '-' . str_pad(mt_rand(1, 999), 3, '0', STR_PAD_LEFT)) }}">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Nomor invoice dibuat otomatis</p>
                            </div>
                            
                            <div>
                                <label for="tanggal_invoice" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Invoice</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="far fa-calendar text-gray-400"></i>
                                    </div>
                                    <input type="date" name="tanggal_invoice" id="tanggal_invoice" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-10 sm:text-sm border-gray-300 rounded-md" value="{{ old('tanggal_invoice', date('Y-m-d')) }}">
                                </div>
                            </div>
                            
                            <!-- Baris kedua dengan 3 field berjajar (DO, PO, Tanggal DO) -->
<div class="md:col-span-2">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Field 1: Delivery Order -->
        <div>
            <label for="delivery_order_id" class="block text-sm font-medium text-gray-700 mb-1">Delivery Order</label>
            <select id="delivery_order_id" name="delivery_order_id" class="mt-1 block w-full h-9 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                <option value="">-- Pilih Delivery Order --</option>
                @foreach($deliveryOrders as $do)
                <option value="{{ $do->id }}" data-tanggal="{{ $do->tanggal_do }}" data-po="{{ $do->no_po_customer }}">
                    {{ $do->no_do }} - {{ $do->customer->nama }}
                </option>
                @endforeach
            </select>
            <p class="mt-1 text-xs text-gray-500">Pilih delivery order terkait</p>
        </div>
        
        <!-- Field 3: Tanggal DO (Baru) -->
        <div>
            <label for="tanggal_do" class="block text-sm font-medium text-gray-700 mb-1">Tanggal DO</label>
            <div class="relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="far fa-calendar text-gray-400"></i>
                </div>
                <input type="text" name="tanggal_do" id="tanggal_do" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-10 sm:text-sm border-gray-300 rounded-md" value="{{ old('tanggal_do') }}" readonly>
            </div>
            <p class="mt-1 text-xs text-gray-500">Tanggal dari delivery order</p>
        </div>

        <!-- Field 2: No. PO Customer -->
        <div>
            <label for="no_po_customer" class="block text-sm font-medium text-gray-700 mb-1">No. PO Customer</label>
            <input type="text" name="no_po_customer" id="no_po_customer" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 sm:text-sm border-gray-300 rounded-md" value="{{ old('no_po_customer') }}" placeholder="PO-12345">
        </div>
        
    </div>
</div>
                            
                            <div>
                                <label for="attention" class="block text-sm font-medium text-gray-700 mb-1">Attention (Perhatian)</label>
                                <input type="text" name="attention" id="attention" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 sm:text-sm border-gray-300 rounded-md" value="{{ old('attention') }}" placeholder="Bpk/Ibu ...">
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="keterangan_pengiriman" class="block text-sm font-medium text-gray-700 mb-1">Keterangan Pengiriman</label>
                                <textarea id="keterangan_pengiriman" name="keterangan_pengiriman" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tambahkan keterangan pengiriman atau informasi lainnya...">{{ old('keterangan_pengiriman') }}</textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer Info Card -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Informasi Customer</h2>
                            <p class="text-sm text-gray-500 mt-1">Pilih customer yang ingin dibuatkan invoice</p>
                        </div>
                        
                        <div class="p-6 space-y-6">
                            <div>
                                <label for="customer_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Customer</label>
                                <div class="relative mt-1 rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                    <select id="customer_id" name="customer_id" class="focus:ring-blue-500 focus:border-blue-500 block w-full h-9 pl-10 sm:text-sm border-gray-300 rounded-md">
                                        <option value="">-- Pilih Customer --</option>
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Pilih customer dari daftar atau tambahkan yang baru</p>
                            </div>
                            
                            <div x-data="{ showNewCustomer: false }" class="border-t pt-6">
                                <button @click="showNewCustomer = !showNewCustomer" type="button" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-user-plus mr-2"></i>
                                    <span>Tambah Customer Baru</span>
                                </button>
                                
                                <div x-show="showNewCustomer" class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="new_customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Customer</label>
                                        <input type="text" name="new_customer_name" id="new_customer_name" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Nama perusahaan atau individu">
                                    </div>
                                    
                                    <div>
                                        <label for="new_customer_contact" class="block text-sm font-medium text-gray-700 mb-1">Contact Person</label>
                                        <input type="text" name="new_customer_contact" id="new_customer_contact" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Nama kontak person">
                                    </div>
                                    
                                    <div>
                                        <label for="new_customer_phone" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                        <input type="text" name="new_customer_phone" id="new_customer_phone" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="08123456789">
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label for="new_customer_address1" class="block text-sm font-medium text-gray-700 mb-1">Alamat 1</label>
                                        <input type="text" id="new_customer_address1" name="new_customer_address1" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Alamat utama">
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label for="new_customer_address2" class="block text-sm font-medium text-gray-700 mb-1">Alamat 2 (Opsional)</label>
                                        <input type="text" id="new_customer_address2" name="new_customer_address2" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Alamat tambahan">
                                    </div>
                                    
                                    <div class="md:col-span-2">
                                        <label for="new_customer_address3" class="block text-sm font-medium text-gray-700 mb-1">Alamat 3 (Opsional)</label>
                                        <input type="text" id="new_customer_address3" name="new_customer_address3" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Alamat tambahan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Items Table Card -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Item & Layanan</h2>
                            <p class="text-sm text-gray-500 mt-1">Tambahkan item atau layanan ke invoice</p>
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
                                    <tbody class="bg-white divide-y divide-gray-200" x-data="invoiceItems()">
                                        <template x-for="(item, index) in items" :key="index">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="text" :name="'details['+index+'][nama_barang]'" x-model="item.nama_barang" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Nama barang">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" :name="'details['+index+'][jumlah]'" x-model="item.jumlah" min="1" class="focus:ring-blue-500 focus:border-blue-500 block w-24 sm:text-sm border-gray-300 rounded-md" @input="calculateTotals()">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="text" :name="'details['+index+'][satuan]'" x-model="item.satuan" class="focus:ring-blue-500 focus:border-blue-500 block w-24 sm:text-sm border-gray-300 rounded-md" placeholder="Pcs">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="relative rounded-md shadow-sm">
                                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 sm:text-sm">Rp</span>
                                                        </div>
                                                        <input type="number" :name="'details['+index+'][harga]'" x-model="item.harga" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="0" @input="calculateTotals()">
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <input type="hidden" :name="'details['+index+'][total_harga]'" x-model="item.total_harga">
                                                    <span x-text="formatPrice(item.total_harga)"></span>
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
                                                    <i class="fas fa-plus-circle mr-2"></i>
                                                    Tambah Item
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Invoice Summary -->
                            <div class="mt-8 sm:w-1/2 ml-auto" x-data="invoiceSummary()">
                                <div class="flow-root">
                                    <dl class="-my-4 text-sm">
                                        <div class="py-4 flex items-center justify-between">
                                            <dt class="text-gray-600">Subtotal</dt>
                                            <dd class="font-medium text-gray-900" x-text="formatPrice(subtotal)"></dd>
                                            <input type="hidden" name="subtotal" x-model="subtotal">
                                        </div>
                                        
                                        <div class="py-4 flex items-center justify-between border-t border-gray-200">
                                            <dt class="text-gray-600">
                                                <span>PPN (11%)</span>
                                                <div class="mt-1">
                                                    <div class="flex items-center">
                                                        <input id="include_tax" name="include_tax" type="checkbox" x-model="includeTax" @change="calculateTotal()" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                        <label for="include_tax" class="ml-2 block text-xs text-gray-500">
                                                            Termasuk PPN
                                                        </label>
                                                    </div>
                                                </div>
                                            </dt>
                                            <dd class="font-medium text-gray-900" x-text="formatPrice(tax)"></dd>
                                            <input type="hidden" name="tax" x-model="tax">
                                        </div>
                                        
                                        <div class="py-4 flex items-center justify-between border-t border-gray-200">
                                            <dt class="text-gray-600">
                                                <span>Diskon</span>
                                                <div class="mt-1 relative rounded-md shadow-sm w-32">
                                                    <input type="number" name="discount_percentage" id="discount_percentage" class="focus:ring-blue-500 focus:border-blue-500 block w-full pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="0" x-model="discountPercentage" @input="calculateTotal()">
                                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500 sm:text-sm">%</span>
                                                    </div>
                                                </div>
                                            </dt>
                                            <dd class="font-medium text-gray-900" x-text="formatPrice(discount)"></dd>
                                            <input type="hidden" name="discount" x-model="discount">
                                        </div>
                                        
                                        <div class="py-4 flex items-center justify-between border-t border-b border-gray-200">
                                            <dt class="text-base font-medium text-gray-900">Total</dt>
                                            <dd class="text-base font-medium text-blue-600" x-text="formatPrice(total)"></dd>
                                            <input type="hidden" name="total" x-model="total">
                                        </div>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- <!-- Payment Info Card -->
                    <div class="bg-white rounded-xl shadow overflow-hidden">
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-800">Informasi Pembayaran</h2>
                            <p class="text-sm text-gray-500 mt-1">Atur informasi rekening dan ketentuan pembayaran</p>
                        </div>
                        
                        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">Bank Tujuan</label>
                                <select id="bank_name" name="bank_name" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="">-- Pilih Bank --</option>
                                    <option value="bca" {{ old('bank_name') == 'bca' ? 'selected' : '' }}>Bank Central Asia (BCA)</option>
                                    <option value="bni" {{ old('bank_name') == 'bni' ? 'selected' : '' }}>Bank Negara Indonesia (BNI)</option>
                                    <option value="bri" {{ old('bank_name') == 'bri' ? 'selected' : '' }}>Bank Rakyat Indonesia (BRI)</option>
                                    <option value="mandiri" {{ old('bank_name') == 'mandiri' ? 'selected' : '' }}>Bank Mandiri</option>
                                    <option value="other" {{ old('bank_name') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="account_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Rekening</label>
                                <input type="text" name="account_number" id="account_number" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('account_number') }}" placeholder="123456789">
                            </div>
                            
                            <div>
                                <label for="account_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pemilik Rekening</label>
                                <input type="text" name="account_name" id="account_name" class="focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('account_name') }}" placeholder="PT. Nama Perusahaan">
                            </div>
                            
                            <div>
                                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Jatuh Tempo</label>
                                <select id="due_date" name="due_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                    <option value="7" {{ old('due_date') == '7' ? 'selected' : '' }}>7 hari</option>
                                    <option value="14" {{ old('due_date') == '14' ? 'selected' : '' }}>14 hari</option>
                                    <option value="30" {{ old('due_date') == '30' ? 'selected' : '' }}>30 hari</option>
                                    <option value="60" {{ old('due_date') == '60' ? 'selected' : '' }}>60 hari</option>
                                    <option value="custom" {{ old('due_date') == 'custom' ? 'selected' : '' }}>Kustom</option>
                                </select>
                            </div>
                            
                            <div class="md:col-span-2">
                                <label for="payment_notes" class="block text-sm font-medium text-gray-700 mb-1">Catatan Pembayaran</label>
                                <textarea id="payment_notes" name="payment_notes" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Tambahkan catatan atau instruksi pembayaran...">{{ old('payment_notes') }}</textarea>
                            </div>
                        </div>
                    </div> --}}
                    
                    <!-- Form Buttons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('invoice') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Batal
                        </a>
                        <button type="submit" name="save_draft" value="1" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Draft
                        </button>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Kirim Invoice
                        </button>
                    </div>
                </form>
            </main>
        </div>
    </div>
    
    <!-- Alpine.js and Custom Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.2/cdn.min.js" defer></script>
    <script>
        function invoiceItems() {
            return {
                items: [
                    {
                        nama_barang: '',
                        jumlah: 1,
                        satuan: 'Pcs',
                        harga: 0,
                        total_harga: 0
                    }
                ],
                
                addItem() {
                    this.items.push({
                        nama_barang: '',
                        jumlah: 1,
                        satuan: 'Pcs',
                        harga: 0,
                        total_harga: 0
                    });
                    this.$nextTick(() => {
                        this.calculateTotals();
                    });
                },
                
                removeItem(index) {
                    if (this.items.length > 1) {
                        this.items.splice(index, 1);
                        this.$nextTick(() => {
                            this.calculateTotals();
                        });
                    }
                },
                
                calculateTotals() {
                    this.items.forEach(item => {
                        item.total_harga = item.jumlah * item.harga;
                    });
                    
                    // Trigger event for summary calculation
                    window.dispatchEvent(new CustomEvent('items-updated', {
                        detail: { items: this.items }
                    }));
                },
                
                formatPrice(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(value);
                }
            }
        }
        
        function invoiceSummary() {
            return {
                subtotal: 0,
                tax: 0,
                discount: 0,
                total: 0,
                includeTax: true,
                discountPercentage: 0,
                
                init() {
                    this.calculateTotal();
                    
                    window.addEventListener('items-updated', (event) => {
                        this.calculateSubtotal(event.detail.items);
                        this.calculateTotal();
                    });
                },
                
                calculateSubtotal(items) {
                    this.subtotal = items.reduce((sum, item) => sum + item.total_harga, 0);
                },
                
                calculateTotal() {
                    // Calculate tax (11%)
                    this.tax = this.includeTax ? this.subtotal * 0.11 : 0;
                    
                    // Calculate discount
                    this.discount = this.subtotal * (this.discountPercentage / 100);
                    
                    // Calculate total
                    this.total = this.subtotal + this.tax - this.discount;
                },
                
                formatPrice(value) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(value);
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
    const deliveryOrderSelect = document.getElementById('delivery_order_id');
    const tanggalDoInput = document.getElementById('tanggal_do');
    const poCusInput = document.getElementById('no_po_customer');
    
    deliveryOrderSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption.value) {
            const tanggalDo = selectedOption.getAttribute('data-tanggal');
            const noPo = selectedOption.getAttribute('data-po');
            tanggalDoInput.value = tanggalDo || '';
            poCusInput.value = noPo || '';
        } else {
            tanggalDoInput.value = '';
            poCusInput.value = '';
        }
    });
});
        
        // Delivery Order Selection
        document.addEventListener('DOMContentLoaded', function() {

            // delivery order 
            

            const deliveryOrderSelect = document.getElementById('delivery_order_id');
            const customerSelect = document.getElementById('customer_id');
            
            if (deliveryOrderSelect && customerSelect) {
                deliveryOrderSelect.addEventListener('change', function() {
                    const doOption = this.options[this.selectedIndex];
                    if (doOption.value) {
                        // Extract customer ID from the delivery order option text
                        // This is just a placeholder - you would implement this properly based on your data structure
                        const doText = doOption.text;
                        const customerId = doText.split(' - ')[1]; // Example parsing
                        
                        // Set the customer dropdown to match
                        for (let i = 0; i < customerSelect.options.length; i++) {
                            if (customerSelect.options[i].text === customerId) {
                                customerSelect.selectedIndex = i;
                                break;
                            }
                        }
                    }
                });
            }
        });
    </script>

@endsection