<!-- resources/views/penawarans/show.blade.php with Tailwind CSS -->
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gray-50 px-4 py-4 sm:px-6 flex justify-between items-center border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-800">Detail Penawaran</h2>
            <div class="flex space-x-2">
                {{-- {{ route('penawarans.print', $quatation->id) }} --}}
                <a href="#" class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition-colors" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                    </svg>
                    Cetak
                </a>
                {{-- {{ route('penawarans.edit', $quatation->id) }} --}}
                <a href="#" class="inline-flex items-center px-3 py-1.5 bg-yellow-500 text-white text-sm rounded hover:bg-yellow-600 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                {{-- {{ route('penawarans.index') }} --}}
                <a href="#" class="inline-flex items-center px-3 py-1.5 bg-gray-500 text-white text-sm rounded hover:bg-gray-600 transition-colors">
                    Kembali
                </a>
            </div>
        </div>

        <div class="p-4 sm:p-6 lg:p-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Informasi Umum -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="divide-y divide-gray-200">
                            <tr>
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500 w-2/5">Nomor Penawaran</th>
                                <td class="px-3 py-2 text-sm text-gray-900">{{ $quatation->nomor_penawaran }}</td>
                            </tr>
                            <tr>
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500">Tanggal Penawaran</th>
                                <td class="px-3 py-2 text-sm text-gray-900">{{ $quatation->tanggal_penawaran ? $quatation->tanggal_penawaran->format('d M Y') : '-' }}</td>
                            </tr>
                            <tr>
                                <th class="px-3 py-2 text-left text-sm font-medium text-gray-500">Customer</th>
                                <td class="px-3 py-2 text-sm text-gray-900">{{ $quatation->customer ? $quatation->customer->nama : 'No Customer' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="rounded-lg border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 px-4 py-2 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700">Keterangan Pengiriman</h3>
                        </div>
                        <div class="p-4 text-sm text-gray-700">
                            {{ $quatation->keterangan_pengiriman ?? 'Tidak ada keterangan' }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detail Produk -->
            <h3 class="text-lg font-medium text-gray-800 mb-3">Detail Produk</h3>
            <div class="overflow-x-auto mb-6">
                <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-12 text-center">No</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">Nama Barang</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Jumlah</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-24">Satuan</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Harga</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Total</th>
                            <th class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($quatation->details as $index => $detail)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-center">{{ $index + 1 }}</td>
                            <td class="px-3 py-2 text-sm text-gray-900">{{ $detail->nama_barang }}</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($detail->jumlah, 0) }}</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900">{{ $detail->satuan }}</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($detail->harga, 2) }}</td>
                            <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-900 text-right">{{ number_format($detail->total_harga, 2) }}</td>
                            <td class="px-3 py-2 text-sm text-gray-900">{{ $detail->keterangan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-3 py-3 text-sm text-gray-500 text-center">Tidak ada detail produk</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Total -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <!-- Space untuk info tambahan jika perlu -->
                </div>
                <div>
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="divide-y divide-gray-200">
                            <div class="grid grid-cols-2 px-4 py-2.5">
                                <div class="text-sm text-gray-500">Subtotal:</div>
                                <div class="text-sm text-gray-900 text-right">{{ number_format($quatation->subtotal, 2) }}</div>
                            </div>
                            <div class="grid grid-cols-2 px-4 py-2.5">
                                <div class="text-sm text-gray-500">Ongkos Kirim:</div>
                                <div class="text-sm text-gray-900 text-right">{{ number_format($quatation->ongkos_kirim, 2) }}</div>
                            </div>
                            <div class="grid grid-cols-2 px-4 py-2.5">
                                <div class="text-sm text-gray-500">Bea Materai:</div>
                                <div class="text-sm text-gray-900 text-right">{{ number_format($quatation->bea_materai, 2) }}</div>
                            </div>
                            <div class="grid grid-cols-2 px-4 py-2.5">
                                <div class="text-sm text-gray-500">PPN (11%):</div>
                                <div class="text-sm text-gray-900 text-right">{{ number_format($quatation->ppn, 2) }}</div>
                            </div>
                            <div class="grid grid-cols-2 px-4 py-2.5 bg-gray-50">
                                <div class="text-sm font-medium text-gray-600">Grand Total:</div>
                                <div class="text-sm font-bold text-gray-900 text-right">{{ number_format($quatation->grand_total, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection