<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryOrder extends Model
{
    protected $fillable = [
        'no_do', 'tanggal_do', 'customer_id', 'purchase_order_id', 'no_po_customer'
    ];
    
    protected $casts = ['tanggal_do' => 'datetime'];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    
    public function details(): HasMany
    {
        return $this->hasMany(DeliveryOrderDetail::class);
    }
    
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class, 'delivery_order_id');
    }
}