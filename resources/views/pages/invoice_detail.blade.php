<!-- In your invoice_detail.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Invoice - {{ $invoice->nomor_invoice }}</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Your existing styles here */
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
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Include your existing sidebar code here -->
        
        <!-- Main Content -->
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
                        <h2 class="text-xl font-semibold text-gray-800">Detail Invoice #{{ $invoice->nomor_invoice }}</h2>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <!-- Your header buttons here -->
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-4 sm:p-6 lg:p-8">
                <!-- Action Bar -->
                <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 no-print">
                    <div>
                        <a href="{{ route('invoice') }}" class="flex items-center text-gray-600 hover:text-blue-600">
                            <i class="fas fa-arrow-left mr-2"></i>
                            <span>Kembali ke Daftar Invoice</span>
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
                        <a href="{{ route('invoice.edit', $invoice->id) }}" class="flex items-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition duration-200">
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
                                    <form method="POST" action="{{ route('invoice.destroy', ['id' => $invoice->id]) }}">
                                        @csrf
                                        <input type="hidden" name="invoice_id" value="{{ $invoice->id }}">
                                        <button type="submit" class="text-red-600 flex px-4 py-2 text-sm hover:bg-gray-100 w-full text-left" role="menuitem">
                                            <i class="fas fa-trash mr-3"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Tandai Lunas</span>
                        </button>
                    </div>
                </div>
                
                <!-- Invoice Status -->
                <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 no-print">
                    <div class="flex items-center">
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-{{ $invoice->status_color }}-100 text-{{ $invoice->status_color }}-800">
                            {{ $invoice->status }}
                        </span>
                        @php
                            $dueDate = \Carbon\Carbon::parse($invoice->tanggal_invoice)->addDays(14);
                            $daysRemaining = now()->diffInDays($dueDate, false);
                        @endphp
                        @if($daysRemaining > 0 && $invoice->status != 'Dibayar')
                            <span class="ml-3 text-gray-500 text-sm">
                                Jatuh tempo dalam {{ $daysRemaining }} hari ({{ $dueDate->format('d M Y') }})
                            </span>
                        @elseif($invoice->status != 'Dibayar')
                            <span class="ml-3 text-red-500 text-sm">
                                Telah lewat jatuh tempo {{ abs($daysRemaining) }} hari
                            </span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-500">
                        <span>Dibuat pada: {{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y') }}</span>
                    </div>
                </div>
                
                <!-- Invoice Content -->
                <div id="invoice-print-content" class="bg-white rounded-xl shadow overflow-hidden">
                    <!-- Invoice Header -->
                    <div class="p-8 border-b">
                        <div class="flex flex-col sm:flex-row justify-between items-start">
                            <div>
                                <div class="text-2xl font-bold text-blue-600 mb-1">InvoicePro</div>
                                <div class="text-gray-500">Jl. Merdeka No. 123, Jakarta</div>
                                <div class="text-gray-500">info@invoicepro.id</div>
                                <div class="text-gray-500">+62 21 1234 5678</div>
                            </div>
                            <div class="mt-6 sm:mt-0 text-right">
                                <h1 class="text-2xl font-bold text-gray-800">INVOICE</h1>
                                <div class="text-xl text-blue-600 font-semibold mt-1">#{{ $invoice->nomor_invoice }}</div>
                                <div class="text-gray-500 mt-1">
                                    <div>Tanggal: {{ \Carbon\Carbon::parse($invoice->tanggal_invoice)->format('d M Y') }}</div>
                                    <div>Jatuh Tempo: {{ \Carbon\Carbon::parse($invoice->tanggal_invoice)->addDays(14)->format('d M Y') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Invoice Body -->
                    <div class="p-8">
                        <!-- Customer & Company Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                            <div>
                                <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3">Ditagihkan Kepada:</h2>
                                <div class="text-lg font-semibold text-gray-800">{{ $invoice->customer->nama_customer }}</div>
                                <div class="text-gray-600">{{ $invoice->customer->alamat }}</div>
                                @if($invoice->customer->kota)
                                <div class="text-gray-600">{{ $invoice->customer->kota }}, {{ $invoice->customer->kode_pos }}</div>
                                @endif
                                <div class="text-gray-600 mt-2">Email: {{ $invoice->customer->email }}</div>
                                <div class="text-gray-600">Tel: {{ $invoice->customer->telepon }}</div>
                            </div>
                            <div class="md:text-right">
                                <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3 md:text-right">Pembayaran Ke:</h2>
                                <div class="text-gray-600">Bank Central Asia (BCA)</div>
                                <div class="text-gray-600">Nomor Rekening: 1234567890</div>
                                <div class="text-gray-600">Atas Nama: PT InvoicePro Indonesia</div>
                            </div>
                        </div>
                        
                        <!-- Invoice Table -->
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
                                        <th class="py-3 px-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Harga Satuan
                                        </th>
                                        <th class="py-3 px-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($invoice->details as $detail)
                                    <tr>
                                        <td class="py-4 px-4 text-sm text-gray-900">
                                            {{ $detail->nama_barang }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-500">
                                            {{ $detail->satuan }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-900 text-right">
                                            {{ $detail->jumlah }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-900 text-right">
                                            Rp {{ number_format($detail->harga, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-4 text-sm text-gray-900 text-right">
                                            Rp {{ number_format($detail->jumlah * $detail->harga, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="py-4 px-4"></td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            Subtotal
                                        </td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @if($invoice->ongkos_kirim > 0)
                                    <tr>
                                        <td colspan="3" class="py-4 px-4"></td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            Ongkos Kirim
                                        </td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            Rp {{ number_format($invoice->ongkos_kirim, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($invoice->bea_materai > 0)
                                    <tr>
                                        <td colspan="3" class="py-4 px-4"></td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            Bea Materai
                                        </td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            Rp {{ number_format($invoice->bea_materai, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endif
                                    @if($invoice->ppn > 0)
                                    <tr>
                                        <td colspan="3" class="py-4 px-4"></td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            PPN (11%)
                                        </td>
                                        <td class="py-4 px-4 text-sm font-medium text-gray-900 text-right">
                                            Rp {{ number_format($invoice->ppn, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                    @endif
                                    <tr class="bg-gray-50">
                                        <td colspan="3" class="py-4 px-4"></td>
                                        <td class="py-4 px-4 text-base font-bold text-gray-900 text-right">
                                            Total
                                        </td>
                                        <td class="py-4 px-4 text-base font-bold text-blue-600 text-right">
                                            Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <!-- Payment Info & Notes -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3">Catatan:</h2>
                                <p class="text-gray-600">
                                    Terima kasih atas kepercayaan Anda menggunakan jasa kami. Pembayaran harap dilakukan sebelum tanggal jatuh tempo.
                                    Untuk pertanyaan mengenai invoice ini, silakan hubungi tim keuangan kami di finance@invoicepro.id
                                </p>
                                <div class="mt-4">
                                    <h3 class="text-gray-500 uppercase text-sm font-semibold mb-2">Syarat & Ketentuan:</h3>
                                    <ul class="text-gray-600 text-sm list-disc pl-5 space-y-1">
                                        <li>Pembayaran harus dilakukan sesuai dengan tanggal jatuh tempo</li>
                                        <li>Keterlambatan pembayaran akan dikenakan denda sebesar 2% per bulan</li>
                                        <li>Bukti transfer harap dikirimkan ke email finance@invoicepro.id</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="md:text-right">
                                <h2 class="text-gray-500 uppercase text-sm font-semibold mb-3 md:text-right">Status Pembayaran:</h2>
                                <div class="inline-block bg-{{ $invoice->status_color }}-100 text-{{ $invoice->status_color }}-800 px-4 py-2 rounded-lg font-semibold">
                                    {{ $invoice->status }}: Rp {{ number_format($invoice->grand_total, 0, ',', '.') }}
                                </div>
                                <div class="mt-4">
                                    <div class="text-gray-600">Metode Pembayaran: Transfer Bank</div>
                                    <div class="text-gray-600 mt-1">Referensi: {{ $invoice->nomor_invoice }}</div>
                                </div>
                            </div>
                        </div>

                        <!-- Signature Section -->
                        <div class="mt-12 pt-8 border-t border-gray-200">
                            <div class="flex flex-col md:flex-row justify-between">
                                <div class="mb-6 md:mb-0">
                                    <div class="text-gray-500 uppercase text-sm font-semibold mb-10">Tanda Tangan Penerima:</div>
                                    <div class="h-0.5 w-40 bg-gray-300 mt-16"></div>
                                    <div class="text-gray-800 font-semibold mt-2">{{ $invoice->customer->nama_customer }}</div>
                                </div>
                                <div>
                                    <div class="text-gray-500 uppercase text-sm font-semibold mb-10 md:text-right">Tanda Tangan Pengirim:</div>
                                    <div class="h-0.5 w-40 bg-gray-300 mt-16 md:ml-auto"></div>
                                    <div class="text-gray-800 font-semibold mt-2 md:text-right">PT InvoicePro Indonesia</div>
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
                                <div class="text-xs text-gray-500 mt-2">Scan untuk verifikasi invoice</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Invoice Footer -->
                    <div class="bg-gray-50 p-6 text-center border-t text-sm text-gray-500">
                        <p>Invoice ini dibuat secara digital dan sah tanpa tanda tangan basah.</p>
                        <p class="mt-1">© 2025 PT InvoicePro Indonesia. Hak Cipta Dilindungi.</p>
                    </div>
                </div>
                
                <!-- Payment History -->
                <div class="mt-8 bg-white rounded-xl shadow overflow-hidden no-print">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-800">Riwayat Pembayaran</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-center py-8 text-gray-500">
                            <div class="text-center">
                                <i class="fas fa-receipt text-3xl mb-3 text-gray-400"></i>
                                <p>Belum ada riwayat pembayaran untuk invoice ini.</p>
                            </div>
                        </div>
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
                                    <i class="fas fa-file-invoice text-blue-600"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-900">Invoice dibuat</p>
                                    <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($invoice->created_at)->format('d M Y, H:i') }}</p>
                                </div>
                            </li>
                            <!-- You could add more activity logs from a separate table if needed -->
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.5/cdn.min.js" defer></script>
</body>
</html>