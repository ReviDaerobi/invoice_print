<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penawaran extends Model
{
    protected $table = 'penawarans';
    
    protected $fillable = [
        'customer_id',
        'nomor_penawaran',
        'tanggal_penawaran',
        'keterangan_pengiriman',
        'subtotal',
        'ongkos_kirim',
        'bea_materai',
        'ppn',
        'grand_total',
    ];
    
    protected $casts = [
        'tanggal_penawaran' => 'date',
        'subtotal' => 'decimal:2',
        'ongkos_kirim' => 'decimal:2',
        'bea_materai' => 'decimal:2',
        'ppn' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];
    
    // Relasi dengan Customer
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class)->withDefault([
            'nama' => 'No Customer',
            'alamat_1' => '',
            'alamat_2' => '',
            'alamat_3' => '',
            'no_telp' => '',
            'contact_person' => ''
        ]);
    }
    
    // Relasi dengan PenawaranDetail
    public function details(): HasMany
    {
        return $this->hasMany(PenawaranDetail::class, 'penawaran_id');
    }
    
    // Generate nomor penawaran otomatis
    public static function generateNomorPenawaran()
    {
        $tahun = date('Y');
        $bulan = date('m');
        $prefix = "QUO/{$tahun}/{$bulan}/";
        
        $lastPenawaran = self::where('nomor_penawaran', 'like', $prefix . '%')
            ->orderBy('id', 'desc')
            ->first();
            
        if ($lastPenawaran) {
            $lastNumber = intval(substr($lastPenawaran->nomor_penawaran, -4));
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        return $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }
    
    // Method untuk menghitung ulang total
    public function calculateTotals()
    {
        // Hitung subtotal dari detail
        $this->subtotal = $this->details->sum('total_harga');
        
        // Hitung PPN (11% dari subtotal)
        $this->ppn = $this->subtotal * 0.11;
        
        // Hitung grand total
        $this->grand_total = $this->subtotal + $this->ongkos_kirim + $this->bea_materai + $this->ppn;
        
        return $this;
    }
}