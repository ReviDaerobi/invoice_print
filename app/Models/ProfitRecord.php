<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfitRecord extends Model
{
    protected $fillable = [
        'invoice_id', 'tanggal', 'customer_id', 
        'total_revenue', 'total_cost', 'profit'
    ];
    
    protected $casts = ['tanggal' => 'datetime'];
    
    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }
    
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}