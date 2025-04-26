<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryOrderDetail extends Model
{
    protected $fillable = [
        'delivery_order_id', 'nama_barang', 'jumlah', 'satuan'
    ];
    
    public function deliveryOrder(): BelongsTo
    {
        return $this->belongsTo(DeliveryOrder::class);
    }
}