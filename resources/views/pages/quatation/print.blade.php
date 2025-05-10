<!-- resources/views/penawarans/print.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation - {{ $penawaran->nomor_penawaran }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 12pt;
            color: #333;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24pt;
            color: #000;
        }
        .header p {
            margin: 5px 0;
        }
        .info-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .info-left, .info-right {
            width: 48%;
        }
        .info-box h3 {
            margin-top: 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.details {
            margin-top: 30px;
        }
        table.details th,
        table.details td {
            border: 1px solid #333;
            padding: 8px;
        }
        table.details th {
            background-color: #f2f2f2;
        }
        table.details td {
            vertical-align: top;
        }
        table.details tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary-table {
            width: 50%;
            margin-left: auto;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 5px;
        }
        .summary-table tr.total {
            font-weight: bold;
            border-top: 1px solid #333;
        }
        .footer {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }
        .signature {
            width: 30%;
            text-align: center;
        }
        .signature-line {
            margin-top: 70px;
            border-top: 1px solid #333;
            padding-top: 5px;
        }
        @media print {
            .no-print {
                display: none;
            }
            @page {
                size: A4;
                margin: 1cm;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="no-print" style="text-align: right; margin-bottom: 20px;">
            <button onclick="window.print()">Cetak</button>
            <button onclick="window.close()">Tutup</button>
        </div>
        
        <div class="header">
            <h1>QUOTATION</h1>
            <p>{{ config('app.name', 'Laravel') }}</p>
            <p>Alamat Perusahaan Anda, Telepon, Email</p>
        </div>
        
        <div class="info-box">
            <div class="info-left">
                <h3>Kepada</h3>
                <p>
                    <strong>{{ $penawaran->customer->nama }}</strong><br>
                    {{ $penawaran->customer->alamat_1 }}<br>
                    @if($penawaran->customer->alamat_2)
                        {{ $penawaran->customer->alamat_2 }}<br>
                    @endif
                    @if($penawaran->customer->alamat_3)
                        {{ $penawaran->customer->alamat_3 }}<br>
                    @endif
                    {{ $penawaran->customer->no_telp }}<br>
                    @if($penawaran->customer->contact_person)
                        Contact: {{ $penawaran->customer->contact_person }}
                    @endif
                </p>
            </div>
            <div class="info-right">
                <table>
                    <tr>
                        <td><strong>Nomor Quotation</strong></td>
                        <td>: {{ $penawaran->nomor_penawaran }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tanggal</strong></td>
                        <td>: {{ $penawaran->tanggal_penawaran->format('d/m/Y') }}</td>
                    </tr>
                </table>
                
                @if($penawaran->keterangan_pengiriman)
                <div style="margin-top: 10px; border: 1px solid #ccc; padding: 10px;">
                    <strong>Keterangan Pengiriman:</strong><br>
                    {{ $penawaran->keterangan_pengiriman }}
                </div>
                @endif
            </div>
        </div>
        
        <table class="details">
            <thead>
                <tr>
                    <th class="text-center" width="5%">No.</th>
                    <th width="30%">Nama Barang</th>
                    <th class="text-center" width="10%">Jumlah</th>
                    <th class="text-center" width="10%">Satuan</th>
                    <th class="text-right" width="15%">Harga</th>
                    <th class="text-right" width="15%">Total</th>
                    <th width="15%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penawaran->details as $index => $detail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $detail->nama_barang }}</td>
                    <td class="text-center">{{ number_format($detail->jumlah, 0) }}</td>
                    <td class="text-center">{{ $detail->satuan }}</td>
                    <td class="text-right">{{ number_format($detail->harga, 2) }}</td>
                    <td class="text-right">{{ number_format($detail->total_harga, 2) }}</td>
                    <td>{{ $detail->keterangan }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada detail produk</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        
        <div style="display: flex; justify-content: flex-end;">
            <table class="summary-table">
                <tr>
                    <td>Subtotal</td>
                    <td class="text-right">{{ number_format($penawaran->subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td>Ongkos Kirim</td>
                    <td class="text-right">{{ number_format($penawaran->ongkos_kirim, 2) }}</td>
                </tr>
                <tr>
                    <td>Bea Materai</td>
                    <td class="text-right">{{ number_format($penawaran->bea_materai, 2) }}</td>
                </tr>
                <tr>
                    <td>PPN (11%)</td>
                    <td class="text-right">{{ number_format($penawaran->ppn, 2) }}</td>
                </tr>
                <tr class="total">
                    <td>Total</td>
                    <td class="text-right">{{ number_format($penawaran->grand_total, 2) }}</td>
                </tr>
            </table>
        </div>
        
        <div class="footer">
            <div class="signature">
                <div class="signature-line">
                    Dibuat Oleh
                </div>
            </div>
            
            <div class="signature">
                <div class="signature-line">
                    Disetujui Oleh
                </div>
            </div>
            
            <div class="signature">
                <div class="signature-line">
                    Diterima Oleh
                </div>
            </div>
        </div>
    </div>
</body>
</html>