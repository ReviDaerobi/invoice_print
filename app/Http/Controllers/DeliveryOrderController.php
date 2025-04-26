<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Models\Customer;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the delivery orders.
     */
    public function index()
    {
        $deliveryOrders = DeliveryOrder::with('customer', 'purchaseOrder', 'details', 'invoices')
                    ->latest()
                    ->paginate(5); // Showing 5 delivery orders per page
        return view('pages.deliveryOrders', compact('deliveryOrders'));
    }

    /**
     * Show the form for creating a new delivery order.
     */
    public function create()
    {
        $customers = Customer::all();
        $purchaseOrders = PurchaseOrder::all();
        return view('pages.delivery-order-create', compact('customers', 'purchaseOrders'));
    }

    /**
     * Store a newly created delivery order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_do' => 'required|string|unique:delivery_orders',
            'tanggal_do' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'purchase_order_id' => 'nullable|exists:purchase_orders,id',
            'no_po_customer' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.nama_barang' => 'required|string',
            'items.*.jumlah' => 'required|numeric|min:1',
            'items.*.satuan' => 'required|string',
        ]);

        $deliveryOrder = DeliveryOrder::create([
            'no_do' => $request->no_do,
            'tanggal_do' => $request->tanggal_do,
            'customer_id' => $request->customer_id,
            'purchase_order_id' => $request->purchase_order_id,
            'no_po_customer' => $request->no_po_customer,
        ]);

        foreach ($request->items as $item) {
            $deliveryOrder->details()->create([
                'nama_barang' => $item['nama_barang'],
                'jumlah' => $item['jumlah'],
                'satuan' => $item['satuan'],
            ]);
        }

        return redirect()->route('deliveryOrders')
            ->with('success', 'Delivery Order berhasil dibuat');
    }

    /**
     * Display the specified delivery order.
     */
    public function show($id)
    {
        $deliveryOrder = DeliveryOrder::with('customer', 'purchaseOrder', 'details', 'invoices')
            ->findOrFail($id);
        return view('pages.delivery-order-show', compact('deliveryOrder'));
    }

    /**
     * Show the form for editing the specified delivery order.
     */
    public function edit($id)
    {
        $deliveryOrder = DeliveryOrder::with('details')->findOrFail($id);
        $customers = Customer::all();
        $purchaseOrders = PurchaseOrder::all();
        return view('pages.delivery-order-edit', compact('deliveryOrder', 'customers', 'purchaseOrders'));
    }

    /**
     * Update the specified delivery order in storage.
     */
    public function update(Request $request, $id)
    {
        $deliveryOrder = DeliveryOrder::findOrFail($id);

        $request->validate([
            'no_do' => 'required|string|unique:delivery_orders,no_do,' . $id,
            'tanggal_do' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'purchase_order_id' => 'nullable|exists:purchase_orders,id',
            'no_po_customer' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|exists:delivery_order_details,id',
            'items.*.nama_barang' => 'required|string',
            'items.*.jumlah' => 'required|numeric|min:1',
            'items.*.satuan' => 'required|string',
        ]);

        $deliveryOrder->update([
            'no_do' => $request->no_do,
            'tanggal_do' => $request->tanggal_do,
            'customer_id' => $request->customer_id,
            'purchase_order_id' => $request->purchase_order_id,
            'no_po_customer' => $request->no_po_customer,
        ]);

        // Handle items (add new ones, update existing ones)
        $existingItemIds = [];

        foreach ($request->items as $item) {
            if (isset($item['id'])) {
                // Update existing item
                $detailItem = $deliveryOrder->details()->find($item['id']);
                if ($detailItem) {
                    $detailItem->update([
                        'nama_barang' => $item['nama_barang'],
                        'jumlah' => $item['jumlah'],
                        'satuan' => $item['satuan'],
                    ]);
                    $existingItemIds[] = $item['id'];
                }
            } else {
                // Add new item
                $newItem = $deliveryOrder->details()->create([
                    'nama_barang' => $item['nama_barang'],
                    'jumlah' => $item['jumlah'],
                    'satuan' => $item['satuan'],
                ]);
                $existingItemIds[] = $newItem->id;
            }
        }

        // Delete items that were removed
        $deliveryOrder->details()->whereNotIn('id', $existingItemIds)->delete();

        return redirect()->route('deliveryOrders')
            ->with('success', 'Delivery Order berhasil diperbarui');
    }

    /**
     * Remove the specified delivery order from storage.
     */
    public function destroy($id)
    {
        $deliveryOrder = DeliveryOrder::findOrFail($id);
        
        // Check if this DO is already used in invoices
        if ($deliveryOrder->invoices()->count() > 0) {
            return redirect()->route('deliveryOrders')
                ->with('error', 'Delivery Order tidak dapat dihapus karena sudah terhubung dengan Invoice');
        }
        
        // Delete all detail items first
        $deliveryOrder->details()->delete();
        
        // Then delete the delivery order
        $deliveryOrder->delete();

        return redirect()->route('deliveryOrders')
            ->with('success', 'Delivery Order berhasil dihapus');
    }
}