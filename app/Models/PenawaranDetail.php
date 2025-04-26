<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenawaranDetail extends Model
{
    protected $fillable = [
        'penawaran_id', 'nama_barang', 'jumlah', 'satuan', 'harga', 'total_harga'
    ];
    
    public function penawaran(): BelongsTo
    {
        return $this->belongsTo(Penawaran::class);
    }
}