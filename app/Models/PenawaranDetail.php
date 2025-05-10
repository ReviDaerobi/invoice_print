<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenawaranDetail extends Model
{
    protected $table = 'penawaran_details';
    
    protected $fillable = [
        'penawaran_id',
        'nama_barang',
        'jumlah',
        'satuan',
        'harga',
        'total_harga',
        'keterangan', // Tambahan untuk keterangan produk yang cukup panjang
    ];
    
    protected $casts = [
        'jumlah' => 'integer',
        'harga' => 'decimal:2',
        'total_harga' => 'decimal:2',
    ];
    
    // Relasi dengan Penawaran
    public function penawaran(): BelongsTo
    {
        return $this->belongsTo(Penawaran::class);
    }
    
    // Method untuk menghitung total harga
    public function calculateTotal()
    {
        $this->total_harga = $this->jumlah * $this->harga;
        
        return $this;
    }
}