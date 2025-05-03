<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\PO;
use Illuminate\Http\Request;

class PoController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $POs = PO::with(['invoice', 'customers'])->latest()->paginate(10);
        $customers = Customer::all(); // Tambahkan baris ini
        return view('pages.purchase_orders', compact('POs','customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $invoices = Invoice::all();
        $customers = Customer::all();
        return view('pages.PO_create', compact('invoices', 'customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'total_revenue' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'profit' => 'required|numeric',
        ]);

        PO::create($validated);

        return redirect()->route('PO.index')
            ->with('success', 'Profit record berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PO $PO)
    {
        return view('profit_records.show', compact('PO'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PO $PO)
    {
        $invoices = Invoice::all();
        $customers = Customer::all();
        return view('profit_records.edit', compact('PO', 'invoices', 'customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PO $PO)
    {
        $validated = $request->validate([
            'invoice_id' => 'required|exists:invoices,id',
            'tanggal' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'total_revenue' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'profit' => 'required|numeric',
        ]);

        $PO->update($validated);

        return redirect()->route('PO.index')
            ->with('success', 'Profit record berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PO $PO)
    {
        $PO->delete();

        return redirect()->route('PO.index')
            ->with('success', 'Profit record berhasil dihapus.');
    }
}
