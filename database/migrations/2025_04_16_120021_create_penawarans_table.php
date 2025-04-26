<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('nomor_penawaran')->unique();
            $table->date('tanggal_penawaran');
            $table->text('keterangan_pengiriman')->nullable();
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('ongkos_kirim', 15, 2)->default(0);
            $table->decimal('bea_materai', 15, 2)->default(0);
            $table->decimal('ppn', 15, 2)->default(0);
            $table->decimal('grand_total', 15, 2)->default(0);
            $table->timestamps();
        });

        // Tabel untuk detail penawaran
        Schema::create('penawaran_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penawaran_id')->constrained('penawarans')->onDelete('cascade');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->decimal('harga', 15, 2);
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaran_details');
        Schema::dropIfExists('penawarans');
    }
};