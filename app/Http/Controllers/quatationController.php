<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Penawaran;
use App\Models\PenawaranDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class quatationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penawarans = Penawaran::with('customer')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $customers = Customer::all();
            
        return view('pages.quatation.index', compact('penawarans','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::orderBy('nama')->get();
        $products = Produk::orderBy('ItemName')->get();
        $nomor_penawaran = Penawaran::generateNomorPenawaran();
        
        // Default 8 baris kosong untuk input produk
        $default_rows = 8;
        
        return view('pages.quatation.create', compact('customers', 'products', 'nomor_penawaran', 'default_rows'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'nomor_penawaran' => 'required|string|unique:penawarans',
            'tanggal_penawaran' => 'required|date',
            'keterangan_pengiriman' => 'nullable|string',
            'ongkos_kirim' => 'numeric|min:0',
            'bea_materai' => 'numeric|min:0',
            'nama_barang.*' => 'nullable|string',
            'jumlah.*' => 'nullable|numeric|min:1',
            'satuan.*' => 'nullable|string',
            'harga.*' => 'nullable|numeric|min:0',
            'keterangan.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Buat penawaran
            $penawaran = new Penawaran();
            $penawaran->customer_id = $request->customer_id;
            $penawaran->nomor_penawaran = $request->nomor_penawaran;
            $penawaran->tanggal_penawaran = $request->tanggal_penawaran;
            $penawaran->keterangan_pengiriman = $request->keterangan_pengiriman;
            $penawaran->ongkos_kirim = $request->ongkos_kirim ?? 0;
            $penawaran->bea_materai = $request->bea_materai ?? 0;
            $penawaran->save();

            // Tambahkan detail penawaran
            $subtotal = 0;
            
            for ($i = 0; $i < count($request->nama_barang ?? []); $i++) {
                // Skip baris kosong
                if (empty($request->nama_barang[$i])) {
                    continue;
                }
                
                $jumlah = $request->jumlah[$i] ?? 0;
                $harga = $request->harga[$i] ?? 0;
                $total_harga = $jumlah * $harga;
                
                $detail = new PenawaranDetail();
                $detail->penawaran_id = $penawaran->id;
                $detail->nama_barang = $request->nama_barang[$i];
                $detail->jumlah = $jumlah;
                $detail->satuan = $request->satuan[$i];
                $detail->harga = $harga;
                $detail->total_harga = $total_harga;
                $detail->keterangan = $request->keterangan[$i] ?? null;
                $detail->save();
                
                $subtotal += $total_harga;
            }
            
            // Update totals
            $penawaran->subtotal = $subtotal;
            $penawaran->ppn = $subtotal * 0.11; // PPN 11%
            $penawaran->grand_total = $penawaran->subtotal + $penawaran->ongkos_kirim + $penawaran->bea_materai + $penawaran->ppn;
            $penawaran->save();
            
            DB::commit();
            
            return redirect()->route('quatation.index', $penawaran->id)
                ->with('success', 'Penawaran berhasil dibuat.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penawaran $quatation)
    {
        $quatation->load(['customer', 'details']);
        
        // DEBUG: Print crucial information
        // dd([
        //     'penawaran_id' => $penawaran->id,
        //     'customer_id' => $penawaran->customer_id,
        //     'customer_exists' => $penawaran->customer_id ? Customer::find($penawaran->customer_id) !== null : false,
        //     'customer' => $penawaran->customer
        // ]);
        
        return view('pages.quatation.detail', compact('quatation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penawaran $quatation)
    {
        $quatation->load(['customer', 'details']);
        $customers = Customer::orderBy('nama')->get();
        $products = Produk::orderBy('ItemName')->get();
        
        // Default 8 baris untuk edit, jika kurang dari 8 tambahkan baris kosong
        $details = $quatation->details->toArray();
        $default_rows = 8;
        
        if (count($details) < $default_rows) {
            $empty_rows = $default_rows - count($details);
            for ($i = 0; $i < $empty_rows; $i++) {
                $details[] = [
                    'nama_barang' => '',
                    'jumlah' => '',
                    'satuan' => '',
                    'harga' => '',
                    'total_harga' => '',
                    'keterangan' => '',
                ];
            }
        }
        
        return view('pages.quatation.edit', compact('quatation', 'customers', 'products', 'details', 'default_rows'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penawaran $quatation)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'nomor_penawaran' => 'required|string|unique:penawarans,nomor_penawaran,' . $quatation->id,
            'tanggal_penawaran' => 'required|date',
            'keterangan_pengiriman' => 'nullable|string',
            'ongkos_kirim' => 'numeric|min:0',
            'bea_materai' => 'numeric|min:0',
            'nama_barang.*' => 'nullable|string',
            'jumlah.*' => 'nullable|numeric|min:1',
            'satuan.*' => 'nullable|string',
            'harga.*' => 'nullable|numeric|min:0',
            'keterangan.*' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::beginTransaction();
        try {
            // Update penawaran
            $quatation->customer_id = $request->customer_id;
            $quatation->nomor_penawaran = $request->nomor_penawaran;
            $quatation->tanggal_penawaran = $request->tanggal_penawaran;
            $quatation->keterangan_pengiriman = $request->keterangan_pengiriman;
            $quatation->ongkos_kirim = $request->ongkos_kirim ?? 0;
            $quatation->bea_materai = $request->bea_materai ?? 0;
            
            // Hapus semua detail lama
            $quatation->details()->delete();
            
            // Tambahkan detail penawaran baru
            $subtotal = 0;
            
            for ($i = 0; $i < count($request->nama_barang ?? []); $i++) {
                // Skip baris kosong
                if (empty($request->nama_barang[$i])) {
                    continue;
                }
                
                $jumlah = $request->jumlah[$i] ?? 0;
                $harga = $request->harga[$i] ?? 0;
                $total_harga = $jumlah * $harga;
                
                $detail = new PenawaranDetail();
                $detail->penawaran_id = $quatation->id;
                $detail->nama_barang = $request->nama_barang[$i];
                $detail->jumlah = $jumlah;
                $detail->satuan = $request->satuan[$i];
                $detail->harga = $harga;
                $detail->total_harga = $total_harga;
                $detail->keterangan = $request->keterangan[$i] ?? null;
                $detail->save();
                
                $subtotal += $total_harga;
            }
            
            // Update totals
            $quatation->subtotal = $subtotal;
            $quatation->ppn = $subtotal * 0.11; // PPN 11%
            $quatation->grand_total = $quatation->subtotal + $quatation->ongkos_kirim + $quatation->bea_materai + $quatation->ppn;
            $quatation->save();
            
            DB::commit();
            
            return redirect()->route('penawarans.show', $quatation->id)
                ->with('success', 'Penawaran berhasil diperbarui.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penawaran $quatation)
    {
        DB::beginTransaction();
        try {
            // Hapus detail terlebih dahulu
            $quatation->details()->delete();
            
            // Hapus penawaran
            $quatation->delete();
            
            DB::commit();
            
            return redirect()->route('penawarans.index')
                ->with('success', 'Penawaran berhasil dihapus.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Print penawaran
     */
    public function print(Penawaran $quatation)
    {
        $quatation->load(['customer', 'details']);
        return view('penawarans.print', compact('penawaran'));
    }
    
    /**
     * Get product data via AJAX
     */
    public function getProductData(Request $request)
    {
        $product = Produk::find($request->item_id);
        
        if ($product) {
            return response()->json([
                'success' => true,
                'data' => [
                    'satuan' => $product->Unit,
                    'harga' => $product->UnitPrice,
                ]
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'Produk tidak ditemukan'
        ], 404);
    }
    
    /**
     * Calculate row total via AJAX
     */
    public function calculateRowTotal(Request $request)
    {
        $jumlah = $request->jumlah;
        $harga = $request->harga;
        $total = $jumlah * $harga;
        
        return response()->json([
            'success' => true,
            'total' => number_format($total, 2, '.', ',')
        ]);
    }
}