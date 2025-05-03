<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'invoice_items';

    /**
     * Primary key tabel.
     *
     * @var string
     */
    protected $primaryKey = 'ItemId';

    /**
     * Apakah model menggunakan timestamps.
     * Set false jika tidak menggunakan created_at dan updated_at.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Atribut yang dapat diisi (mass assignable).
     *
     * @var array
     */
    protected $fillable = [
        'ItemId',
        'ItemName',
        'Unit',
        'UnitPrice'
    ];

    /**
     * Atribut casting untuk konversi tipe data.
     *
     * @var array
     */
    protected $casts = [
        'UnitPrice' => 'decimal:2',
    ];
}
