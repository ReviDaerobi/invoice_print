<!-- resources/views/pages/delivery-order-show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="flex-1 flex flex-col overflow-hidden">
    <!-- Top Navigation -->
    <header class="bg-white shadow-sm z-10 no-print">
        <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <div class="flex items-center md:hidden">
                <button @click="sidebarOpen = true" class="text-gray-500 hover:text-gray-700 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
            
            <div class="flex-1 md:ml-0 md:mr-auto">
                <h2 class="text-xl font-semibold text-gray-800">Detail Delivery Order #{{ $deliveryOrder->nomor_do }}</h2>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Header buttons here -->
            </div>
        </div>
    </header>
    
    <!-- Page Content -->
    <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
        <!-- Action Bar -->
        <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
            <div>
                <a href="{{ route('deliveryOrders') }}" class="flex items-center text-gray-600 hover:text-blue-600">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Kembali ke Daftar Delivery Order</span>
                </a>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="button" onclick="window.print()" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-print mr-2 text-gray-600"></i>
                    <span>Cetak</span>
                </button>
                <button type="button" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-download mr-2 text-gray-600"></i>
                    <span>Download PDF</span>
                </button>
                <button type="button" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-paper-plane mr-2 text-gray-600"></i>
                    <span>Kirim Email</span>
                </button>
                <a href="{{ route('delivery-order.edit', $deliveryOrder->id) }}" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                    <i class="fas fa-edit mr-2 text-gray-600"></i>
                    <span>Edit</span>
                </a>
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" type="button" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
                        <i class="fas fa-ellipsis-h mr-2 text-gray-600"></i>
                        <span>Lainnya</span>
                    </button>
                    <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                        <div class="py-1" role="none">
                            <a href="#" class="text-gray-700 flex px-4 py-2 text-sm hover:bg-gray-100" role="menuitem">
                                <i class="fas fa-copy mr-3 text-gray-400"></i>
                                Duplikat
                            </a>
                            <form method="POST" action="{{ route('delivery-order.destroy', ['id' => $deliveryOrder->id]) }}">
                                @csrf
                                <input type="hidden" name="do_id" value="{{ $deliveryOrder->id }}">
                                <button type="submit" class="text-red-600 flex px-4 py-2 text-sm hover:bg-gray-100 w-full text-left" role="menuitem">
                                    <i class="fas fa-trash mr-3"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <button type="button" class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                    <i class="fas fa-truck mr-2"></i>
                    <span>Konfirmasi Pengiriman</span>
                </button>
            </div>
        </div>
        
        <!-- Delivery Order Status -->
        <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 no-print">
            <div class="flex items-center">
                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-{{ $deliveryOrder->status_color }}-100 text-{{ $deliveryOrder->status_color }}-800">
                    {{ $deliveryOrder->status }}
                </span>
                @php
                    $deliveryDate = \Carbon\Carbon::parse($deliveryOrder->tanggal_pengiriman);
                    $daysRemaining = now()->diffInDays($deliveryDate, false);
                @endphp
                @if($daysRemaining > 0 && $deliveryOrder->status != 'Terkirim')
                    <span class="ml-3 text-gray-500 text-sm">
                        Dijadwalkan dalam {{ $daysRemaining }} hari ({{ $deliveryDate->format('d M Y') }})
                    </span>
                @elseif($deliveryOrder->status != 'Terkirim' && $daysRemaining < 0)
                    <span class="ml-3 text-red-500 text-sm">
                        Terlambat {{ abs($daysRemaining) }} hari dari jadwal
                    </span>
                @endif
            </div>
            <div class="text-sm text-gray-500">
                <span>Dibuat pada: {{ \Carbon\Carbon::parse($deliveryOrder->created_at)->format('d M Y') }}</span>
            </div>
        </div>
        
        <!-- Delivery Order Content -->
        <div id="invoice-print-content" class="bg-white rounded-xl shadow overflow-hidden">
            <!-- Delivery Order Header -->
            <div class="p-8 border-b">
                <div class="flex flex-col sm:flex-row justify-between items-start">
                    <div>
                        <div class="text-2xl font-bold text-blue-600 mb-1">InvoicePro</div>
                        <div class="text-gray-500">Jl. Merdeka No. 123, Jakarta</div>
                        <div class="text-gray-500">info@invoicepro.id</div>
                        <div class="text-gray-500">+62 21 1234 5678</div>
                    </div>
                    <div class="mt-6 sm:mt-0 text-right">
                        <h1 class="text-2xl font-bold text-gray-800">DELIVERY ORDER</h1>
                        <div class="text-xl text-blue-600 font-semibold mt-1">#{{ $deliveryOrder->nomor_do }}</div>
                        <div class="text-gray-500 mt-1">
                            <div>Tanggal: {{ \Carbon\Carbon::parse($deliveryOrder->tanggal_pengiriman)->format('d M Y') }}</div>
                            <div>No. PO: <a href="#" class="text-blue-600 hover:underline">{{ $deliveryOrder->purchaseOrder->nomor_po }}</a></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Delivery Order Body -->
            <div class="p-8">
                <!-- Customer & Shipping Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div>
                        <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3">Dikirim Kepada:</h2>
                        <div class="text-lg font-semibold text-gray-800">{{ $deliveryOrder->customer->nama_customer }}</div>
                        <div class="text-gray-600">{{ $deliveryOrder->customer->alamat }}</div>
                        @if($deliveryOrder->customer->kota)
                        <div class="text-gray-600">{{ $deliveryOrder->customer->kota }}, {{ $deliveryOrder->customer->kode_pos }}</div>
                        @endif
                        <div class="text-gray-600 mt-2">Email: {{ $deliveryOrder->customer->email }}</div>
                        <div class="text-gray-600">Tel: {{ $deliveryOrder->customer->telepon }}</div>
                    </div>
                    <div class="md:text-right">
                        <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3 md:text-right">Info Pengiriman:</h2>
                        <div class="text-gray-800 font-semibold">{{ $deliveryOrder->kurir ?? 'Internal Delivery' }}</div>
                        <div class="text-gray-600">Estimasi Pengiriman: {{ \Carbon\Carbon::parse($deliveryOrder->tanggal_pengiriman)->format('d M Y') }}</div>
                        @if($deliveryOrder->nomor_resi)
                        <div class="text-gray-600">No. Resi: {{ $deliveryOrder->nomor_resi }}</div>
                        @endif
                        <div class="text-gray-600">Pengirim: {{ $deliveryOrder->pengirim ?? 'Tim Logistik' }}</div>
                    </div>
                </div>
                
                <!-- Items Table -->
                <div class="overflow-x-auto mb-10">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Item
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Deskripsi
                                </th>
                                <th class="py-3 px-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Jumlah
                                </th>
                                <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Satuan
                                </th>
                                <th class="py-3 px-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($deliveryOrder->details as $detail)
                            <tr>
                                <td class="py-4 px-4 text-sm text-gray-900">
                                    {{ $detail->nama_barang }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-500">
                                    {{ $detail->deskripsi ?? '-' }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-900 text-right">
                                    {{ $detail->jumlah }}
                                </td>
                                <td class="py-4 px-4 text-sm text-gray-900">
                                    {{ $detail->satuan }}
                                </td>
                                <td class="py-4 px-4 text-sm text-right">
                                    <span class="px-2 py-1 text-xs rounded-full bg-{{ $detail->status_color ?? 'gray' }}-100 text-{{ $detail->status_color ?? 'gray' }}-800">
                                        {{ $detail->status ?? 'Menunggu' }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <!-- Additional Info & Notes -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3">Catatan Pengiriman:</h2>
                        <p class="text-gray-600">
                            {{ $deliveryOrder->catatan ?? 'Tidak ada catatan tambahan untuk pengiriman ini.' }}
                        </p>
                        <div class="mt-4">
                            <h3 class="text-gray-500 uppercase text-sm font-semibold mb-2">Petunjuk Pengiriman:</h3>
                            <ul class="text-gray-600 text-sm list-disc pl-5 space-y-1">
                                <li>Pastikan barang dikemas dengan aman dan terlindungi</li>
                                <li>Periksa kembali item sebelum pengiriman</li>
                                <li>Hubungi pelanggan sebelum melakukan pengiriman</li>
                            </ul>
                        </div>
                    </div>
                    <div class="md:text-right">
                        <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3 md:text-right">Status Pengiriman:</h2>
                        <div class="inline-block bg-{{ $deliveryOrder->status_color }}-100 text-{{ $deliveryOrder->status_color }}-800 px-4 py-2 rounded-lg font-semibold">
                            {{ $deliveryOrder->status }}
                        </div>
                        @if($deliveryOrder->invoices->count() > 0)
                        <div class="mt-4">
                            <div class="text-gray-500 uppercase text-sm font-semibold mb-2 md:text-right">Invoice Terkait:</div>
                            @foreach($deliveryOrder->invoices as $invoice)
                            <div class="text-gray-600 mt-1">
                                <a href="{{ route('invoice.detail', $invoice->id) }}" class="text-blue-600 hover:underline">
                                    #{{ $invoice->nomor_invoice }}
                                </a>
                                - {{ \Carbon\Carbon::parse($invoice->tanggal_invoice)->format('d M Y') }}
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Signature Section -->
                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row justify-between">
                        <div class="mb-6 md:mb-0">
                            <div class="text-gray-500 uppercase text-sm font-semibold mb-10">Diterima Oleh:</div>
                            <div class="h-0.5 w-40 bg-gray-300 mt-16"></div>
                            <div class="text-gray-800 font-semibold mt-2">{{ $deliveryOrder->customer->nama_customer }}</div>
                            <div class="text-gray-500 text-sm">Tanggal: ____/____/______</div>
                        </div>
                        <div>
                            <div class="text-gray-500 uppercase text-sm font-semibold mb-10 md:text-right">Dikirim Oleh:</div>
                            <div class="h-0.5 w-40 bg-gray-300 mt-16 md:ml-auto"></div>
                            <div class="text-gray-800 font-semibold mt-2 md:text-right">{{ $deliveryOrder->pengirim ?? 'PT InvoicePro Indonesia' }}</div>
                            <div class="text-gray-500 text-sm md:text-right">Tanggal: {{ \Carbon\Carbon::parse($deliveryOrder->tanggal_pengiriman)->format('d/m/Y') }}</div>
                        </div>
                    </div>
                </div>

                <!-- QR Code Section -->
                <div class="mt-10 text-center">
                    <div class="inline-block p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="w-24 h-24 mx-auto bg-white p-2 border border-gray-200">
                            <!-- Placeholder for QR Code -->
                            <div class="w-full h-full bg-dots-light"></div>
                        </div>
                        <div class="text-xs text-gray-500 mt-2">Scan untuk verifikasi pengiriman</div>
                    </div>
                </div>
            </div>
            
            <!-- Delivery Order Footer -->
            <div class="bg-gray-50 p-6 text-center border-t text-sm text-gray-500">
                <p>Delivery Order ini dibuat secara digital dan sah tanpa tanda tangan basah.</p>
                <p class="mt-1">© 2025 PT InvoicePro Indonesia. Hak Cipta Dilindungi.</p>
            </div>
        </div>
        
        <!-- Tracking Information -->
        <div class="mt-8 bg-white rounded-xl shadow overflow-hidden no-print">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Informasi Pengiriman</h2>
            </div>
            <div class="p-6">
                @if($deliveryOrder->nomor_resi)
                <div class="mb-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Nomor Resi</h3>
                    <div class="flex items-center gap-3">
                        <span class="text-lg font-semibold text-gray-900">{{ $deliveryOrder->nomor_resi }}</span>
                        <button type="button" class="text-blue-600 hover:text-blue-800" onclick="navigator.clipboard.writeText('{{ $deliveryOrder->nomor_resi }}')">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div class="mb-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Kurir</h3>
                    <p class="text-gray-900">{{ $deliveryOrder->kurir }}</p>
                </div>
                <!-- Timeline for tracking -->
                <div class="mt-6">
                    <h3 class="text-sm font-medium text-gray-700 mb-4">Status Pengiriman</h3>
                    @if($deliveryOrder->status == 'Terkirim')
                    <div class="relative border-l-2 border-green-500 pl-6 pb-2">
                        <div class="absolute w-4 h-4 bg-green-500 rounded-full -left-2 top-0"></div>
                        <div class="text-sm">
                            <p class="font-medium text-gray-900">Pesanan telah diterima</p>
                            <p class="text-gray-500">{{ \Carbon\Carbon::parse($deliveryOrder->tanggal_penerimaan)->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    @else
                    <div class="flex items-center justify-center py-8 text-gray-500">
                        <div class="text-center">
                            <i class="fas fa-truck text-3xl mb-3 text-gray-400"></i>
                            <p>Belum ada informasi tracking untuk pengiriman ini.</p>
                        </div>
                    </div>
                    @endif
                </div>
                @else
                <div class="flex items-center justify-center py-8 text-gray-500">
                    <div class="text-center">
                        <i class="fas fa-truck text-3xl mb-3 text-gray-400"></i>
                        <p>Belum ada informasi pengiriman yang tersedia.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Activity Log -->
        <div class="mt-8 bg-white rounded-xl shadow overflow-hidden no-print">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-800">Log Aktivitas</h2>
            </div>
            <div class="p-6">
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-truck-loading text-blue-600"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Delivery Order dibuat</p>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($deliveryOrder->created_at)->format('d M Y, H:i') }}</p>
                        </div>
                    </li>
                    <!-- You could add more activity logs from a separate table if needed -->
                </ul>
            </div>
        </div>
    </main>
</div>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #invoice-print-content, #invoice-print-content * {
            visibility: visible;
        }
        #invoice-print-content {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            padding: 40px;
        }
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection