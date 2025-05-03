<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class costumerController extends Controller
{
     /**
     * Display a listing of customers
     */
    public function index()
    {
        $customers = Customer::all();
        return view('pages.costumers', compact('customers'));
    }

    /**
     * Show the form for creating a new customer
     */
    public function create()
    {
        return view('pages.customer_create');
    }

    /**
     * Store a newly created customer in the database
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat_1' => 'required|string|max:255',
            'alamat_2' => 'nullable|string|max:255',
            'alamat_3' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'contact_person' => 'nullable|string|max:255',
        ]);

        // Create the customer
        Customer::create($validated);

        // Redirect with success message
        return redirect()->route('costumer')->with('success', 'Customer berhasil ditambahkan');
    }

    /**
     * Display the specified customer
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('pages.customer_detail', compact('customer'));
    }

    /**
     * Show the form for editing the specified customer
     */
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('pages.customer_edit', compact('customer'));
    }

    /**
     * Update the specified customer in the database
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat_1' => 'required|string|max:255',
            'alamat_2' => 'nullable|string|max:255',
            'alamat_3' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'contact_person' => 'nullable|string|max:255',
        ]);

        // Update the customer
        $customer = Customer::findOrFail($id);
        $customer->update($validated);

        // Redirect with success message
        return redirect()->route('costumer')->with('success', 'Customer berhasil diperbarui');
    }

    /**
     * Remove the specified customer from the database
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('costumer')->with('success', 'Customer berhasil dihapus');
    }

    /**
     * Get customer details as JSON (for API/Ajax calls)
     */
    public function getDetails($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

}
