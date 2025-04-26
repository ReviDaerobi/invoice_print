<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\DeliveryOrder;
use App\Models\InvoiceDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;  // This is CORRECT
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule as ValidationRule;

class InvoiceController extends Controller
{
    public function invoice() 
    {
        $invoices = Invoice::with('customer', 'deliveryOrder')
                    ->latest()
                    ->paginate(5); // Menampilkan 5 invoice per halaman
        return view('pages.invoices', compact('invoices'));
    }

    public function createPage() 
    {
        $customers = Customer::all();
        $deliveryOrders = DeliveryOrder::with('customer')->get(); // Tambahkan with() untuk eager loading
        return view('pages.invoice_create', compact('customers', 'deliveryOrders'));
    }

    public function detailPage($id)
    {
        $invoice = Invoice::with(['customer', 'deliveryOrder', 'details'])->findOrFail($id);
        return view('pages.invoice_detail', compact('invoice'));
    }
    
    public function store(Request $request)
    {
        // Validate input - Laravel 11 style
        $validated = $request->validate([
            'nomor_invoice' => ['required', 'string', 'max:50', ValidationRule::unique('invoices', 'nomor_invoice')],
            'tanggal_invoice' => ['required', 'date'],
            'customer_id' => ['required_without:new_customer_name', 'exists:customers,id'],
            'new_customer_name' => ['required_without:customer_id', 'max:255'],
            'delivery_order_id' => ['nullable', 'exists:delivery_orders,id'],
            'no_po_customer' => ['nullable', 'string', 'max:100'],
            'attention' => ['nullable', 'string', 'max:255'],
            'keterangan_pengiriman' => ['nullable', 'string'],
            'bank_name' => ['nullable', 'string', 'max:50'],
            'account_number' => ['nullable', 'string', 'max:50'],
            'account_name' => ['nullable', 'string', 'max:255'],
            'due_date' => ['required', 'string'],
            'payment_notes' => ['nullable', 'string'],
            'details' => ['required', 'array', 'min:1'],
            'details.*.nama_barang' => ['required', 'string', 'max:255'],
            'details.*.jumlah' => ['required', 'numeric', 'min:1'],
            'details.*.satuan' => ['required', 'string', 'max:50'],
            'details.*.harga' => ['required', 'numeric', 'min:0'],
            'details.*.total_harga' => ['required', 'numeric', 'min:0'],
            'subtotal' => ['required', 'numeric', 'min:0'],
            'tax' => ['required', 'numeric', 'min:0'],
            'discount' => ['required', 'numeric', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
        ]);

        try {
            return DB::transaction(function () use ($request) {
                // Handle customer creation if needed
                $customerId = $request->customer_id;
                if (!$customerId && $request->new_customer_name) {
                    $customer = Customer::create([
                        'nama' => $request->new_customer_name,
                        'contact_person' => $request->new_customer_contact ?? null,
                        'telepon' => $request->new_customer_phone ?? null,
                        'alamat1' => $request->new_customer_address1 ?? null,
                        'alamat2' => $request->new_customer_address2 ?? null,
                        'alamat3' => $request->new_customer_address3 ?? null,
                        'created_by' => Auth::id(),
                    ]);
                    $customerId = $customer->id;
                }
                
                // Calculate due date
                $dueDate = null;
                if ($request->due_date === 'custom') {
                    $dueDate = Carbon::parse($request->custom_due_date ?? now());
                } else {
                    $dueDate = Carbon::parse($request->tanggal_invoice)->addDays(intval($request->due_date));
                }
                
                // Create invoice
                $invoice = Invoice::create([
                    'nomor_invoice' => $request->nomor_invoice,
                    'tanggal_invoice' => $request->tanggal_invoice,
                    'customer_id' => $customerId,
                    'delivery_order_id' => $request->delivery_order_id,
                    'no_po_customer' => $request->no_po_customer,
                    'attention' => $request->attention,
                    'keterangan_pengiriman' => $request->keterangan_pengiriman,
                    'bank_name' => $request->bank_name,
                    'account_number' => $request->account_number,
                    'account_name' => $request->account_name,
                    'jatuh_tempo' => $dueDate,
                    'catatan_pembayaran' => $request->payment_notes,
                    'subtotal' => $request->subtotal,
                    'pajak' => $request->tax,
                    'diskon' => $request->discount,
                    'total' => $request->total,
                    'status' => $request->has('save_draft') ? 'draft' : 'terbit',
                    'created_by' => Auth::id(),
                ]);
                
                // Create invoice details
                $detailsToCreate = [];
                foreach ($request->details as $detail) {
                    $detailsToCreate[] = new InvoiceDetail([
                        'nama_barang' => $detail['nama_barang'],
                        'jumlah' => $detail['jumlah'],
                        'satuan' => $detail['satuan'],
                        'harga' => $detail['harga'],
                        'total_harga' => $detail['total_harga'],
                    ]);
                }
                $invoice->details()->saveMany($detailsToCreate);
                
                // Update delivery order status if connected
                if ($request->delivery_order_id) {
                    $deliveryOrder = DeliveryOrder::find($request->delivery_order_id);
                    if ($deliveryOrder) {
                        $deliveryOrder->status = 'invoiced';
                        $deliveryOrder->save();
                    }
                }
                
                // Add success message
                return redirect()
                    ->route('invoice')
                    ->with('success', 'Invoice berhasil ' . ($request->has('save_draft') ? 'disimpan sebagai draft' : 'diterbitkan') . '!');
            });
            
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput();
        }
    }

    
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $customers = Customer::all();
        $deliveryOrders = DeliveryOrder::all();
        return view('pages.invoice_edit', compact('invoice', 'customers', 'deliveryOrders'));
    }
    
    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'tanggal_invoice' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'no_po_customer' => 'nullable|string|max:255',
            'attention' => 'nullable|string|max:255',
            'delivery_order_id' => 'nullable|exists:delivery_orders,id',
            'keterangan_pengiriman' => 'nullable|string',
            'subtotal' => 'required|numeric|min:0',
            'ongkos_kirim' => 'nullable|numeric|min:0',
            'bea_materai' => 'nullable|numeric|min:0',
            'include_ppn' => 'sometimes|boolean',
            'ppn_amount' => 'nullable|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'catatan' => 'nullable|string',
            'syarat_ketentuan' => 'nullable|string',
            'details' => 'required|array',
            'details.*.nama_barang' => 'required|string',
            'details.*.jumlah' => 'required|numeric|min:1',
            'details.*.satuan' => 'required|string',
            'details.*.harga' => 'required|numeric|min:0',
            'details.*.total_harga' => 'required|numeric|min:0',
        ]);

        // Ambil invoice yang akan diupdate
        $invoice = Invoice::findOrFail($id);

        // Update data invoice
        $invoice->update([
            'tanggal_invoice' => $request->tanggal_invoice,
            'customer_id' => $request->customer_id,
            'no_po_customer' => $request->no_po_customer,
            'attention' => $request->attention,
            'delivery_order_id' => $request->delivery_order_id,
            'keterangan_pengiriman' => $request->keterangan_pengiriman,
            'subtotal' => $request->subtotal,
            'ongkos_kirim' => $request->ongkos_kirim ?? 0,
            'bea_materai' => $request->bea_materai ?? 0,
            'include_ppn' => $request->has('include_ppn'),
            'ppn_amount' => $request->ppn_amount ?? 0,
            'total_amount' => $request->total_amount,
            'catatan' => $request->catatan,
            'syarat_ketentuan' => $request->syarat_ketentuan,
        ]);

        // Simpan detail invoice
        if ($request->has('details')) {
            // Hapus semua detail lama
            $invoice->details()->delete();
            
            // Tambahkan detail baru
            foreach ($request->details as $detail) {
                $invoice->details()->create([
                    'nama_barang' => $detail['nama_barang'],
                    'jumlah' => $detail['jumlah'],
                    'satuan' => $detail['satuan'],
                    'harga' => $detail['harga'],
                    'total_harga' => $detail['total_harga'],
                ]);
            }
        }

        return redirect()->route('invoice')
            ->with('success', 'Invoice berhasil diperbarui');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        
        // Jika Anda ingin juga menghapus semua relasi terlebih dahulu
        // Misalnya, menghapus invoice details
        $invoice->details()->delete();
        
        // Metode yang benar untuk delete adalah dengan panggil delete() pada instance
        $invoice->delete();
        
        return redirect()->route('invoice')->with('success', 'Invoice berhasil dihapus');
    }
}