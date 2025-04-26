<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $fillable = [
        'nama', 'alamat_1', 'alamat_2', 'alamat_3', 'no_telp', 'contact_person'
    ];
    
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
    
    public function deliveryOrders(): HasMany
    {
        return $this->hasMany(DeliveryOrder::class);
    }
    
    public function purchaseOrders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }
    
    public function penawarans(): HasMany
    {
        return $this->hasMany(Penawaran::class);
    }
    
    public function profitRecords(): HasMany
    {
        return $this->hasMany(ProfitRecord::class);
    }
    
    // Helper method to get initials
    public function getInisialAttribute()
    {
        $words = explode(' ', $this->nama);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word[0])) {
                $initials .= strtoupper($word[0]);
                if (strlen($initials) >= 2) break;
            }
        }
        
        return $initials;
    }
}