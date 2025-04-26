<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invoice extends Model
{
    protected $fillable = [
        'nomor_invoice', 'tanggal_invoice', 'customer_id', 'attention',
        'delivery_order_id', 'no_po_customer', 'keterangan_pengiriman',
        'subtotal', 'ongkos_kirim', 'bea_materai', 'ppn', 'grand_total'
    ];
    
    protected $casts = ['tanggal_invoice' => 'datetime'];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function deliveryOrder(): BelongsTo
    {
        return $this->belongsTo(DeliveryOrder::class);
    }
    
    public function details()
{
    return $this->hasMany(InvoiceDetail::class);
}
    
    public function profitRecord(): HasOne
    {
        return $this->hasOne(ProfitRecord::class);
    }
    
    // Untuk menampilkan status invoice (untuk contoh ini)
    public function getStatusAttribute()
    {
        $today = now();
        $dueDate = $this->tanggal_invoice->addDays(14); // Asumsi jatuh tempo 14 hari setelah invoice
        
        if ($this->payment && $this->payment->status == 'paid') {
            return 'Dibayar';
        } elseif ($dueDate < $today) {
            return 'Terlambat';
        } else {
            return 'Tertunda';
        }
    }
    
    // Status untuk styling badge
    public function getStatusColorAttribute()
    {
        switch($this->status) {
            case 'Dibayar':
                return 'green';
            case 'Terlambat':
                return 'red';
            default:
                return 'yellow';
        }
    }
    
   
}