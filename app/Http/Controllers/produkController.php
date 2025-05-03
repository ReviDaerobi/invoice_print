<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class produkController extends Controller
{
    public function index() {
        // Fetch all products from the database
        $produks = Produk::all();
        
        // Count statistics for the summary cards
        $totalProduk = $produks->count();
        
        // Assuming active products are all products (modify if needed)
        $aktivProduk = $totalProduk;
        
        // Count products created in the current month
        $bulanIni = now()->month;
        $tahunIni = now()->year;
        $produkBulanIni = Produk::whereMonth('created_at', $bulanIni)
                             ->whereYear('created_at', $tahunIni)
                             ->count();
        
        // If there's no created_at column, you might need an alternative approach
        // or set this value manually for now
        if (!$produkBulanIni) {
            $produkBulanIni = 0;
        }
        
        return view('pages.produk', compact('produks', 'totalProduk', 'aktivProduk', 'produkBulanIni'));
    }

    public function createPage() {
        return view('pages.produk_create');
    }
    
    public function store(Request $request) {
        // Validate the incoming request data
        $validated = $request->validate([
            'ItemId' => 'required|string|max:50|unique:invoice_items,ItemId',
            'ItemName' => 'required|string|max:255',
            'Unit' => 'required|string|max:50',
            'UnitPrice' => 'required|numeric|min:0',
        ], [
            'ItemId.required' => 'ID Produk harus diisi',
            'ItemId.unique' => 'ID Produk sudah digunakan',
            'ItemName.required' => 'Nama Produk harus diisi',
            'Unit.required' => 'Satuan harus dipilih',
            'UnitPrice.required' => 'Harga Satuan harus diisi',
            'UnitPrice.numeric' => 'Harga Satuan harus berupa angka',
            'UnitPrice.min' => 'Harga Satuan tidak boleh negatif',
        ]);
        
        // Format the unit price correctly (removing any formatting)
        $unitPrice = str_replace(['.', ','], ['', '.'], $request->UnitPrice);
        
        // Create a new product
        $produk = new Produk();
        $produk->ItemId = $request->ItemId;
        $produk->ItemName = $request->ItemName;
        $produk->Unit = $request->Unit;
        $produk->UnitPrice = $unitPrice;
        $produk->save();
        
        // Redirect with success message
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function detailPage($id = null) {
        // If an ID is provided, fetch that specific product
        if ($id) {
            $produk = Produk::findOrFail($id);
            return view('pages.produk_detail', compact('produk'));
        }
        
        // Default behavior - redirect to first product or show a generic page
        $produk = Produk::first();
        if ($produk) {
            return view('pages.produk_detail', compact('produk'));
        }
        
        // If no products exist yet
        return view('pages.produk_detail');
    }

    public function destroy($id) {
        // Find the product by ID
        $produk = Produk::findOrFail($id);
        
        // Delete the product
        $produk->delete();
        
        // Redirect with success message
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    public function edit($id) {
        // Find the product by ID
        $produk = Produk::findOrFail($id);
        
        // Return the edit view with the product data
        return view('pages.produk_edit', compact('produk'));
    }

    public function update(Request $request, $id) {
        // Find the product by ID
        $produk = Produk::findOrFail($id);
        
        // Validate the incoming request data
        $validated = $request->validate([
            'ItemId' => 'required|string|max:50|unique:invoice_items,ItemId,'.$id.',ItemId',
            'ItemName' => 'required|string|max:255',
            'Unit' => 'required|string|max:50',
            'UnitPrice' => 'required|numeric|min:0',
        ], [
            'ItemId.required' => 'ID Produk harus diisi',
            'ItemId.unique' => 'ID Produk sudah digunakan',
            'ItemName.required' => 'Nama Produk harus diisi',
            'Unit.required' => 'Satuan harus dipilih',
            'UnitPrice.required' => 'Harga Satuan harus diisi',
            'UnitPrice.numeric' => 'Harga Satuan harus berupa angka',
            'UnitPrice.min' => 'Harga Satuan tidak boleh negatif',
        ]);
        
        // Format the unit price correctly by converting Indonesian number format to standard format
        // First remove all dots (thousand separators in Indonesian format)
        $cleanPrice = str_replace('.', '', $request->UnitPrice);
        // Then replace comma (decimal separator in Indonesian) with dot (decimal separator in standard format)
        $cleanPrice = str_replace(',', '.', $cleanPrice);
        
        // Update the product
        $produk->ItemId = $request->ItemId;
        $produk->ItemName = $request->ItemName;
        $produk->Unit = $request->Unit;
        $produk->UnitPrice = $cleanPrice;
        $produk->save();
        
        // Redirect with success message
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }
}