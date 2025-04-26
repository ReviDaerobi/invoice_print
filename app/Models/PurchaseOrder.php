<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'customer_id', 'no_purchase_order', 'tanggal_purchase_order', 'total_amount'
    ];
    
    protected $casts = ['tanggal_purchase_order' => 'datetime'];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function deliveryOrders(): HasMany
    {
        return $this->hasMany(DeliveryOrder::class, 'purchase_order_id');
    }
}