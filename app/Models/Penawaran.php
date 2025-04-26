<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penawaran extends Model
{
    protected $fillable = [
        'customer_id', 'nomor_penawaran', 'tanggal_penawaran', 
        'keterangan_pengiriman', 'subtotal', 'ongkos_kirim', 
        'bea_materai', 'ppn', 'grand_total'
    ];
    
    protected $dates = ['tanggal_penawaran'];
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
    
    public function details(): HasMany
    {
        return $this->hasMany(PenawaranDetail::class);
    }
}