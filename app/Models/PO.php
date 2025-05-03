<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PO extends Model
{
    use HasFactory;

    protected $table = 'purchase_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id',
        'tanggal',
        'customer_id',
        'total_revenue',
        'total_cost',
        'profit',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tanggal' => 'date',
        'total_revenue' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'profit' => 'decimal:2',
    ];

    /**
     * Get the invoice that owns the profit record.
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    /**
     * Get the customer that owns the profit record.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
